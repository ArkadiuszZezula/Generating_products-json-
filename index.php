<?php

function classLoader($classname) {
    $file = 'class/' . $classname . '.php';
    if (file_exists($file) && is_readable($file) && !class_exists($classname, false)) {
        require_once($file);
    } else {
        throw new Exception('Class cannot be found ( ' . $classname . ' )');
    }
}

spl_autoload_register('classLoader');

if (php_sapi_name() == "cli") {
    $posArgs = array_slice($argv, 0, 3);
    if ($posArgs[1] == "-generate") {
        Basic::generateRandomItems($posArgs[2]);
    } else if ($posArgs[1] !== "-generate") {
        Basic::deleteProducts($posArgs[1]);
    }
} else {
    $files = glob('products/*.{json}', GLOB_BRACE);
    foreach ($files as $file) {
        $cutFolderPath = strstr($file, '/');
        $cutSlashPath = substr($cutFolderPath, 1);
        $clearFileName = strstr($cutSlashPath, '.', true);
        echo $clearFileName . "<br>";
        echo "*";
        echo Basic::showItems($clearFileName) . "* <br><hr>";
    }
}

