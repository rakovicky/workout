<?php if (!isset($_SESSION['logged'])): ?>
    <form action="#" method="POST">
        <div class="login_input">
        <ul>
              <li><input type="submit" value="Prihlásiť" name="tlacitko"></li>
        </ul>
        </div>
      </form>
  <?php endif; ?>
 <?php

if ( isset( $_POST['tlacitko'] ) ) {
   header("Location: index.php?page=login/login");
 }
$conn = null;
?>
