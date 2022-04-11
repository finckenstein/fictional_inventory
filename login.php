<!DOCTYPE html>
<html lang="en">

  <header>
    <title>Login</title>
  </header>

  <body>
    <h1>Login</h1>

    <form action="includes/login.inc.php" method="POST">
      <label>E-mail: </label><input type="text" name="mail" placeholder="Email"></input><br>
      <label>Password: </label><input type="password" name="pwd" placeholder="password"></input><br>
      <button type="submit" name="loginSubmit">Login</button>
    </form>

    <form action="sign_up.php" method="POST">
      <button type="submit" name="signUp">Sign Up</button>
    </form>

  </body>
</html>
