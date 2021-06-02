<?php
require_once(ROOT_PATH ."models/product.php");

class Wishlist {
    private $id;
   
    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }
    
}

?>