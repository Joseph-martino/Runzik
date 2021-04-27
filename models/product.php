<?php
require_once(ROOT_PATH ."models/iproduct.php");

class Product implements iProduct {

   private $id;
   private $name;
   private $price;
   private $image;
   private $colour1;
   private $colour2;
   private $brand;
 
     public function __construct($id, $name, $price, $image, $colour1, $colour2, $brand)
     {
         $this->id = $id;
         $this->name = $name;
         $this->price = $price;
         $this->image = $image;
         $this->colour1 = $colour1;
         $this->colour2 = $colour2;
         $this->brand = $brand;
     }

     public function getId() 
      {
         return $this->id;
      }

     public function getName() 
      {
         return $this->name;
      }
 
     public function getPrice() {
         return $this->price;
      }
 
      public function getImage()
      {
         return $this->image;
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