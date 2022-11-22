<?php
session_start();

if(empty($_SESSION['user'])){
    //echo "Доступ запрещен";
    header('Location: regestrazi.php');
    die;
}else{
    header('Location: main.php');
    die;


    // отправка cookie
//    setcookie("cookie[hostname]", "cookiethree", time() + 3600);
//    setcookie("cookie[username]", "cookietwo", time() + 3600);
//    setcookie("cookie[password]", "cookieone", time() + 3600);

    // после перезагрузки страницы, выведем cookie
//    if (isset($_COOKIE['cookie'])) {
//        foreach ($_COOKIE['cookie'] as $name => $value) {
////            $name = htmlspecialchars($name);
////            $value = htmlspecialchars($value);
//            echo "$name : $value <br>";
//        }
//    }
}

?>
