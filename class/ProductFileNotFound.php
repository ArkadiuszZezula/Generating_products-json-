<?php

class ProductFileNotFoundException extends Exception {

    public function fileNotFound() {
        return "File not found. Try correct filename";
    }

}
