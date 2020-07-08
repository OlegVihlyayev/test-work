<?php


return [

    // AdminController

    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],

    'admin/panel/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'panel',
    ],

    'admin/panel' => [
        'controller' => 'admin',
        'action' => 'panel',
    ],

    // MainController.php

    'main/sort/{column:\S+}/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'sort',
    ],

    'main/sort/{column:\S+}' => [
        'controller' => 'main',
        'action' => 'sort',
    ],

    'main/index/{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'main/index' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'index' => [
        'controller' => 'main',
        'action' => 'index'
    ],

    'index.php' => [
        'controller' => 'main',
        'action' => 'index'
    ],

];