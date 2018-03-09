<?php
	session_start();
	session_destroy();
	unset($_SESSION['logged']);


	if(!isset($_SESSION['logged'])) {
		header('Location: index.php');
	} else {
		echo $_SESSION['logged'];
	}
?>