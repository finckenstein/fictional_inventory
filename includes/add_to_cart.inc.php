<?php

class Cart{
  private $product;
  private $quantity;

  function __construct($product, $amount) {
    $this->product = $product;
    $this->quantity = $amount;
  }
  
}
