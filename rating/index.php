<?php
if(!isset($_SESSION['user_id'])){
  $_SESSION['user_id'] = rand(0, 1024);
}
?>

  <head>
    <link rel="stylesheet" href="rating/css/Fr.star.css" />
    <script src="rating/js/jquery-2.2.0.min.js"></script>
    <script src="rating/js/Fr.star.js"></script>
    <script src="rating/js/rate.js"></script>
  </head>
    <?php

    require_once "rating/config.php";

    $star->id = "index_page";
    echo $star->getRating("userChoose size-2", "html", $_GET['id']) . "</p>";
    echo "<p>Tvoje hodnotenie : ";
    echo $star->userRating($_SESSION['user_id'], $_GET['id']);
    echo "<p>Celkové hodnotenie : ";
    echo $star->getRatingSum($_GET['id']);
    ?>