<?php

include_once "UndefinedVariantColor.php";

class ProductVariation extends Product {

    public $color;

    public function __construct($name, $color = "") {
        try {
            $color;
            if ($color == "") {
                throw new UndefinedVariantColorException("Color was not defined");
            } else if (!is_string($color)) {
                throw new UndefinedVariantColorException("Color should be a string");
            }
        } catch (UndefinedVariantColorException $e) {
            echo $e->getMessage();
            return false;
        } catch (UndefinedVariantColorException $e) {
            echo $e->getMessage();
            return false;
        }
        parent::__construct($name);
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function __toString() {
        return "id: $this->id "
                . "name: $this->name "
                . "price: $this->price "
                . "quantity: $this->quantity "
                . "color: $this->color";
    }

}
