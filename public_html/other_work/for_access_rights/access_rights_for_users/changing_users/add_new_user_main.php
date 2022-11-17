<?php



$user_name = $_POST['user_name'];
if(empty($trigger_name)){
    header("Location: rights_for_users.php?error=Заполните поле `Имя`");
}
$user_login = $_POST['user_login'];
if(empty($user_login)){
    header("Location: rights_for_users.php?error=Заполните поле `Логин`");
}
$user_pass = $_POST['user_pass'];
if(empty($user_pass)){
    header("Location: rights_for_users.php?error=Заполните поле `Пароль`");
}
$user_state = $_POST['user_state'];





$sql = "INSERT INTO `users` (`id`, `name`, `login`, `pass`, `state`) VALUES (NULL, '$user_name', '$user_login', '$user_pass', '$user_state');";

$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
if (!$connect) {
    die('Ошибка соединения: ' . mysqli_error());
} else {
    if(mysqli_query($connect, $sql)){
        header("Location: ../rights_for_users.php");
    } else {
        header("Location: ../rights_for_users.php?error=$sql");
    }
}







