<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;


class MainController extends Controller
{
    // метод главного контроллера для работы с главной страницей
    public function indexAction()
    {
        if (!empty($_POST)) {

            // если данные для создания задачи не валидные - выводим сообщение
            if (!$this->model->taskValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
             // если все хорошо добавляем их в базу
            $id = $this->model->taskAdd($_POST);

            if (!$id) {
                $this->view->message('error', 'Ошибка обработки запроса!');
            }

            $this->view->message('success', 'Задача добавлена', 'main/index/');
        }

        $pagination = new Pagination($this->route, $this->model->tasksCount() , 3 );

        $vars = [
            'pagination' => $pagination->get(),
            'tasks' => $this->model->tasksList($this->route),

        ];

        // передаем данные во вьюшку
        $this->view->render('Главная', $vars);
    }

     // метод главного контроллера для работы с сортировкой
    public function sortAction()
    {
        // создаем объект пагинации передав в его конструктор - маршрут, кол-во заданий в базе, лимит на вывод на 1 странице,сортируемый столбец
        $pagination = new Pagination($this->route, $this->model->tasksCount(), 3 , $this->route['column']);

        $vars = [
            'pagination' => $pagination->get(),
            'tasks' =>  $this->model->tasksListSort($this->route),

        ];
         // передаем полученные данные во вьюшку
        $this->view->render('Сортировка', $vars);

    }

}

