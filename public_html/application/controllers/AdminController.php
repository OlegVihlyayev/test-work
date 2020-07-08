<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;


class AdminController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->view->layout = 'admin';
    }

    public function loginAction()
    {
        // если сессия активна - редирект на админ панель
        if (isset($_SESSION['admin'])) {
            $this->view->redirect('admin/panel');
        }
        if (!empty($_POST)) {

            // если логин или пароль не валидный - выводим сообщение
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }

            $_SESSION['admin'] = true;
            $this->view->location('admin/panel');
        }
        $this->view->render('Вход | Админ Панель');
    }

    // разлогиниться
    public function logoutAction()
    {
        unset($_SESSION['admin']);
        $this->view->redirect('admin/login');
    }

    // метод админ контроллера для работы с панелью администратора
    public function panelAction()
    {
        if (!empty($_POST)) {

            // обновление заданий
            $this->model->tasksUpdate($_POST);
            $this->view->message('success', 'Данные обновлены', 'admin/panel/');
        }

        // создаем объект пагинации передав в его конструктор - маршрут и кол-во заданий в базе
        $pagination = new Pagination($this->route, $this->model->tasksCount());

        $vars = [
            'pagination' => $pagination->get(),
            'tasks' => $this->model->tasksList($this->route),

        ];

        // передаем полученные данные во вьюшку
        $this->view->render('Админ Панель', $vars);
    }

}