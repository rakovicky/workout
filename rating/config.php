<?php
require_once __DIR__ . "/Fr.star.php";

$star = new \Fr\Star(array(
  "db" => array(
    "host" => "localhost",
    "port" => 3306,
    "username" => "skstreet-worko81",
    "password" => "123456",
    "name" => "skstreet-workout",
    "table" => "fr_star"
  )
));
