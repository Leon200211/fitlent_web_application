<?php

session_start();

$connection = $_POST['selectSocial'];

$hostname = $_COOKIE[$connection]['hostname'];
$user_name = $_COOKIE[$connection]['username'];
$password = $_COOKIE[$connection]['password'];

$_SESSION['connection'] = ['hostname' => $hostname, 'user_name' => $user_name, 'password' => $password];