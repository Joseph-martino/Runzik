<?php

class ProductType {
    public $name;
    public $pluralName;
    public $type;

    public function __construct($type, $name, $pluralName)
    {
        $this->name = $name;
        $this->pluralName = $pluralName; 
        $this->type = $type;
    }
}


?>