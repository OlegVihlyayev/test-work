<?php

namespace application\models;

use application\core\Model;
use application\lib\Auxiliary;
use Imagick;

class Admin extends Model
{
    public $error;
    public $search;

    // проверка логина и пароля
    public function loginValidate($post)
    {
        $config = require 'application/config/admin.php';

        $hash = md5(trim($post['login']) . trim($post['password']));

        if ($config['hash'] !== $hash) {
            $this->error = 'Логин или пароль указан неверно';
            return false;
        }
        return true;
    }


    // список заданий
    public function tasksList($route)
    {
        $max = 10;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];

        return $this->db->row('SELECT tasks.id as id, tasks.task as task, users.name as user, users.email as email , tasks.status as status , tasks.edit as edit
FROM tasks,users
WHERE tasks.user_id = users.id
LIMIT :start, :max', $params);

    }

    // кол-во заданий
    public function tasksCount()
    {
        return $this->db->column('SELECT COUNT(id) FROM tasks');
    }


    // обновление заданий
    public function tasksUpdate($post)
    {
        empty($post['chek_status']) ? 0 : $this->statusUpdate($post);

        empty($post['change_text']) ? 0 : $this->textUpdate($post);
    }


    // обновление статуса заданий
    public function statusUpdate($post)
    {
        $chek_status = implode(",", $post['chek_status']);

        $this->db->query("UPDATE tasks SET status = true  WHERE id IN ( $chek_status )");
    }


    // обновление текста заданий и редактирования админом
    public function textUpdate($post)
    {
        $change_text_info = str_replace("?", " ", $post['change_text']);
        $change_text_info = explode(",", $change_text_info);

        for ($i = 0; $i < count($change_text_info); $i++) {
            $arr = explode(" ", $change_text_info[$i]);
            $params = [
                'id' => $arr[0],
                'text' => $arr[1],
                'edit' => true,
            ];

            $this->db->query("UPDATE tasks SET task = :text , edit = :edit WHERE id = :id", $params);
        }
    }


}