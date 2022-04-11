<?php
if(isset($_POST['loginSubmit'])){
    require 'dbhandler.inc.php';

    $mail = $_POST['mail'];
    $pwd = $_POST['pwd'];

    if(empty($mail) || empty($pwd)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else{
      $sql = "SELECT * FROM Users WHERE email=?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../index.php?error=sqlerror");
      }
      else{
          mysqli_stmt_bind_param($stmt, "s", $mail);
          mysqli_stmt_execute($stmt);

          $result = mysqli_stmt_get_result($stmt);
          if($row = mysqli_fetch_assoc($result)) {
              $pwdCheck = password_verify($pwd, $row['pwd']);
              if($pwdCheck == false){
                  header("Location: ../index.php?error=wrongPassword");
                  exit();
              }
              else if($pwdCheck == true){
                  session_start();
                  //$_SESSION['userId'] = $row['id'];
                  $_SESSION['email'] = $row['email'];
                  $_SESSION['first'] = $row['firstName'];
                  $_SESSION['last'] = $row['lastName'];

                  header("Location: ../index.php?login=success");
                  exit();
              }
              else{
                  header("Location: ../index.php?error=wrongPassword");
                  exit();
              }
          }
          else{
              header("Location: ../index.php?error=userNotFound");
          }
      }
    }
}
else{
    header("Location: ../index.php");
    exit();
}
