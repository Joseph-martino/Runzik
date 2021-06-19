<?php
require_once(ROOT_PATH ."models/product.php");

class Cart {
    private $id;
  
    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function addProduct($product) {
        $this->allProducts[] = $product;
    }

    public function  getAllProducts() {
       return $this->allProducts;
     }
}

?>