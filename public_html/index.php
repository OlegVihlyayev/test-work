<?php

use application\core\Router;


spl_autoload_register(function($class) {
    $path = str_replace('\\', '/', $class.'.php');

    if (is_readable($path)) {

        require_once $path;
    }
});

session_start();

$router = new Router;
$router->run();