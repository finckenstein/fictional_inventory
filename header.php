<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/select_category.sty.css">
  </head>
</html>

<?php
session_start();

if(isset($_SESSION['first'])){?>
    <form action="includes/logout.inc.php" method="POST">
      <button type="submit" name="logout-submit">Logout</button>
    </form>

<?php
}
else{?>
    <form action="login.php" method="POST">
      <button type="submit" name="loginSubmit">Login</button>
    </form>
    <form action="sign_up.php" method="POST">
      <button type="submit" name="signUp">Sign Up</button>
    </form>
<?php
}
?>

</html>
