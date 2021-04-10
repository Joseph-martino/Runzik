<?php

require_once("product.php");

class Armband implements iProduct {

    public function getPrice() {
        return 50;
      }
 
      public function getTitle() {
         return "Brassard";
      }
 
      public function getImage()
      {
          return "";
      }

      public function getColors()
     {
        return $this->colors;
     }
}





?>