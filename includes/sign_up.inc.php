<?php

if(isset($_POST['signUpSubmit'])) { //user got here through the submit button!!
  require 'dbhandler.inc.php';

  $first = $_POST['first'];
  $last = $_POST['last'];
  $email = $_POST['email'];
  $pwd = $_POST['pwd'];
  $pwdRepeat = $_POST['pwdRepeat'];

  //TODO: Check if the email is valid!

  if(empty($first) || empty($last) || empty($email) || empty($pwd) || empty($pwdRepeat)){
      header("Location: ../sign_up.php?error=emptyfields&first=".$first."&last=".$last."&mail=".$email);
      exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last))){
      header("Location: ../sign_up.php?error=invalidMailAndFirstLast");
      exit();
  }
  else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../sign_up.php?error=invalidMail&first=".$first."&last=".$last);
      exit();
  }
  else if(!preg_match("/^[a-zA-Z]*$/", $first)){
      header("Location: ../sign_up.php?error=invalidFirst&last=".$last."&mail=".$email);
      exit();
  }
  else if(!preg_match("/^[a-zA-Z_ ]*$/", $last)){
      header("Location: ../sign_up.php?error=invalidLast&first=".$first."&mail=".$email);
      exit();
  }
  else if($pwd === $pwdRepeat && strlen($pwd) < 8){
      header("Location: ../sign_up.php?error=passwordTooShort&first=".$first."&last=".$last."email=".$email);
      exit();
  }
  else if($pwd !== $pwdRepeat){
      header("Location: ../sign_up.php?error=invalidPassword&first=".$first."&last=".$last."email=".$email);
      exit();
  }
  else{

      $sql = "SELECT id FROM Users WHERE email = ?;";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../sign_up.php?error=sqlerror");
          exit();
      }
      else{
          mysqli_stmt_bind_param($stmt, "s", $email);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultCheck = mysqli_stmt_num_rows($stmt);
          if($resultCheck > 0){
              header("Location: ../sign_up.php?error=emailTaken&first=".$first."&last=".$last);
              exit();
          }
          else{
              $sql = "INSERT INTO Users(firstName, lastName, email, pwd) VALUES(?, ?, ?, ?) ";
              $stmt = mysqli_stmt_init($conn);

              if(!mysqli_stmt_prepare($stmt, $sql)){
                  header("Location: ../sign_up.php?error=sqlerror");
                  exit();
              }
              else{
                  $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

                  mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $email, $hashpwd);
                  mysqli_stmt_execute($stmt);

                  header("Location: ../index.php?signUp=success");
                  exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
}
else{
  header("Location: ../sign_up.php");
  exit();
}
