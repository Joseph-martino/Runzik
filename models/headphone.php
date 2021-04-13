<?php
require_once("product.php");


class Headphone implements iProduct {

    private $name;
    private $price;
    private $image;
    private $quantity;
    private $colour1;
    private $colour2;
    private $brand;

    public function __construct($name, $price, $image, $quantity, $colour1, $colour2, $brand)
    {
        $this->name = $name;
        $this->price = $price;
        $this->image = $image;
        $this->quantity = $quantity;
        $this->colour1 = $colour1;
        $this->colour2 = $colour2;
        $this->brand = $brand;
    }


    public function getName() {
      return $this->name;
   }

    public function getPrice() {
       return $this->price;
     }

     public function getImage()
     {
        return $this->image;
     }

     public function getQuantity()
     {
        return $this->quantity;
     }

     public function getColour1()
     {
        return $this->colour1;
     }

     public function getColour2()
     {
        return $this->colour2;
     }

     public function getBrand()
     {
        return $this->brand;
     }

}

?>