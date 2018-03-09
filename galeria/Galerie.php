<?php
class Albumy
{
    private $slozka;
    private $sloupcu;
    private $soubory = array();
    
    
    public function __construct($slozka, $sloupcu)
    {
        $this->slozka = $slozka;
        $this->sloupcu = $sloupcu;
    }
    
    
    public function nacti()
    {
        $slozka = dir($this->slozka);

        while ($polozka = $slozka->read()) 
        {
            if (is_file($this->slozka . '/' . $polozka) && strpos($polozka, '_nahled.'))
            {
                $this->soubory[] = $polozka;
            }
        }
        $slozka->close();
    }
    
    
    public function vypis()
    {
        foreach ($this->soubory as $soubor)
        {
            $nahled = $this->slozka . '/' . $soubor;
            $obrazek = $this->slozka . '/' . str_replace('_nahled.', '.', $soubor) ;

            echo('<div class="concrete-photo">
                <a href="' . htmlspecialchars($obrazek) . '" rel="lightbox[galerie]">
                    <img src="' . htmlspecialchars($nahled) . '" alt="">
                </a>');

            if (isset($_SESSION['logged']) && $_SESSION['auth'] == 2) {
                echo('<div class="iksko"><a href="index.php?page=galeria&foto=' . htmlspecialchars($obrazek) . '">[X]</a></div></div>');
            }
            else{
                   echo "</div>";
            }
        }
    }
    
    
}

class Galerie {

      public function __construct($slozka, $sloupcu) {
        $this->slozka = $slozka;
        $this->sloupcu = $sloupcu;
    }

    private $dirs = array();

    public function nacti(){
  $Mydir = 'obrazky/';

foreach(glob($Mydir.'*', GLOB_ONLYDIR) as $dir) {
    $dir = str_replace($Mydir, '', $dir);
    echo '<div class="album-nahlad">';
        echo '<div class="nadpis"><a href="index.php?page=galeria&dir=' . $dir . '">' . $dir . '</a></div>';
        $search_dir = "obrazky/" . $dir;
        $images = glob("$search_dir/*.*");
        sort($images);

        // Image selection and display:

        //display first image
        if (count($images) > 0) { // make sure at least one image exists
            $img = $images[0]; // first image
            echo "<div class='imgprvy'><a href='index.php?page=galeria&dir=" . $dir . "'><img style='border-radius: 10px;' src='$img' /></a></div> ";
            echo '</div>';
        } else {
            // possibly display a placeholder image?
            echo "<div class='empty' style='text-align:center;'> Prázdny album!";
        }




} 
    
    }
    public function vypis() {
      
        foreach ($this->dirs as $dirname) {
            echo $dirname;
        }
    }
    
}
?>