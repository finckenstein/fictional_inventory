<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style/select_category.sty.css">
    <script src="cart.js"></script>
  </head>

<body>
  <?php
    include_once "includes/dbhandler.inc.php";
    $sql = "SELECT * FROM foodCategories;";
    $result = mysqli_query($conn, $sql);?>
    <ul>
    <?php
    while($row=mysqli_fetch_assoc($result)){?>
      <li><a href="select_products.php?category=<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></li>
    <?php
    }
    ?>
  </ul>
  <aside id="viewItems" style="display: none;">
    <div class="cartTop">

      <div class="cartTitle">
        <h3>Items in Cart</h3>
      </div>

      <div class="close">
        <button onclick="closeCart()">X</button>
      </div>
      <div id="totalPrice"></div>
      <div id="basketList"></div>

      <div class="toBasket">
        <a href="basket.php"><button type="button">Proceed to Payment</button></a>
      </div>
    </div>
  </aside>
<?php

if(isset($_GET['category'])){?>
  <?php
  require 'includes/dbhandler.inc.php';
  //create template
  $sql = "SELECT P.name, P.price, IMG.id, IMG.productID
  FROM product P, foodCategories FC, productImg IMG
  WHERE FC.name=? AND P.catId=FC.id AND P.id=IMG.productID;";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: index.php?error=sqlerror");
  }
  else{
      mysqli_stmt_bind_param($stmt, "s", $_GET['category']);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      ?>
      <img id="viewCart" src="cart.png" onclick="viewCart()"/>
      <?php

      while($rows=mysqli_fetch_assoc($result)){?>

        <div class="productInfo">
          <div class="title">
            <h3><?php echo $rows['name'];?></h3>
          </div>

          <div class="image">
            <img src="product_image/<?php echo $rows['id'];?>.jpg" alt='image of product'>
          </div>

          <div class="price">
            <p>S./ <?php echo $rows['price'];?></p>
          </div>

          <div class="addCart" id="cart_<?php echo $rows['productID']; ?>" >
            <img src="cart.png" onclick="addToCart('<?php echo $rows['productID'];?>', '<?php echo $rows['name'];?>', '<?php echo $rows['price'];?>', '<?php echo $rows['id'];?>')"/>
          </div>

          <div class="addAndSubtract">
            <button id="<?php echo "subtract_".$rows['productID']; ?>" onClick="subtract('<?php echo $rows['productID']; ?>', '<?php echo "add_".$rows['productID']; ?>', '<?php echo "subtract_".$rows['productID']; ?>')" style="opacity: 0.5;"> - </button>
            <span id="<?php echo $rows['productID']; ?>"> 1 </span>
            <button id="<?php echo "add_".$rows['productID']; ?>" onClick="add('<?php echo $rows['productID']; ?>', '<?php echo "add_".$rows['productID']; ?>', '<?php echo "subtract_".$rows['productID']; ?>')"> + </button>
          </div>

        </div>
        <?php
      }
  }
}?>
</body>

</html>
