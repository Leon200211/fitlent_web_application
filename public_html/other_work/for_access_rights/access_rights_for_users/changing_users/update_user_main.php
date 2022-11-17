<?php


$id = $_POST['id'];
$name = $_POST['name'];
if(empty($name)){
    header("Location: update_user.php?id=$id&error=Ошибка изменения $name не заполнено поле `Name`");
}
$login = $_POST['login'];
if(empty($login)){
    header("Location: update_user.php?id=$id&error=Ошибка изменения $login не заполнено поле `Login`");
}
$pass = $_POST['pass'];
if(empty($name)){
    header("Location: update_user.php?id=$id&error=Ошибка изменения $name не заполнено поле `Password`");
}
$state = $_POST['user_state'];




$sql = "UPDATE `users` SET `name` = '$name', `login` = '$login', `pass` = '$pass', `state` = '$state' WHERE `users`.`id` = '$id';";


$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');


if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    if(mysqli_query($connect, $sql)) {
        header("Location: ../rights_for_users.php");
    } else {
        header("Location: update_user_main.php?id=$id&error=Неверный запрос $sql");
    }
}







