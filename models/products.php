<?php
class ProductList {
    public $infos;
    public $items = [];
    public function __construct($infos, $items)
    {
        $this->infos = $infos;
        $this->items = $items;        
    }
}


?>