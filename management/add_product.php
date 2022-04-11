<!DOCTYPE html>
<html lang="en">

  <header>
    <title>food_delivery</title>
  </header>

  <body>
  <h1>Add Product to DB: </h1>
  <?php
    if(isset($_GET['inputError'])){
        if($_GET['inputError'] == 'emptyProduct' || $_GET['inputError'] == 'emptyManagement'){
          echo '<p>Fill in ALL fields!</p>';
        }
        if($_GET['inputError'] == 'fileTooBig'){
          echo '<p>File cannot exceed '.$_GET['size'].' GB </p>';
        }
        if($_GET['inputError'] == 'imageFormart'){
          echo '<p>Only accept '.$_GET['format'].' format for upload </p>';
        }
    }
    else if(isset($_GET['error'])){
        echo '<p>Internal error</p>';
    }
    else if(isset($_GET['success'])){
      echo '<p>Successfully uploaded product to DB</p>';
    }
   ?>
  <form action="includes/add_product.minc.php" method="POST"  enctype="multipart/form-data">
     <label>Product name: </label><input name="name" type="text" required><br>
      <label>Company name: </label><input name="company" type="text" required><br>
      <label>Price: </label><input name="price" type="number" step="0.01" required><br>
      <label>ID of category: </label><input name="catId" type="number"  min="1" max="7" required><br>
      <label>Number in stock: </label><input name="inStock" type="number" min="0" required><br>
      <label>Weight in grams: </label><input name="weight" type="number" min="0"required><br><br>
      <label>Image of File </label><input name="file" type="file"><br><br>
      <button name="addProductSubmit" type="submit">Add product to Database</button>
  </form><br><br>

  <h2>Categories</h2>
  <?php
    include_once "../includes/dbhandler.inc.php";
    $sql = "SELECT * FROM foodCategories;";
    $result = mysqli_query($conn, $sql);?>
    <table>
      <tr>
        <th><h4>id:</h4></th>
        <th><h4>Name:</h4></th>
      </tr>
      <?php
    while($row=mysqli_fetch_assoc($result)){?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
      </tr>
      <?php
    }
  ?>
    </table>
  </body>
</html>
