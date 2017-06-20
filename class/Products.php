<?php

class Products extends ArrayIterator {

    public $products = array();
    public $idUnique;
    private $position = 0;

    public function __construct() {
        parent::__construct();
        $this->idUnique = uniqid();
    }

    public function add(Item $item) {
        return $this->products[] = $item;
    }

    public function getIdUnique() {
        return $this->idUnique;
    }

    function showProductsAsArray() {
        $res = [];
        foreach ($this->products as $row) {
            $res[] = $row;
        }
        return $res;
    }

}
