<?php

$urlParts = explode('/', str_replace(APP_ROOT_URL, '', $_SERVER['REQUEST_URI']));
$action = $urlParts[count($urlParts) - 1];

$controller = new AddressController();
if (method_exists($controller, $action)) {
    $controller->$action($_POST);
} else {
    $controller->index($_POST);
}
