<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
    public $route;
    public $view;
    public $model;
    public $acl;

    // передаем в коструктор маршрут
    public function __construct($route)
    {
        $this->route = $route;
        // проверка на доступ по маршруту
        if (!$this->checkAcl()) {
            View::errorCode(403);
        }
        // создаем объект вьюшки по маршруту
        $this->view = new View($route);
        // создаем объект модели по маршруту
        $this->model = $this->loadModel($route['controller']);
    }

    // проверяем на существование класса и создаем объект если все ок
    public function loadModel($name)
    {
        $path = 'application\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    // проверка на доступ по маршруту по ключям
    public function checkAcl()
    {
        $this->acl = require 'application/acl/' . $this->route['controller'] . '.php';

        if ($this->isAcl('all')) {
            return true;

        } elseif (isset($_SESSION['admin']) and $this->isAcl('admin')) {
            return true;
        }
        return false;
    }

    public function isAcl($key)
    {
        return in_array($this->route['action'], $this->acl[$key]);
    }

}