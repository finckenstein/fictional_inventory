<?php
    require "header.php"
?>

<main>
<div class="wrapperMain">
  <h1>Sign Up</h1>
  <form action="includes/sign_up.inc.php" method="POST">
    <label>First name: </label><input type="text" name="first" placeholder="First Name"></input><br>
    <label>Last name: </label><input type="text" name="last" placeholder="Last name"></input><br>
    <label>Email: </label><input type="text" name="email" placeholder="E-mail"></input><br>
    <label>Password: </label><input type="password" name="pwd" placeholder="Password"></input><br>
    <label>Confirm Password: </label><input type="password" name="pwdRepeat" placeholder="Confirm password"></input><br>
    <button type="submit" name="signUpSubmit">Sign Up</button>
  </form>

</main>

<?php
  require "footer.php"
?>
