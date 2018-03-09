
  <?php
include('config.php');

    if ( isset( $_POST['reg'] ) ) {
        $errMsg = '';
        $meno = ($_POST['meno']);
        $heslo = ($_POST['heslo']);
        $heslo2 = ($_POST['heslo2']);
        $email = ($_POST['email']);
        
        if(isset($_POST['meno'])) 
        {
          if(empty($_POST['meno'])){
              $errMsg .= "<p>Nezadali ste meno</p>";
          }
          else{
          if(!ctype_alnum($_POST['meno'])) 
          { 
            $errMsg .= '<p>Nick môže obsahovať len písmená a číslice</p>';
          }
          if(strlen($_POST['meno']) > 30)
          {
            $errMsg .= '<p>Nick nemôže byť dlhší ako 30 znakov</p>';  
          }
        }

      } else {
        
          $errMsg .= '<p>Musíš zadať nick</p>';
        
    }
        if(isset($_POST['heslo'])) 
        {
          if(empty($_POST['heslo'])){
              $errMsg .= "<p>Nezadali ste heslo</p>";
          }
          else{
          if (strlen($_POST['heslo']) <= 5) {
            $errMsg .= '<p>Heslo musí mať aspoň 6 znakov</p>';
          }
          if($_POST['heslo'] != $_POST['heslo2'])
          {
           $errMsg .= '<p>Heslá sa nezhodujú</p>';
          }
          $str = hash('sha256', $_POST['heslo']);
        }
        }
        else
        {
          $errMsg .= '<p>Musíš zadať heslo</p>';
        }
        $email = $_POST['email'];
          if(isset($_POST['email'])) 
          {
            if(empty($_POST['email'])){
              $errMsg .= "<p>Nezadali ste email</p>";
            } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg .= '<p>Nesprávny email</p>'; 
            }
            }
            } 

        if($errMsg == ''){
            $sql = "INSERT INTO `users` (`name`, `pass`, `email`) 
            VALUES ('$meno', '$str', '$email')";
            $conn->exec($sql);
                $succes = "Uspesna registracia";
            } else {
                //echo $errMsg;
            }
         }
       $conn = null;
?>

  <head>
    <link rel="stylesheet" href="reg/css/style.css">
  </head>
  <body>
    <div class="login-wrap">
  <h2>Registrácia</h2>
  <form action="#" method="POST">
  <div class="form">
    <input type="text" name="meno" placeholder="Meno" />
    <input type="password" name="heslo" placeholder="Heslo"/>
    <input type="password" name="heslo2" placeholder="Kontrola hesla"/>
    <input type="email" name="email" placeholder="Email"/>
    <button name="reg"> Registrovať </button>
    <div style="all: none; text-align: center;color: red;font-family: 'PT Sans',sans-serif;">
    <?php if(!empty($errMsg)): echo $errMsg; endif;?> </div> <div style="all: none; text-align: center;color: green;font-family: 'PT Sans',sans-serif;"><?php if(isset($succes)): echo $succes; endif; echo "</div>"; ?>
</form>
</div>
    <script src='https://code.jquery.com/jquery-1.10.0.min.js'></script>
    <script src="login/js/index.js"></script>
  </body>

  <div style="width:100%;height:40px;display:block;"></div>
