<div class="container">
    <p class="h4">Список задач</p><br>
    <?php if (empty($tasks)): ?>
        <p>Список постов пуст</p>
    <?php else: ?>
        <table class="table">
            <thead>
            <tr>
                <th>
                    <ul id="table_caption" >
                        <li ><span>Имя пользователя</span></li>
                        <li ><span><a href="/main/sort/user_id"> &#9650; </a></span>
                            <span><a href="/main/sort/user_id_desc"> &#9660;</a></span>
                        </li>
                    </ul>
                </th>
                <th>
                    <ul id="table_caption" >
                        <li ><span>E-mail</span></li>
                        <li ><span><a href="/main/sort/email"> &#9650; </a></span>
                            <span><a href="/main/sort/email_desc"> &#9660;</a></span>
                        </li>
                    </ul>
                </th>
                <th>
                    <ul id="table_caption" >
                        <li ><span>Текст задачи</span></li>
                        <li ><span><a href="/main/sort/task"> &#9650; </a></span>
                            <span><a href="/main/sort/task_desc"> &#9660;</a></span>
                        </li>
                    </ul>
                </th>
                <th>
                    <ul id="table_caption" >
                        <li ><span>Статус</span></li>
                        <li ><span><a href="/main/sort/status"> &#9650; </a></span>
                            <span><a href="/main/sort/status_desc"> &#9660;</a></span>
                        </li>
                    </ul>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $val): ?>
                <tr>
                    <td><?php echo $val['user']; ?></td>
                    <td><?php echo $val['email']; ?></td>
                    <td><?php echo $val['task']; ?></td>
                    <td><?php if($val['status'] == 1){echo "Выполнено";}else echo "..."; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (empty($pagination)): ?>
    <?php else: ?>
        <?php echo $pagination; ?>
    <?php endif; ?>

    <div class="border-div-container">

        <hr><p class="h4">Добавить новую задачу</p><br>

        <form id="add_task" action="/main/index" method="post" >

            <div class="row">
                <div class="col-25">
                    <label for="user_name">Имя </label>
                </div>
                <div class="col-75">
                    <input type="text" id="user_name" name="user_name" placeholder="..." required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="email">E-mail </label>
                </div>
                <div class="col-75">
                    <input type="text" id="email" name="email" placeholder="..." required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="task">Текст задачи </label>
                </div>
                <div class="col-75">
                    <input type="text" id="task" name="task" placeholder="..." required>
                </div>
            </div>
            <div class="row">
                <input type="submit" id="submit"  value="Добавить задачу" class="submit-button"/>
            </div>
        </form>
    </div>
</div>

