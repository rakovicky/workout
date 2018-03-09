<div class="articleBG">
<?php

	require_once("config.php");

	$id = $_GET['id'];

	if(!empty($id))
	{
		$sql = $conn->prepare("SELECT * FROM users WHERE id = :id");
		$sql->execute([":id" => $id]); 
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		?>
		<br />
		<form method="POST">
			Meno:
				<input type='text' name='meno' value="<?= $result['name']; ?>"><p />
			Email:
				<input type='text' name='email' value="<?= $result['email']; ?>"><p />
			Oprávnenie:
				<input type='text' name='auth' value="<?= $result['auth']; ?>"><p />
				<div style='font-size:85%;'>1 = Bežný uživateľ, 2 = Administrátor</div> <p />
			</tr>		
				<input type="submit" name="button" value="Odoslať">
				<input type="submit" name="back" value="Naspäť"></a>
		</form>
				<?php
				if (isset($_POST['back'])){
					header('Location: index.php?page=users');	
				} else{
		if (isset ($_POST['button'])) 
		{
			$meno = $_POST['meno'];
  			$email = $_POST['email'];
  			$auth = $_POST['auth'];
  			$sql = "UPDATE users SET name = '$meno', email = '$email', auth = '$auth' WHERE id = $id";
    		$conn->exec($sql);
    			header('Location: index.php?page=users');
			} else {
    			echo "";
			  }

		//header('Location: index2.php');
	}
	}
?>
</div>