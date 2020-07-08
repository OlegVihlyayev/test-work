<?php

namespace application\models;

use application\core\Model;
use application\lib\Auxiliary;

class Main extends Model
{
    public $error;

    // проверка на валидность введенных данных
    public function taskValidate($post)
    {
        $user_name_strlen = Auxiliary::strlenDifferentCoding($post['user_name']);
        $task_strlen = Auxiliary::strlenDifferentCoding($post['task']);

        if ($user_name_strlen < 3 or $user_name_strlen > 20) {
            $this->error = 'Имя должно содержать от 3 до 20 символов!';
            return false;
        } elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Некорректный e-mail';
            return false;

        } elseif ($task_strlen < 5 or $task_strlen > 100) {
            $this->error = 'Текст должнен содержать от 5 до 100 символов!';
            return false;
        }
        return true;
    }

    // добавление задания в базу
    public function taskAdd($post)
    {
        $user_id = $this->userAdd($post);
        $task = Auxiliary::getPreparedText($post['task']);
        $params = [
            'id' => '',
            'task' => $task,
            'user_id' => $user_id,
            'status' => false,
            'edit' => false,
        ];

        $this->db->query('INSERT INTO tasks VALUES (:id, :task, :user_id, :status , :edit )', $params);
        return $this->db->lastInsertId();
    }

    // добавление пользователя в базу
    public function userAdd($post)
    {
        $user_name = Auxiliary::getPreparedText($post['user_name']);
        $query = $this->isUserExists($user_name ,$post['email']);

        if (empty($query)) {

            $params = [
                'id' => '',
                'name' => $user_name,
                'email' => $post['email'],
            ];

            $this->db->query('INSERT INTO users VALUES (:id, :name, :email )', $params);
            return $this->db->lastInsertId();
        } else {

            return $query;
        }
    }

    // проверка на существование пользователя
    public function isUserExists($user_name,$email)
    {
        $params = [

            'name' => $user_name,
            'email' => $email,
        ];

        return  $this->db->column('SELECT id FROM users WHERE users.name= :name AND users.email= :email ', $params);
    }

    // кол-во заданий
    public function tasksCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM tasks');
    }

    // список заданий

    public function tasksList($route)
    {

        $max = 3;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];

     return $this->db->row('SELECT tasks.id as id, tasks.task as task, users.name as user, users.email as email , tasks.status as status , tasks.edit as edit
FROM tasks,users
WHERE tasks.user_id = users.id
LIMIT :start, :max', $params);

    }

    // список отсортированных заданий по столбцу

    public function tasksListSort($route)
    {
        $view = "order_by_" . $route['column'];
        $max = 3;
        $params = ['max' => $max, 'start' => ((($route['page'] ?? 1) - 1) * $max)];

        return $this->db->row("SELECT * FROM $view LIMIT :start, :max", $params);
    }

}
