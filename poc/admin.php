<?php
        session_start();

        $prihlasovaci_jmeno = "admin"; /* Zde vepište pøihlašovací jméno do administrace. Napø.: $prihlasovaci_jmeno = "vase_prihlasovaci_jmeno"; */
        $heslo = "admin"; /* Zde vepište heslo do administrace. Napø.: $heslo = "vase_heslo"; */


        if((!file_exists("data.txt")) || (!file_exists("ip.txt")) || (!file_exists("nastaveni.txt"))) {
                die("Jeden z datových souborù nebyl nalezen.");
        }
        parse_str($_SERVER[QUERY_STRING]);
        $prihlaseni = false;

        $pass = md5($heslo);
        
        if(isset($_POST[vstup])) {
                        if(($prihlasovaci_jmeno == $_POST[login]) && (md5($_POST[heslo2]) == $pass)) {
                        $_SESSION[poc_login] = $_POST[login];
                        $_SESSION[poc_heslo] = $pass;
                        $oznam = "";
                        header("Location: admin.php");
                } else {
                        $oznam = "<br /><h2>Špatné pøihlašovací jméno nebo heslo!</h2>";
                }
        } elseif((isset($_SESSION[poc_login])) && (isset($_SESSION[poc_heslo]))) {
                if(($_SESSION[poc_login] == $prihlasovaci_jmeno) && ($_SESSION[poc_heslo] == $pass)) {
                        $prihlaseni = true;
                } else {
                        $prihlaseni = false;
                }
        }

        if($akce == "odhlaseni") {
                session_destroy();
                header("Location: admin.php");
        }   

        if($prihlaseni) {  
                $fp = fopen("nastaveni.txt","r");
                $nastaveni = fread($fp, filesize("nastaveni.txt"));
                $nastaveni = unserialize($nastaveni);
                fclose($fp);
                $fp = fopen("data.txt","r");
                $data = fread($fp, filesize("data.txt"));
                $data = unserialize($data);
                fclose($fp);
                if(isset($_POST[ok])) {
                        function zapis_data($soubor,$data) {
                                $fp = fopen($soubor,w);
                                fwrite($fp,$data);
                                fclose($fp);
                        }

                        $data1 = Array("styl" => "$_POST[styl]", "text1" => "$_POST[text1]", "text2" => "$_POST[text2]", "cara" => "$_POST[cara]", "pozadi1" => "$_POST[pozadi1]", "pozadi2" => "$_POST[pozadi2]", "sirka" => "$_POST[sirka]", "vyska" => "$_POST[vyska]", "vyska_kraje" => "$_POST[vyska_kraje]", "pismo" => "$_POST[pismo]");
                        $data1 = serialize($data1);
                        zapis_data("nastaveni.txt",$data1);
                        
                        $data[celkem] = $_POST[hodnota];
                        $data = serialize($data);
                        zapis_data("data.txt",$data);
                        
                        header("Location: admin.php");
                }
        }                
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
        <meta http-equiv="Content-type" content="text/html; charset=windows-1250" />
        <meta name="description" content="Poèítadlo" />
        <meta name="author" content="Jan Ondroušek - www.jonweb.cz" />
        <meta name="keywords" content="Poèítadlo" />
        <meta name="robots" content="noindex" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="pragma" content="no-cache" />
        <link rel="stylesheet" type="text/css" href="styl.css" media="screen" />
        <title>
		Poèítadlo - administrace
        </title>
</head>
<body id="main">
<?php
        if($prihlaseni) {
                echo "\t<h1>Administrace</h1>
        <form action=\"admin.php\" method=\"post\">
                <fieldset>
                        <legend>Nastavení poèítadla</legend><br />
                        <h2>Styl poèítadla:</h2>
                                <h3>Textové</h3><input type=\"radio\" name=\"styl\" value=\"1\" style=\"width: 20px; border-width: 0px; margin-top: 5px;\" " . ($nastaveni[styl] == 1 ? "checked" : "") . " /><br />
                                <h3>Grafické</h3><input type=\"radio\" name=\"styl\" value=\"2\" style=\"width: 20px; border-width: 0px; margin-top: 5px;\" " . ($nastaveni[styl] == 2 ? "checked" : "") . " />
                        <h2>Hodnota poèítadla:</h2>
                                <input type=\"text\" name=\"hodnota\" value=\"$data[celkem]\" /><br /><br />
                        <h2>Nastavení vzhledu grafického poèítadla:</h2>
                                <h3>Barva textu:</h3>
                                <div class=\"in\">#<input type=\"text\" name=\"text2\" value=\"$nastaveni[text2]\" style=\"margin: 0px 0px 0px 3px\" /></div>
                                <h3>Barva textu v okrajích:</h3>
                                <div class=\"in\">#<input type=\"text\" name=\"text1\" value=\"$nastaveni[text1]\" style=\"margin: 0px 0px 0px 3px\" /></div>
                                <h3>Barva pozadí:</h3>
                                <div class=\"in\">#<input type=\"text\" name=\"pozadi1\" value=\"$nastaveni[pozadi1]\" style=\"margin: 0px 0px 0px 3px\" /></div>
                                <h3>Barva pozadí okrajù:</h3>
                                <div class=\"in\">#<input type=\"text\" name=\"pozadi2\" value=\"$nastaveni[pozadi2]\" style=\"margin: 0px 0px 0px 3px\" /></div>
                                <h3>Barva èáry:</h3>
                                <div class=\"in\">#<input type=\"text\" name=\"cara\" value=\"$nastaveni[cara]\" style=\"margin: 0px 0px 0px 3px\" /></div>
                                <h3>Šíøka poèítadla:</h3>
                                <div class=\"in\"><input type=\"text\" name=\"sirka\" value=\"$nastaveni[sirka]\" style=\"margin: 0px 2px 0px 0px\" />px</div>
                                <h3>Výška poèítadla:</h3>
                                <div class=\"in\"><input type=\"text\" name=\"vyska\" value=\"$nastaveni[vyska]\" style=\"margin: 0px 2px 0px 0px\" />px</div>
                                <h3>Výška dolního/horního okraje:</h3>
                                <div class=\"in\"><input type=\"text\" name=\"vyska_kraje\" value=\"$nastaveni[vyska_kraje]\" style=\"margin: 0px 2px 0px 0px\" />px</div>
                                <h3>Velikost písma:</h3>
                                <div class=\"in\"><input type=\"text\" name=\"pismo\" value=\"$nastaveni[pismo]\" style=\"margin: 0px 2px 0px 0px\" />pt</div>
                        <input type=\"submit\" name=\"ok\" value=\"Uložit\" class=\"tlacitko\" style=\"margin: 30px 0px 20px 10px;\" /><br />&nbsp;&nbsp;&nbsp;<a href=\"admin.php?akce=odhlaseni\"><b>Odhlásit se</b></a><br /><br />
                </fieldset>
        </form>";
        } else {
                echo "\t<h1>Vstup do administrace</h1>
        <form action=\"admin.php\" method=\"post\">
                <fieldset>
                        <legend>Pøihlášení</legend><br />
                        <h2>Pøihlašovací jméno:</h2>
                                <input type=\"text\" name=\"login\" style=\"margin-left: 20px; width: 200px;\" />
                        <h2>Heslo:</h2>
                                <input type=\"password\" name=\"heslo2\" style=\"margin-left: 20px; width: 200px;\" /><br />
                        <input type=\"submit\" name=\"vstup\" value=\"Vstup\" class=\"tlacitko\"  style=\"margin-left: 20px;\" />$oznam
                        <div id=\"info\">Pøihlášení vyžaduje povolené cookies.</div>
                </fieldset>
        </form>";
        }
?>
</body>
</html>