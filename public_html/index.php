<?php
session_start();

if(empty($_SESSION['user'])){
    //echo "Доступ запрещен";
    header('Location: regestrazi.php');
    die;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style_main.css">
    <link rel="stylesheet" href="assets/css/style_header.css">
    <title>Пример веб-страницы</title>

    <script src="https://kit.fontawesome.com/58ebeca16e.js" crossorigin="anonymous"></script>
    <script src="assets/script/app.js" defer></script>
</head>

<body>

<header class="header">
    <?php
    include('header.php');
    ?>
</header>

</body>

</html>