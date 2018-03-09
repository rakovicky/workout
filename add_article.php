<html>
<head>
  <script src="tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: 'textarea'
  });
  </script>
</script>
</head>
<body>
<br />
<form method='POST'>
 Nadpis článku <input type='text' name='nadpis' id='nadpis' /> <br />
 Text: <br />
  <textarea rows="15" cols="50" name='clanok' id='clanok'></textarea><br />
  <input type='hidden' name='articleid' value='<? echo $_GET["id"]; ?>' />
  <input type='submit' name='button' value='Odoslat' />
</form>
</body>
</html>

<?php
include_once('config.php');
 $meno = $_SESSION['name'];
if ( isset( $_POST['button'] ) ) {
  $nadpis = $_POST['nadpis'];
  $clanok = $_POST['clanok'];
    if (empty($nadpis))
      {
        echo "Musis zadať nadpis";
      }
    else{
  $sql = "INSERT INTO `clanky` (`nadpis`, `clanok`, `name`) 
          VALUES ('$nadpis', '$clanok', '$meno')";
    $conn->exec($sql);
    header('Location: index.php');
    echo "Článok pridany";
}
}
$conn = null;
?>