<?php

session_start();

$link = @mysqli_connect($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password']);
if (!$link) {
    die('Ошибка соединения');
}

?>