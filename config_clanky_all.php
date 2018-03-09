<?php
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->query('SET NAMES utf8');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$query = $conn->prepare("SELECT * FROM clanky ORDER BY id DESC");
$query->execute();
   $all = $query->fetchAll(PDO::FETCH_ASSOC);
?>
