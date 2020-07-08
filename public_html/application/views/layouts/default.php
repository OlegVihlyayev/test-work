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
            <?php if (isset($_SESSION['admin'])): ?>
                <li><a href="/admin/login">Админ Панель</a></li>
            <?php else: ?>
                <li><a href="/admin/login">Вход в Админ Панель</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<?php if(isset($content)){echo $content;} ?>
<hr>
<?php require_once 'application/views/layouts/footer.php';?>

</body>
</html>