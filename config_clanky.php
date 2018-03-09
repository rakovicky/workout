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

$query = $conn->prepare("SELECT * FROM clanky ORDER BY id DESC LIMIT 3");
$query->execute();
   $test = $query->fetchAll(PDO::FETCH_ASSOC);


function escape($string, $count) {
		if (strlen($string) > $count) {
			return substr($string, 0, $count);
		}
		else {
			return $string;
		}
	}
?>
