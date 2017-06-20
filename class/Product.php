<?php

include_once "Item.php";
include_once "ProductFileNotFound.php";

class Product implements Item {

    public $id = 0;
    public $name;
    public $price;
    public $quantity;

    public function __construct(string $name) {
        try {
            $name;
            if (!file_exists($name)) {
                throw new ProductFileNotFoundException;
            }
        } catch (ProductFileNotFoundException $e) {
            echo $e->fileNotFound();
            return false;
        }
        $str = file_get_contents($name);
        $json = json_decode($str, true);
        $this->id = $json['id'];
        $this->name = $json['name'];
        $this->price = $json['price'];
        $this->quantity = $json['quantity'];
    }

    public function __toString() {
        return "id: $this->id "
                . "name: $this->name "
                . "price: $this->price "
                . "quantity: $this->quantity";
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getAmount() {
        return $this->amount = $this->getQuantity() * $this->getPrice();
    }

    public function getNet() {
        return ($this->price / 123) * 100;
    }

}
