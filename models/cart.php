<?php

class Cart {
    private $id;
    private $product;

    public function __construct($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }


}

?>