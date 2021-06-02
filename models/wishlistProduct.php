<?php

    class WishlistProduct {

        private $product;
       

        public function __construct($product) {
            $this->product = $product;
        }

        public function getProductId() 
      {
         return $this->product->getId();
      }

        public function getProductName() 
      {
         return $this->product->getName();
      }
 
    
        
    }