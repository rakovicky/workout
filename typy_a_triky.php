<div class="images">
<div class="articleBG">
 <?php
 include_once('config_clanky_all.php');
    $i = 1;
    foreach($all as $article) { 
		   //echo '<div class="article' . $i . '">';      
		   echo "<div class='nadpis1'>";
           echo '<h2><a href="index.php?page=article&id=' . $article['id'] . '">' . $article['nadpis'] . '</a>'; 
           		if (isset($_SESSION['logged'])){
                    if ($_SESSION['auth'] == 2){
                      	echo '<a href="delete_clanok.php?id=' . $article['id'] . '"><img src="delete.png" title="Zmazať" style="height: 3%; width: 3%;"></a>';
		   				echo '<a href="index.php?page=edit_clanok&id=' . $article['id'] . '"><img src="edit.png" title="Upraviť" style="height: 3%; width: 3%;"></a></h2>';
                    }
                }
           echo "</h2>";
           echo "</div>";
           echo cut_article($article['clanok'], 400);
           echo '<hr>';
           echo '<br></br>';
        //echo '</div>';
       $i++;
    }
?>

</div>
</div>