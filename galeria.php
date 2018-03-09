
<head>
    <link rel="stylesheet" href="styl.css" type="text/css" />
    <link rel="stylesheet" href="css/lightbox.css" type="text/css" />
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <script src="js/jquery.smooth-scroll.min.js"></script>
    <script src="js/lightbox.js"></script>
</head>
<?php 

if (isset($_GET['dir'])) {
    
        echo '<div class="articleBG">';
    ;
       if(isset($_GET['foto'])) {
            $nahlad = explode('.', $_GET['foto'])[0] . '_nahled.' . explode('.', $_GET['foto'])[1];
            unlink($_GET['foto']);
            unlink($nahlad);
            header('index.php?page=galeria');
        }


             if (isset($_SESSION['logged'])){
                if (($_SESSION['auth'] == 2)){
                    echo '<div class="nadpis1"><a href="index.php?page=upload&dir=' . $_GET['dir'] . '">Pridať ďalsie</a></div>';
                }
            }
            require_once('galeria/Galerie.php');
        
            $galerie = new Albumy('obrazky/' . htmlspecialchars($_GET['dir']), 4);        
            $galerie->nacti();
            $galerie->vypis();
    echo '</div>';
}

else {
    echo '<div class="articleBG-album">';
           if(isset($_GET['foto'])) {
            $nahlad = explode('.', $_GET['foto'])[0] . '_nahled.' . explode('.', $_GET['foto'])[1];
            unlink($_GET['foto']);
            unlink($nahlad);
            $path .= $_GET['dir'] . '/';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
            require_once('galeria/Galerie.php');
        
            $galerie = new Galerie('/obrazky', 4);        
            $galerie->nacti();
            $galerie->vypis();
    echo '</div>';
}
?>

