<?php


session_start();
$errors = [];


// обнуляем сессию если такая создана
if(!empty($_SESSION['name'])){
    session_destroy();
    header('Location: registration.php');
}


// проверяем попытку входа
if (!empty($_POST['login']) && !empty($_POST['password'])) {
    $l_login = $_POST['login'];
    $p_password = $_POST['password'];



    @$link = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password']);
    if($link->connect_errno){
        die('Ошибка подключения');
    }

    // проверяем на наличие среды
    if (!$link->select_db("test_scritp")) {

        // ошибка import .sql

//        require_once "work_with_connection/first_connection.php";
//        // среды для работы с гуи еще нет, но подключение уже есть
//        // проверяем на администратор сервера
//        $is_admin = access_rights_check($link, $_SESSION['connection']['user_name']);
//        if ($is_admin == true) {
//            if (create_environment_for_work($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password'])) {
//                // подключаемся к серверу
//                $connect_to_admin_panel = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password'], 'test_scritp');
//                // создаем пользователя в гуи для администратора
//                $connect_to_admin_panel->query("INSERT INTO `users` (`name`, `login`, `pass`, `state`, `connection_name`, `connection_password`) VALUES ('root', '{$_SESSION['connection']['user_name']}', '{$_SESSION['connection']['password']}', 'main_admin', '{$_SESSION['connection']['user_name']}', '{$_SESSION['connection']['password']}')");
//                //header("Location: ../main.php");
//            }
//        } else {
//            // если в первый раз пытается войти не администратор
//            exit("В подключении отказано, обратитесь к администратору сервера");
//        }


        die("Ваша среда была уничтожена");
    }


    $result = $link->query("SELECT * FROM `users` WHERE `login` = '$l_login'");
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
        <form class="modal-content animate" action="work_with_connection/create_connection.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>
            </div>
            <div class="container">
                <label for="host"><b>Host</b></label>
                <input type="text" placeholder="Enter Host" name="host" required>
                <label for="port"><b>Port</b></label>
                <input type="text" placeholder="Enter Port" name="port" required>
                <label for="user_name"><b>User</b></label>
                <input type="text" placeholder="Enter User" name="user_name" required>
                <label for="password"><b>Password</b></label>
                <input type="text" placeholder="Enter Password" name="password" required>
                <button type="submit">Подключиться</button>
            </div>
        </form>
    </div>


    <div class="fon">
        <div>
            <div class="vhod">В разработке</div>
            <br>
            <br>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
            <script type="text/javascript">
                function change_connection() {
                    var social = document.getElementById("connection_list");
                    var selectSocial = social.options[social.selectedIndex].value
                    if(selectSocial !== '') {
                        console.log(selectSocial);
                        $.ajax({
                            url: "work_with_connection/change_connection.php",
                            type: 'POST',
                            data: ({selectSocial: selectSocial}),
                            success: function (data) {
                                console.log(data);
                                var show = document.getElementById("default_show");
                                show.style.display = 'inherit';
                            },
                            error: function () {
                                console.log('ERROR');
                            }
                        });
                    }
                }
            </script>
            <select style="width: 300px; height: 50px;" id="connection_list" onchange=change_connection()>
                <option></option>
                <?php
                //var_dump($_COOKIE);
                foreach ($_COOKIE as $name => $value) {
                    if(!(strpos($name, 'connection') === false)){
                        ?>
                        <option value="<?=$name?>"><?=$name?></option>
                        <?php
                    }
                    echo "<br><br>";
                }
                ?>
            </select>
            <br>
            <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Создать подключение</button>
            <script src="assets/scripts/authorization.js"></script> <!-- Modernizr -->
        </div>






        <?php
        if(!empty($_SESSION['connection'])){
            $connect_to_new_server = new mysqli($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password']);
            var_dump($_SESSION['connection']['hostname'], $_SESSION['connection']['user_name'], $_SESSION['connection']['password']);
            if($connect_to_new_server){
            ?>
            <div id="default_show">
            <?php
            }
        }else{
            ?>
            <div id="default_show" style="display: none;">
            <?php
        }
        ?>
            <div class="polosca"></div>
            <div class="vhod">Вход</div>
            <div class="polosca_mini"></div>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <form method="POST" action="registration.php">
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