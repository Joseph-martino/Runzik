<?php
require_once("product.php");

class Headphone implements iProduct {

    private $price;
    private $title;
    private $image;
    private $brand;
    private $colors;

    public function __construct($title, $price, $image, $brand, $colors)
    {
        $this->title = $title;
        $this->price = $price;
        $this->image = $image;
        $this->brand = $brand;
        $this->colors = $colors;
    }

    public function getPrice() {
        return $this->price;
      }
 
      public function getTitle() {
         return $this->title;
      }
 
      public function getImage()
      {
          return $this->image;
      }

      public function getBrand()
      {
         return $this->brand;
      }

      public function getColors()
     {
        return $this->colors;
     }

}

$allHeadphones = [
    new Headphone("Casque Run’Zik X", 350, "ressources/images/products/watch1.png", "Runzik", ["Crystal blue", "Fire red"]), 
    new Headphone("Casque Hanuman DG1991", 799, "ressources/images/products/watch2.png", "Hanuman", ["Night black", "Diamand white"]), 
    new Headphone("Casque UltraV", 299, "ressources/images/products/watch3.png", "Beats", ["Love Pink", "Lemon Yellow"] ),
    new Headphone("Casque Hanuman GTX 9000 ", 899, "ressources/images/products/watch4.png", "Hanuman", ["Love Pink", "Lemon Yellow"] ),
    new Headphone("Cadque Beats Warrior 41WH ", 479, "ressources/images/products/watch5.png", "Beats", ["Love Pink", "Lemon Yellow"] ),
    new Headphone("Casque Runzik T300", 399, "ressources/images/products/watch6.png", "Runzik", ["Love Pink", "Lemon Yellow"] )  
 ];




?>