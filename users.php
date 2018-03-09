<div class="articleBG">
<?php
include_once('config.php');	
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$sql = $db->query('SELECT * FROM users');
	
  	foreach ($sql as $u)
{
    ?>  	
    	<table>
    	   <tr >
            <td width="50"><div style="font-weight: bold;"></style>Meno: </div></td>
            <td width="200"><?php echo ($u['name']);?></td>
            <td>Upraviť</td>
            <td>Odstrániť</td>
         </tr>
         <hr />
      	 <tr>
            <td><div style="font-weight: bold;"></style>Email: </div></td> 
        		<td><?php echo ($u['email']);?></td>
            <td><?php echo '<a href="index.php?page=edit_user&id=' . $u['id'] . '"><img src="edit1.png" style="height: 15%; width: 15%;"></a>';?></td>
            <td><?php echo '<a href="index.php?page=delete_user&id=' . $u['id'] . '"><img src="delete.png" style="height: 15%; width: 15%;"></a>'; ?></td> 
       	 </tr>
          <tr>
            
          </tr>
       	</table>
<?php } 
?>
</div>