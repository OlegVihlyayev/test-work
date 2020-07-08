<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (empty($title)): ?>
        <title></title>
    <?php else: ?>
        <?php echo "<title>$title</title>"; ?>
    <?php endif; ?>

    <link rel="shortcut icon" href="/public/images/favicon.png" type="image/png">
    <link href="/public/styles/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/public/fonts/googleapis/font.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">

    <link rel="stylesheet" type="text/css" href="/public/styles/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

    <script src="/public/scripts/jquery.js"></script>
    <script src="/public/scripts/form.js"></script>



</head>
<body>
<?php if ($this->route['action'] != 'login'): ?>
    <header>
        <nav class="container">
            <a class="logo" href="/main/index">
                <span>З</span>
                <span>А</span>
                <span>Д</span>
                <span>А</span>
                <span>Ч</span>
                <span>Н</span>
                <span>И</span>
                <span>К</span>
            </a>
            <ul id="menu">
                <li><a href="/main/index">На главную</a></li>
                <li><a href="/admin/logout">Выход</a></li>
            </ul>
        </nav>
    </header>
    <h4 class="add-title">Панель администратора</h4>
<?php endif; ?>
<?php if(isset($content)){echo $content;} ?>
<?php if ($this->route['action'] != 'login'): ?>
<?php require_once 'application/views/layouts/footer.php';?>

    <script>

        $(document).ready(function () {

            // создаем массив для задач
            let arr_change_tasks = [];
            // при изменении значения любого поля с типом текст
            $("input[type='text']").on('change', function () {
                 // записываем его id и измененное значение в массив
                arr_change_tasks.push($(this).attr('id') + "?" + $(this).val());

            });

            // при нажатии кнопки submit нашей формы записываем данные массива в скрытое поле
            $('#submit').on('click', function () {

                $("#change_text").val(arr_change_tasks);

            });

        });

    </script>


<?php endif; ?>
</body>
</html>