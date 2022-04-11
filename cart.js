var shoppingCart = new Array();

class Cart{
  constructor(productID, quantity, productName, productPrice, imageID) {
      this.product = productID;
      this.quantity = quantity;
      this.name = productName;
      this.price = productPrice;
      this.imageID = imageID;
    }
}

function createTitle(i, productInfo){
  var name = document.createElement("h5");
  name.appendChild(document.createTextNode(shoppingCart[i].name));
  productInfo.appendChild(name);
}

function createRemoveButton(i, productInfo){
  var removeElement = document.createElement("button");
  removeElement.textContent = "X";
  var productID = shoppingCart[i].product;
  productInfo.appendChild(removeElement);

  removeElement.onclick = function(i, productID){
      return function(){
          shoppingCart.splice(i, 1);
          closeCart();
          viewCart();
          document.getElementById("cart_"+productID).style.backgroundColor = "white";
        }
  }(i, productID);
}

function totalPriceOverview(){
    var divPrice = document.createElement("div");
    divPrice.setAttribute("id", "overallPrice");

    var p = document.createElement("p");
    var overallPrice = 0;

    for(var i=0; i<shoppingCart.length; ++i){
        overallPrice = overallPrice + (shoppingCart[i].price * shoppingCart[i].quantity);
    }
    p.appendChild(document.createTextNode("Overall\u00A0price:\u00A0S./\u00A0"+overallPrice));
    divPrice.appendChild(p);
    document.getElementById("totalPrice").appendChild(divPrice);
}

function createImage(i, productInfo){
    var img = document.createElement("img");
    img.src = "product_image/"+shoppingCart[i].imageID+".jpg";
    img.style.width= "50%";
    productInfo.appendChild(img);
}

function createQuantity(i, productInfo){
    var addButton = document.createElement("button");
    addButton.setAttribute("id", "addInCart_"+i);

    var quantity = document.createElement("span");
    quantity.setAttribute("id", i);

    var subtractButton = document.createElement("button");
    subtractButton.setAttribute("id", "subtractInCart_"+i);

    addButton.textContent = "+";
    quantity.innerHTML = shoppingCart[i].quantity;
    subtractButton.textContent = "-";

    if(shoppingCart[i].quantity == 1){
        subtractButton.style.opacity = "0.5";
    }
    addButton.onclick = function(i){
      return function(){
        if(shoppingCart[i].quantity < 10){
          add(i, "addInCart_"+i, "subtractInCart_"+i);
          shoppingCart[i].quantity = shoppingCart[i].quantity + 1;

          var displayPrice = document.getElementById("priceWithQuantity_"+i);
          displayPrice.parentNode.removeChild(displayPrice);
          createPrice(i, productInfo);

          var overallPrice = document.getElementById("overallPrice");
          overallPrice.parentNode.removeChild(overallPrice);
          totalPriceOverview();
        }
      }
    }(i);

    subtractButton.onclick = function(i){
      return function(){
        if(shoppingCart[i].quantity > 1){
          subtract(i, "addInCart_"+i, "subtractInCart_"+i);
          shoppingCart[i].quantity = shoppingCart[i].quantity - 1;

          var displayPrice = document.getElementById("priceWithQuantity_"+i);
          displayPrice.parentNode.removeChild(displayPrice);
          createPrice(i, productInfo);

          var overallPrice = document.getElementById("overallPrice");
          overallPrice.parentNode.removeChild(overallPrice);
          totalPriceOverview();
        }
      }
    }(i);

    productInfo.appendChild(subtractButton);
    productInfo.appendChild(quantity);
    productInfo.appendChild(addButton);

}

function createPrice(i, productInfo){
  var price = document.createElement("p");
  price.setAttribute("id", "priceWithQuantity_"+i);
  var priceTimesQuantity = shoppingCart[i].price * shoppingCart[i].quantity;
  price.appendChild(document.createTextNode("S./ "+priceTimesQuantity));
  productInfo.appendChild(price);
}

function viewCart(){
  if(document.getElementById("viewItems").style.display === "none"){

      document.getElementById("viewItems").style.display = "inline";
      document.getElementById("viewItems").style.height = " 100vh";
      document.getElementById("viewItems").style.border = "solid";

      totalPriceOverview();

      var div = document.createElement("div");
      div.setAttribute("id", "selectedItems");

      if(shoppingCart.length == 0){
          var item = document.createElement("p");
          item.appendChild(document.createTextNode("basket is empty"));
          div.appendChild(item);
      }
      else {
          for (var i = 0; i < shoppingCart.length; ++i) {
              var productInfo = document.createElement("div");
              productInfo.setAttribute("id", "productID_"+shoppingCart[i].product);

              createTitle(i, productInfo);
              createRemoveButton(i, productInfo);
              createImage(i, productInfo);
              createQuantity(i, productInfo);
              createPrice(i, productInfo);

              div.appendChild(productInfo);
          }
      }
      document.getElementById("basketList").appendChild(div);
  }
}

function closeCart(){
    var items = document.getElementById("selectedItems");
    items.parentNode.removeChild(items);

    var price = document.getElementById("overallPrice");
    price.parentNode.removeChild(price);

    document.getElementById("viewItems").style.display = "none";
}

function addToCart(productID, name, price, imageID){
  var quantity = parseInt(document.getElementById(productID).innerHTML);
  var i;
  var id = "cart_"+productID;

  for(i = 0; i < shoppingCart.length; ++i){
      if(shoppingCart[i].product == productID){
          exit();
      }
  }

  var addedProduct = new Cart(productID, quantity, name, price, imageID);
  shoppingCart.push(addedProduct);
  document.getElementById(id).style.backgroundColor = "#749BCA";

}

function add(id, addID, subtractID){
  var value = parseInt(document.getElementById(id).innerHTML);

  if(value >= 10){
    document.getElementById(id).innerHTML = 10;
    exit();
  }
  else{
    value = value + 1;
    document.getElementById(id).innerHTML = value;

    if(value >= 10){
      document.getElementById(addID).style.opacity = 0.5;
    }
    else if(value >= 2){
      document.getElementById(subtractID).style.opacity = 1;
    }
  }
}

function subtract(id, addID, subtractID){
  var value = parseInt(document.getElementById(id).innerHTML);

  if(value <= 1){
    document.getElementById(id).innerHTML = 1;
    exit();
  }
  else{
    value = value - 1;
    document.getElementById(id).innerHTML = value;

    if(value <= 1){
      document.getElementById(subtractID).style.opacity = 0.5;
    }
    else if(value >= 9){
      document.getElementById(addID).style.opacity = 1;
    }
  }
}
