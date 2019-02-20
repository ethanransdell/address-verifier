<?php

function __autoload($className) {
    $classArray = explode('\\', $className);
    $className = end($classArray);

    $filePath = APP_ROOT_DIR . '/services/' . $className . '.php';
    if (file_exists($filePath)) {
        require_once $filePath;

        return true;
    }

    return false;
}
