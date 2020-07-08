<div class="container">
    <?php if (empty($tasks)): ?>
        <p>Список постов пуст</p>
    <?php else: ?>
    <form id="edit_task" action="/admin/panel" method="post" >
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        <span>Имя пользователя</span>
                    </th>
                    <th>
                        <span>E-mail</span>
                    </th>
                    <th>
                        <span>Текст задачи</span>
                    </th>
                    <th>
                        <span>Статус</span>
                    </th>
                    <th>
                        <span>Отредактировано</span>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $val): ?>
                    <tr>
                        <td><?php echo $val['user']; ?></td>
                        <td><?php echo $val['email']; ?></td>
                        <td><input type="text" id="<?php echo $val['id']; ?>" value="<?php echo $val['task']; ?>"></td>
                        <td><?php if($val['status'] == 1){echo "Выполнено";}
                        else echo "<input type=\"checkbox\" name=\"chek_status[]\" class=\"custom-control-input\" value=\"".$val['id']."\"" ; ?>
                        </td>
                        <td><?php if($val['edit'] == 1){echo "Отредактировано администратором";}else echo "..."; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table></div>

        <div class="row">
            <input type="submit" id="submit"  value="Сохранить" class="submit-button"/>
        </div>
        <input type="hidden" name="change_text" id="change_text" value="1">
    </form>

    <?php endif; ?>

    <?php if (empty($pagination)): ?>
    <?php else: ?>
        <?php echo $pagination; ?>
    <?php endif; ?>


</div>

