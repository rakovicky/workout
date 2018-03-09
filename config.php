<?php
$servername = "localhost:3306";
$username = "skstreet-worko81";
$password = "123456";
$dbname = "skstreet-workout";
	try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query('SET NAMES utf8');
    } catch(PDOException $e) {
      echo $e->getMessage();
    }

//	session_start();
?>