<?php

	require_once("config.php");

	$id = $_GET['id'];

	if(!empty($id))
	{
		$sql = $conn->prepare("DELETE FROM clanky WHERE id = :id");
		$sql->execute([":id" => $id]); 

		header('Location: index.php');
	}

?>