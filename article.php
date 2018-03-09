<div class="images">
<div class="articleBG">

<?php
	include('config.php');

	$db = $conn->prepare("SELECT * FROM komenty");
	$db->execute();
	$comments = $db->fetchAll();
	$last_id = 0;

	foreach($comments as $comment)
	{
		$last_id = $comment['id'];
	}

	$last_id++;

	if(isset($_POST['koment'])) {
  	$meno = $_SESSION['name'];

		$db = $conn->prepare("SELECT * FROM nadavky");
		$db->execute();
		$nadavky = $db->fetchAll();

		$vulgar = [];

		foreach($nadavky as $nadavka)
		{
			if(strpos($_POST['koment'], $nadavka['nadavka']) >= 0)
			{
				array_push($vulgar, $nadavka['nadavka']);
			}
		}

		$koment = str_replace($vulgar, "******", $_POST['koment']);
				
  		$id_clanok = $_GET['id'];
  		if (empty($koment))
  		{
  			echo 'Komentár nemôže byť prázdny'; 
  		}
  		else {
  			$sql = "INSERT INTO `komenty` (`name`, `koment`, `id_clanok`) 
        		    VALUES ('$meno', '$koment', '$id_clanok')";
    		$conn->exec($sql);
    	}
  	
  }	

	if (isset($_GET['id'])) {
		$id_from_get = $_GET['id'];
		$query_article = $conn->prepare("SELECT * FROM clanky WHERE id = :id");
		$query_article->execute([":id" => $id_from_get]);
    	$result = $query_article->fetch(PDO::FETCH_ASSOC);

						echo '<h2>'; 
						echo $result['nadpis'];
						
						echo '</h2>';
						echo '<div class="obr_clanky">';
						echo $result['clanok']; 
				 		echo '</div>';
						echo '<br></br>';


include('rating/index.php');

echo '<div class="textB">Komenty:</div>';
echo '<div class="commentBG">';
$query1 = $conn->prepare("SELECT * FROM komenty WHERE id_clanok = :id_from_get");
$query1->execute([':id_from_get' => $id_from_get]);
if(isset($auth)) $_SESSION['auth'] = $auth;
while ($result = $query1->fetch(PDO::FETCH_ASSOC)) {
	echo "<table>";
	echo "<div class='single_comment'>";
	echo "<a name=\"" . $result['id'] . "\"></a>";
	echo $result['koment'];
	if (isset($_SESSION['auth']) && $_SESSION['auth'] == 2){
		echo '<a href="delete_comment.php?id=' . $result['id'] . '&aid=' . $_GET['id'] . '"><img src="delete.png" style="height: 2%; width: 2%;"/></a>';
		echo "</div>";
		echo "</table>";
				}

		else{
	echo "<br />";
	echo "</div>";
	echo "</table>";
}

		 	
    }
   }
?>
<div class="test">

<script>
	/*
	jQuery(document).ready(function($) {
		$("#koment").keydown(function(event) {
		    if (event.keyCode == 13) {
		        this.form.submit();
		        return false;
		     }

		});
	});*/
</script>
<br>

<?php
	 if (!isset($_SESSION['logged'])){
		echo "Pre pridanie komenáru sa musíte najskôr <a href='index.php?page=login/login'>prihlásiť</a>";
	}
	else{ ?>
<?php if (isset($_SESSION['auth']) && (($_SESSION['auth'] == 2) OR ($_SESSION['auth'] == 1))){ ?>
<form action="index.php?page=article&id=<?= $_GET['id'] ?>#<?= $last_id ?>" id="koment_form" method='POST'>
  <textarea name='koment' rows="4" cols="50" id="koment" placeholder="Napíš komentár"></textarea><br />
  <input type="submit" value="Odoslať">
  <input type='hidden' name='articleid' value='<? echo $_GET["id"]; ?>' />
</form>


<?php
}
}
  echo '</div>';
  echo '</div>';
 
  
$conn = null;
?>	

</div>
</div>