<?php


session_start();
$errors = [];

$connect_to_register = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');

$now_user = [];


if(!empty($_SESSION['user'])){
    session_destroy();
    header('Location: regestrazi.php');
}



if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $l_login = $_POST['login'];
    $p_password = $_POST['password'];
    $result = $connect_to_register->query("SELECT * FROM `users` WHERE `login` = '$l_login'");
    $now_user = $result->fetch_assoc();
    if(empty($now_user['pass'])){
        $pass = 1;
    }else {
        $pass = $now_user['pass'];
    }
    #if(password_verify($p_password, $pass)){
    if($p_password == $pass){
        $_SESSION['state'] = $now_user['state'];
        $_SESSION['name'] = $now_user['name'];
        $_SESSION['id_user'] = $now_user['id'];
        $_SESSION['user'] = ['login' => $_POST['login'], 'password' => $_POST['password']];
        header("Location: main.php");
        die;
    }else{
        $errors[] = 'Неверный логин или пароль';
    }
}

?>

<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style_for_regestrazi.css">

    <link rel="stylesheet" href="assets/css/style_for_authorization/authorization.css">


    <title>Pink</title>
    <script src="https://kit.fontawesome.com/58ebeca16e.js" crossorigin="anonymous"></script>

</head>




<body>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            </div>
            <div class="container">
                <label for="uname"><b>Host</b></label>
                <input type="text" placeholder="Enter Host" name="uname" required>
                <label for="psw"><b>Port</b></label>
                <input type="password" placeholder="Enter Port" name="psw" required>
                <label for="psw"><b>User</b></label>
                <input type="password" placeholder="Enter User" name="psw" required>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                <button type="submit">Подключиться</button>
            </div>
        </form>
    </div>


    <div class="fon">

        <div>
            <div class="vhod">В разработке</div>

            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Создать подключение</button>

            <script src="assets/scripts/authorization.js"></script> <!-- Modernizr -->
        </div>


        <div>
            <div class="polosca"></div>
            <div class="vhod">Вход</div>
            <div class="polosca_mini"></div>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <form method="POST" action="regestrazi.php">
                <div class="login__">
                    <label for="login">Логин</label>
                    <input id="login" name="login">
                </div>


                <div class="password__">
                    <label for="password">Пароль</label>
                    <input id="password" name="password">
                </div>

                <div>
                    <button class="button" type="submit">Войти</button>
                </div>
            </form>
        </div>

    </div>

</body>

</html>