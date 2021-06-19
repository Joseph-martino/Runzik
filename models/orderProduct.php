<?php

class OrderProduct {
   
    // private $productImage;
    // private $productName;
    // private $productBrand;
    private $product;
    private $orderId;
    private $productQuantity;
    private $date;
  
    public function __construct($product, $orderId, $productQuantity, $date) 
    {
        
        // $this->$productImage = $productImage;
        // $this->$productName = $productName;
        // $this->$productBrand = $productBrand;
        $this->product = $product;
        $this->orderId = $orderId;
        $this->productQuantity = $productQuantity;
        $this->date = $date;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    // public function getProductImage() {
    //     return $this->productImage;
    // }

    // public function getProductName() {
    //     return $this->productName;
    // }

    // public function getproductBrand() {
    //     return $this->productBrand;
    // }

    public function getOrderProductId() {
        return $this->product->getId();
    }

    public function getOrderProductName() 
      {
         return $this->product->getName();
      }

      public function getOrderProductImage() 
      {
         return $this->product->getImage();
      }

      public function getOrderProductBrand() 
      {
         return $this->product->getBrand();
      }

    public function getproductQuantity() {
        return $this->productQuantity;
    }

    public function getDate() {
        return $this->date;
    }
}

?>