<?php
require_once("product.php");

class Watch implements iProduct {

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


$allWatches = [
   new Watch("Montre Run’Zik S Plus", 100, "ressources/images/products/watch1.png", "Runzik", ["Crystal blue", "Fire red"]), 
   new Watch("Montre Hanuman 4 Power +", 399, "ressources/images/products/watch2.png", "Hanuman", ["Night black", "Diamand white"]), 
   new Watch("Montre Beats Cosmos 7 pro", 299, "ressources/images/products/watch3.png", "Beats", ["Love Pink", "Lemon Yellow"] ),
   new Watch("Montre Hanuman Pro GT ", 899, "ressources/images/products/watch4.png", "Hanuman", ["Love Pink", "Lemon Yellow"] ),
   new Watch("Montre Beats Sport SE ", 479, "ressources/images/products/watch5.png", "Beats", ["Love Pink", "Lemon Yellow"] ),
   new Watch("Montre Runzik T++", 599, "ressources/images/products/watch6.png", "Runzik", ["Love Pink", "Lemon Yellow"] )  


];

?>