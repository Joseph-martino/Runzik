<?php

class Brand {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getBrandName(){
        return $this->name;
    } 
    
    public function __toString()
    {
        $text = $this->name;
        return $text;
    }
}


?>