<?php

	require_once("config.php");

	$id = $_GET['id'];

	if(!empty($id))
	{
		$sql = $conn->prepare("DELETE FROM komenty WHERE id = :id");
		$sql->execute([":id" => $id]); 
		function refresh() {
			window.location.reload();
		}

		header('Location: index.php?page=article&id=' . $_GET['aid']);
	}

?>