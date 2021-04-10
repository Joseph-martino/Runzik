<?php
require("watch.php");
require("headphone.php");
require("armband.php");

class ProductGenericInfos {
    public $name;
    public $pluralName;
    public $type;

    public function __construct($name, $pluralName, $type)
    {
        $this->name = $name;
        $this->pluralName = $pluralName; 
        $this->type = $type;
    }
}

class ProductList {
    public $infos;
    public $items = [];
    public function __construct($infos, $items)
    {
        $this->infos = $infos;
        $this->items = $items;        
    }
}

$types = ["watch", "headphone", "armband"];

$watches = new ProductList(
    new ProductGenericInfos("montre", "montres", $types[0]), $allWatches);
$headphones = new ProductList(
    new ProductGenericInfos("casque", "casques", $types[1]),
     $allHeadphones);
$armbands = new ProductList(
    new ProductGenericInfos("brassard", "brassards", $types[2]),
 [$allArmbands]);

$productList = array(
    $types[0] => $watches,
    $types[1] => $headphones,
    $types[2] => $armbands
);

?>