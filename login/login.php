    <?php

  if ( isset( $_POST['prihlas'] ) ) {
  $meno = $_POST['meno'];
  $heslo = hash('sha256', $_POST['heslo']);

  $sql = $conn->prepare("SELECT * FROM users WHERE name = :name AND pass = :pass");
  $sql->execute([":name" => $meno, ":pass" => $heslo]);  
  $result = $sql->fetch(PDO::FETCH_ASSOC);

  $id = $result['id'];
  $name = $result['name'];
  $email = $result['email'];
  $auth = $result['auth'];

  if ($sql->rowCount() == 1) {
    // echo "Uspesne prihlasnie";
    $_SESSION['logged'] = 1;
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $meno;
    $_SESSION['email'] = $email;
    $_SESSION['auth'] = $auth;
    header("Location: index.php");


  } else {
       //echo "Nespravne meno alebo heslo";
  }

  if ($result['auth'] == 2 ) {
    //echo 'Si prihlásený ako admin';
    header("Location: index.php");
  }
  else{
    $error = 'Neplatné prihlásenie';
    //header("Location: index.php");
  } 
}
$conn = null;

?>
  <head>
    <link rel="stylesheet" href="login/css/style.css">
  </head>
  <body>

    <div class="login-wrap">
  <h2>Prihlásenie</h2>
  <div class="form">
  <form action="#" method="POST">
    <input type="text" placeholder="Meno" name="meno" />
    <input type="password" placeholder="Heslo" name="heslo" />
    <button name="prihlas"> Prihlásiť </button>
    <div style="all: none; text-align: center;color: red;font-family: 'PT Sans',sans-serif;"><?php if (isset($error)): echo $error; endif;?></div>
    <a href="index.php?page=reg/reg"> <p> Ešte nemás učet? Zaregistruj sa! </p></a>

  </form>
  </div>
</div>
    <script src='https://code.jquery.com/jquery-1.10.0.min.js'></script>
    <script src="login/js/index.js"></script>
  </body>

  <div style="width:100%;height:120px;display:block;"></div>

  