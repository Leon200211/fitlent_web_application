<?php





$db_name = $_POST['db_name'];



$sql = "CREATE DATABASE $db_name;";
$link = mysqli_connect('127.0.0.1:3307', 'root', 'root');
if (!$link) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    //echo $sql;
    if(mysqli_query($link, $sql)){
        # настраиваем права доступа
        require_once('for_access_rights/add_elements.php');
        if(add_element($db_name, "database", $db_name)){
            header("Location: main.php");
        }else{
            $link = mysqli_connect('127.0.0.1:3307', 'root', 'root');
            $sql = "DROP DATABASE $db_name;";
            mysqli_query($link, $sql);
            header("Location: ../main.php?error=Внутренняя ошибка сервера");
        }
    } else {
        header("Location: ../main.php?error=Неверный запрос $sql");
    }
}

