<?php

	session_start();
	require_once('../config.php');

	$db = $conn->prepare("SELECT * FROM questions WHERE id = ?");
	$db->bindParam(1, $_GET['id']);
	$db->execute();
	$result = $db->fetch();

	if(strpos($result['user_id'], $_SESSION['id']) !== false)
        return;

    $result['max']++;

    $value = explode(',', $result['values']);
    $value[$_GET['choice']]++;
    $result['values'] = implode(',', $value);

	unset($value);

	$value = explode(',', $result['user_id']);
	unset($value[sizeof($value) - 1]);
	array_push($value, $_SESSION['user_id']);
    $result['user_id'] = implode(',', $value);
	$result['user_id'] .= ',';


	$db = $conn->prepare("UPDATE questions SET max = ?, `values` = ?, user_id = ? WHERE id = ?");
	$db->bindParam(1, $result['max']);
	$db->bindParam(2, $result['values']);
	$db->bindParam(3, $result['user_id']);
	$db->bindParam(4, $_GET['id']);
	$db->execute();


?>