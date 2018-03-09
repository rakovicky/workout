<section role="full-page">

<?php


if($_SESSION['user_level'] != 2)
	header('Location: index.php');

echo '<h2>Vytvoriť tému</h2>';
if($_SESSION['signed_in'] == false)
{
	//užívateľ nie je prihlásený
	echo 'Je nám ľúto, musíte byť <a href="">prihlásený</a> aby ste mohli zakládať témy.';
}
else
	{
		echo '
			<form method="post" action="">
 	 			Nazov: <input type="text" name="post_name" /></br>
 				<textarea name="post_content" /></textarea><br /> <br/>
				<input type="submit" value="Vytvoriť príspevok" />
			</form>';
	}


if(isset($_POST['post_name']) && isset($_POST['post_content']))
{
	$post_name=$_POST['post_name'];
	$post_content=$_POST['post_content'];

	if( Database::query("INSERT INTO posts VALUES('0', :post_content, :post_date, :post_name, '0')",[":post_content" => $post_content ,":post_date" => time(), ":post_name" => $post_name]))

	{
				echo 'Úspešne pridany prispevok';
			}
			else
			{
				echo 'Niečo sa pokazilo. Skúste to prosím neskôr.';
			}
}
?>

<?php

$posts = Database::fetchAll("SELECT * FROM posts ORDER BY post_id DESC", []);

function cut_article($string, $count) {
		if (strlen($string) > $count)
			return substr($string, 0, $count);
		else
			return $string;
	}
foreach($posts as $post) {
	echo '<div class="post">';
	echo '<h2>' . $post['post_name'] . '</h2>';
	echo '<p>' . cut_article($post['post_content'], 500) . '</p>';
	echo '<p>' . date("d.m.Y", $post['post_date']) . '</p>';
	echo '<a href="delete_post.php?id=' . $post['post_id'] . '" style="color:blue">ZMAZAT!</a>';
	echo '</div>';
}

?>



