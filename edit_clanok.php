<?php

	require_once("config.php");

	$id = $_GET['id'];

	if(!empty($id))
	{
		$sql = $conn->prepare("SELECT * FROM clanky WHERE id = :id");
		$sql->execute([":id" => $id]); 
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<br />
		<form method="POST">
			<input type='text' name='nadpis' value="<?= $result['nadpis']; ?>"><p />
			<textarea rows="15" cols="100" name='clanok'><?= $result['clanok']; ?> </textarea> <p />
			<input type="submit" name="button" value="Odoslať">
		</form>
		<?php
		if (isset ($_POST['button'])) 
		{
			$nadpis = $_POST['nadpis'];
  			$clanok = $_POST['clanok'];
  			$sql = "UPDATE clanky SET nadpis = '$nadpis', clanok = '$clanok' WHERE id = $id";
    		$conn->exec($sql);
    			header('Location: index.php?page=index2');
			} else {
    			echo "";
			  }
	}
?>