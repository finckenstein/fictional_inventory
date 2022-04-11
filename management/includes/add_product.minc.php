<?php
    function insertProduct(){
       require "../../includes/dbhandler.inc.php";
       $sql = "INSERT INTO product(name, company, price, catId, unitsInStock, weightPerUnit) VALUES(?,?,?,?,?,?);";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../add_product.php?error=insertProduct");
           exit();
       } else{
           mysqli_stmt_bind_param($stmt, "ssdiii", $_POST['name'], $_POST['company'], $_POST['price'], $_POST['catId'], $_POST['inStock'], $_POST['weight']);
           mysqli_stmt_execute($stmt);
           //echo "Successfully inserted product"."<br>";
       }

       $productId = mysqli_insert_id($conn);

       $sql = "INSERT INTO productImg(productId) VALUES(?);";
       $stmt = mysqli_stmt_init($conn);
       if(!mysqli_stmt_prepare($stmt, $sql)){
           header("Location: ../add_product.php?error=insertImage");
           exit();
       }
       else{
           mysqli_stmt_bind_param($stmt, "i", $productId);
           mysqli_stmt_execute($stmt);
           //echo "Successfully inserted productImage"."<br>";
       }
       $imgName = mysqli_insert_id($conn);
       $insertedImageTableRow = array($imgName,$productId);
       return $insertedImageTableRow;
    }

    function deleteProduct($productId){
      require "../../includes/dbhandler.inc.php";

      $sql = "DELETE FROM product WHERE id=?;";
      $stmt = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../add_product.php?error=deleteProduct");
          exit();
      }
      else{
          mysqli_stmt_bind_param($stmt, "i", $productId);
          mysqli_stmt_execute($stmt);
          //echo "Successfully deleted product"."<br>";
      }

      $sql = "DELETE FROM productImg WHERE productID=?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../add_product.php?error=deleteInInventory");
          exit();
      }
      else{
          mysqli_stmt_bind_param($stmt, "i", $productId);
          mysqli_stmt_execute($stmt);
          //echo "Successfully deleted productImage"."<br>";
      }
    }

    if(isset($_POST['addProductSubmit'])){

      if(empty($_POST['name']) || empty($_POST['company']) || empty($_POST['price']) || empty($_POST['catId']) || empty($_POST['weight'])) {
          header("Location: ../add_product.php?inputError=emptyProduct");
          exit();
      }

      //$file = $_FILES['file'];

      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));

      if($fileActualExt == 'jpg'){
        if($fileError === 0){
          if($fileSize < 700000){  //Works with kilobytes
            $imgIDandproductID = insertProduct();
            $fileNameNew = $imgIDandproductID[0].".jpg"; //GIVES FILE UNIQUE NAME->ID OF itself
            $fileDestination = "../../product_image/".$fileNameNew;

            if(move_uploaded_file($fileTmpName, $fileDestination)){ //move file to location went right
              header("Location: ../add_product.php?success=upload");
              exit();
            }
            else{
              deleteProduct($imgIDandproductID[1]);
              header("Location: ../add_product.php?error=couldntMoveFileToLocation");
              exit();
            }
          }
          else{
            header("Location: ../add_product.php?inputError=fileTooBig&size=0.7");
            exit();
          }
        }
        else{
          header("Location: ../add_product.php?error=errorUploadingFile");
          exit();
        }
      }
    else{
      header("Location: ../add_product.php?inputError=imageFormart&format=jpg");
      exit();
    }
  }
?>
