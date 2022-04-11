<?php
  $dbServername = "localhost";//should only be changed when actually dealing with online DB
  $dbUsername = "root"; //to real values
  $dbPassword = "";
  $dbName = "food_delivery";

  $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

  if(!$conn){
    die('Connection failed '.mysqli_connect_error());

  }
