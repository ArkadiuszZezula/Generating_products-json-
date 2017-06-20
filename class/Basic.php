<?php

include_once "ProductVariation.php";

class Basic {

    public function generateRandomItems($n) {
        $products = new Products();
        $tempColors = array('red', 'green', 'blue', 'white', 'black', null);
        $randomColor = $tempColors[mt_rand(0, 5)];

        for ($i = 0; $i < $n; $i++) {
            $arrayToJson = ["id" => $i,
                "name" => "Produkt " . $i . "",
                "price" => mt_rand(0 * 10, 99 * 10) / 10,
                "quantity" => (mt_rand(0, 99))];

            if (($i % 2) == 1) {
                $tempColors = array('red', 'green', 'blue', 'white', 'black', null);
                try {
                    $randomColor = $tempColors[mt_rand(0, 5)];
                    if ($randomColor == null) {
                        throw new \Exception('<br>Color was not found <br>');
                    } else {
                        $arrayToJson["color"] = $randomColor;
                        $json = json_encode($arrayToJson);
                        file_put_contents("product" . $i . ".json", $json);
                        $newName = "product" . $i . ".json";
                        $newProductVariation = new ProductVariation($newName, $randomColor);
                        $products->add($newProductVariation);
                        unlink("product" . $i . ".json");
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                $json = json_encode($arrayToJson);
                file_put_contents("product" . $i . ".json", $json);
                $newName = "product" . $i . ".json";
                $newProductVariation = new Product($newName);
                $products->add($newProductVariation);
                unlink("product" . $i . ".json");
            }
        }
        $idUnique = $products->getIdUnique();
        $serializeProducts = serialize($products);
        file_put_contents("products/" . $idUnique . ".json", $serializeProducts);
        echo $idUnique;
        return $idUnique;
    }

    public static function showItems($id) {
        $files = glob('products/*.{json}', GLOB_BRACE);
        $ifExist = 0;
        foreach ($files as $file) {
            $fileContents = file_get_contents($file);
            $data = unserialize($fileContents);
            if ($data->getIdUnique() == $id) {
                $showAllJsonArray = $data->showProductsAsArray();
                $ifExist = 1;
                foreach ($showAllJsonArray as $row) {
                    echo "<pre>" . $row . "</pre>";
                }
            }
        }
        if ($ifExist == 0) {
            $newGenerate = new Basic();
            $newGenerate->generateRandomItems(20);
            echo "New File was created";
        }
    }

    public static function deleteProducts($id) {
        $files = glob('products/*.{json}', GLOB_BRACE);
        $ifNotExist = 0;
        foreach ($files as $file) {
            $fileContents = file_get_contents($file);
            $data = unserialize($fileContents);
            if ($data->getIdUnique() == $id) {
                $ifNotExist = 1;
                unlink($file);
                if (!file_exists($file)) {
                    echo "File was deleted";
                    return true;
                }
            }
        }
        if ($ifNotExist = 1) {
            echo "File was not found";
        }
    }

}
