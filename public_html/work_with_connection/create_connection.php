<?php
session_start();



$host = $_POST['host'];
$port = $_POST['port'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];


$hostname = $host . ":" . $port;

// перенести в удачное подключение
//setcookie("connection|".$hostname."@".$user_name."[hostname]", $hostname, time() + 60, '/');
//setcookie("connection|".$hostname."@".$user_name."[username]", $user_name, time() + 60, '/');
//setcookie("connection|".$hostname."@".$user_name."[password]", $password, time() + 60, '/');


// подключаемся к серверу
@$connect_to_new_server = new mysqli($hostname, $user_name, $password);

if ($connect_to_new_server->connect_errno) {
    //throw new RuntimeException('ошибка соединения mysqli: ' . $connect_to_new_server->connect_error);
    session_destroy();
    header('Location: ../registration.php');
}else{

    $_SESSION['connection'] = ['hostname' => $hostname, 'user_name' => $user_name, 'password' => $password];
    setcookie("connection|" . $hostname . "@" . $user_name . "[hostname]", $hostname, time() + 60, '/');
    setcookie("connection|" . $hostname . "@" . $user_name . "[username]", $user_name, time() + 60, '/');
    setcookie("connection|" . $hostname . "@" . $user_name . "[password]", $password, time() + 60, '/');


    /* изменяем базу данных" */
    // если на сервере уже создана среда для работы
    if ($connect_to_new_server->select_db("test_scritp")) {

        $result = $connect_to_new_server->query("SELECT * FROM `users` WHERE `connection_name` = '$user_name' AND `connection_password` = '$password'");
        $now_user = $result->fetch_assoc();
        // если в среде существует наш пользователь из данных по подключению
        if ($now_user) {
            header("Location: ../registration.php");
            echo "Подключение создано, можете войти";
        } else {
            // если среда есть, но нет нашего пользователя и мы админ сервера
//            if (create_environment_for_work($host, $user_name, $password)) {
//                echo 2;
//            } else {
//                echo "Обратитесь к админу за правом получить доступ";
//            }
            // иначе
            echo "Обратитесь к админу за правом получить доступ";
        }
    } else {
        require_once "first_connection.php";
        // среды для работы с гуи еще нет
        // проверяем на администратор сервера
        $is_admin = access_rights_check($connect_to_new_server, $user_name);
        if ($is_admin == true) {
            if (create_environment_for_work($host, $user_name, $password)) {
                // подключаемся к серверу
                $connect_to_admin_panel = new mysqli($hostname, $user_name, $password, 'test_scritp');
                // создаем пользователя в гуи для администратора
                $connect_to_admin_panel->query("INSERT INTO `users` (`name`, `login`, `pass`, `state`, `connection_name`, `connection_password`) VALUES ('root', '$user_name', '$password', 'main_admin', '$user_name', '$password')");

                // создаем пользователя в сессии
                $_SESSION['state'] = 'main_admin';
                $_SESSION['name'] = 'root';
                $_SESSION['id_user'] = '1';
                $_SESSION['user'] = ['login' => $user_name, 'password' => $password];

                header("Location: ../main.php");
            }
        } else {
            // если в первый раз пытается войти не администратор
            echo "В подключении отказано, обратитесь к администратору сервера";
        }
    }


    // 1 проверяем кто мы по жизни


    // 2 Если мы не важный человек и это первый вход в гуи с этого сервера
    // 2.1 Отправляем отказ в доступе


    // 3 Если мы не важный человек но это не первый вход в гуи с этого сервера
    // 3.1 Проверяем пароль и допускаем пользователя


    // 4 Если мы важный человек и это не первый вход
    // 4.1 Проверяем пароль и допускаем пользователя


    // 5 Если мы важный человек и это первый вход
    // 5.1 создаем нашу бд admin_panel
    // 5.2 вызываем скрипт синхронизации с БД
    // 5.3 допускаем в систему и просим настроить права доступа


    //header("Location: ../registration.php");
}




