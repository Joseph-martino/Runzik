<?php

    class CartProduct {

        private $product;
        private $quantity;

        public function __construct($product, $quantity) {
            $this->product = $product;
            $this->quantity = $quantity;
        }

        public function getProductId() 
      {
         return $this->product->getId();
      }

        public function getProductName() 
      {
         return $this->product->getName();
      }
 
     public function getProductPrice() 
        {
         return $this->product->getPrice();
      }

      public function getProductImage() 
        {
         return $this->product->getImage();
      }


        public function getQuantity() 
        {
           return $this->quantity;
        }

        public function getProductSubtotal(){
           return $this->quantity * $this->getProductPrice();
        }
        
    }
