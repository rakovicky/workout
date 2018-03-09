<p></p>
<?php
error_reporting(E_ALL & ~E_NOTICE);
        $slozka = "./poc";

        if((!file_exists("$slozka/data.txt")) || (!file_exists("$slozka/ip.txt")) || (!file_exists("$slozka/nastaveni.txt"))) {
                die("Jeden z datových súborov nebol nájdený.");
        }

        $ip = $_SERVER['REMOTE_ADDR'];
        
        $ban_ip = Array("127.0.0.1"); 

        $adresy = explode("\n", file_get_contents("$slozka/ip.txt"));
        $radku = count($adresy);
        $cas = time();
        $online = 1;
        $plus = true;

        for($i = 0; $i < $radku; $i++) {
                $adresa = explode(":", $adresy[$i]);
                if(($ip == $adresa[0]) && ($cas < $adresa[1])) { $plus = false; }
                if(($ip != $adresa[0]) && ($cas < $adresa[1])) {
                        $zapis .= $adresa[0].":".$adresa[1]."\n";
                        foreach($ban_ip as $adresa) {
                                if($ip == $adresa) {
                                        $ban = 1;
                                        break;
                                }
                        }
                        if($ban == 0) {
                                $online++;
                        }
                }
        }
        
        $cas = $cas + 600;
        $zapis .= $ip.":".$cas."\n";
        
        $fp = fopen("$slozka/ip.txt", "w+");
        fwrite($fp, $zapis);
        fclose($fp);
        
        $fp = fopen("$slozka/data.txt","r");
        $data = fread($fp, filesize("$slozka/data.txt"));
        $data = unserialize($data);
        if($plus) {
                $ban = 0;
                foreach($ban_ip as $adresa) {
                        if($ip == $adresa) {
                                $ban = 1;
                                break;
                        }
                }
                if($ban == 0) {
                        $data[celkem]++;
                        $data[dnes]++;
                }
        }
        
        $den = date("w");
        
        if($den != $data[den]) {
                $data[dnes] = 1;
        }
        
        $data[den] = $den;
        $celkem = $data[celkem];
        $dnes = $data[dnes];

        $data = serialize($data);

        fclose($fp);

        $fp = fopen("$slozka/data.txt", "w+");
        fwrite($fp, $data);
        fclose($fp);
        
        $fp = fopen("$slozka/nastaveni.txt", "r");
        $opt = fread($fp, filesize("$slozka/nastaveni.txt"));
        $opt = unserialize($opt);
        
        if($opt[styl] == 2) {
                $sirka = $opt[sirka];
                $vyska = $opt[vyska];
                $vyska_kraje = $opt[vyska_kraje];
                $vyska_stred = $vyska - $vyska_kraje;
                $pismo = $opt[pismo];

                $obrazek = imagecreatetruecolor($sirka,$vyska);

                function spocti_barvu($kod) {
                        $kod = strtolower($kod);
                        $hex = Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
                        $barvy = Array("red","green","blue");
                        for($i = 0; $i < 3; $i++) {
                                $cast = substr($kod, $i * 2, 2);
                                $a = array_search(substr($cast,0,1), $hex);
                                $b = array_search(substr($cast,1,2), $hex);
                                $rgb[$barvy[$i]] = $b + $a * 16;
                        }
                        return $rgb;
                }

                $text1 = spocti_barvu($opt[text1]);
                $text2 = spocti_barvu($opt[text2]);
                $cara = spocti_barvu($opt[cara]);
                $pozadi1 = spocti_barvu($opt[pozadi1]);
                $pozadi2 = spocti_barvu($opt[pozadi2]);

                function nastav_barvu($prvek,$obrazek) {
                        $cast = imagecolorallocate($obrazek,$prvek[red],$prvek[green],$prvek[blue]);
                        return $cast;
                }

                $text1 = nastav_barvu($text1,$obrazek);
                $text2 = nastav_barvu($text2,$obrazek);
                $cara = nastav_barvu($cara,$obrazek);
                $pozadi1 = nastav_barvu($pozadi1,$obrazek);
                $pozadi2 = nastav_barvu($pozadi2,$obrazek);

                imagesetthickness($obrazek, 1);
                imagefilledrectangle($obrazek, 0, 0, $sirka, $vyska_kraje, $pozadi2);
                imagefilledrectangle($obrazek, 0, $vyska_kraje, $sirka, $vyska_stred, $pozadi1);
                imagefilledrectangle($obrazek, 0, $vyska_stred, $sirka, $vyska, $pozadi2);

                imageline($obrazek, 0, $vyska_kraje, $sirka, $vyska_kraje, $cara);
                imageline($obrazek, 0, 0, $sirka, 0, $cara);
                imageline($obrazek, 0, $vyska - 1, $sirka, $vyska - 1, $cara);
                imageline($obrazek, 0, 0, 0, $vyska, $cara);
                imageline($obrazek, $sirka - 1, 0, $sirka - 1, $vyska, $cara);
                imageline($obrazek, 0, $vyska_stred, $sirka - 1, $vyska_stred, $cara); 

                $pismo_vyska = ImageTTFBBox($pismo, 0,"./$slozka/font.ttf",Text);

                $celkem_x = ImageTTFBBox($pismo, 0,"./$slozka/font.ttf",$celkem);
                $celkem_x[2] = $sirka - $celkem_x[2] - 7;
                $dnes_x = ImageTTFBBox($pismo, 0,"./$slozka/font.ttf",$dnes);
                $dnes_x[2] = $sirka - $dnes_x[2] - 7;
                $online_x = ImageTTFBBox($pismo, 0,"./$slozka/font.ttf",$online);
                $online_x[2] = $sirka - $online_x[2] - 7;
                
                $statistika_x = ImageTTFBBox($pismo, 0,"./$slozka/font.ttf","PoÄÃ­tadlo");
                imagettftext($obrazek, $pismo, 0, $sirka/2 - $statistika_x[2]/2, $vyska_kraje/2 - $pismo_vyska[5]/2, $text1, "./$slozka/font.ttf", "PoÄÃ­tadlo");
                
                imagettftext($obrazek, $pismo, 0, 5, $vyska_kraje + $pismo_vyska[2]/2 + $vyska/15, $text2, "./$slozka/font.ttf", "Celkom:"); 
                imagettftext($obrazek, $pismo, 0, 5, $vyska/2 + $pismo_vyska[2]/4, $text2, "./$slozka/font.ttf", "Dnes:"); 
                imagettftext($obrazek, $pismo, 0, 5, $vyska - $vyska_kraje - $vyska/15, $text2, "./$slozka/font.ttf", "Online:");
                
                imagettftext($obrazek, $pismo, 0, $celkem_x[2], $vyska_kraje + $pismo_vyska[2]/2 + $vyska/15, $text2, "./$slozka/font.ttf", $celkem);
                imagettftext($obrazek, $pismo, 0, $dnes_x[2], $vyska/2 + $pismo_vyska[2]/4, $text2, "./$slozka/font.ttf", $dnes);
                imagettftext($obrazek, $pismo, 0, $online_x[2], $vyska - $vyska_kraje - $vyska/15, $text2, "./$slozka/font.ttf", $online);
                
                imagepng($obrazek,"$slozka/pocitadlo.png");
                imagedestroy($obrazek);
                
                echo "<img src=\"$slozka/pocitadlo.png\" alt=\"pocitadlo\" style=\"border-width: 0px;\" width=\"$sirka\" height=\"$vyska\" /></a>";
        } else {
                echo "Celkem: <b>$celkem</b><br />Dnes: <b>$dnes</b><br /> Online: <b>$online</b>";
        }
?>