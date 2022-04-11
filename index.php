<!DOCTYPE html>
<html lang="en">

  <header>
    <title>food_delivery</title>
  </header>

  <body>
      <?php
      require "header.php";

      if(isset($_SESSION['first'])){?>
            <p>You are logged in</p>
      <?php
      }
      else{?>
          <p>You are logged out</p>
          <a href="select_products.php">View products</a>
      <?php
      }
      require "footer.php";
      ?>
  </body>
</html>
