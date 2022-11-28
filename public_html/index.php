<?php
session_start();

if(empty($_SESSION['user'])){
    //echo "Доступ запрещен";
    header('Location: registration.php');
    die;
}else{
    header('Location: main.php');
    die;
}

?>
