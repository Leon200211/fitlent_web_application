<?php


$db = $_POST['db'];
$id_user = $_POST['id_user'];
$table = $_POST['table'];
$id_element = $_POST['id_element'];



$sql_access = '';
if(!empty($_POST['d'])){
    $sql_access .= 'd-';
}
if(!empty($_POST['v_s'])){
    $sql_access .= 'v_s-';
}
if(!empty($_POST['u_s'])){
    $sql_access .= 'u_s-';
}
if(!empty($_POST['ex'])){
    $sql_access .= 'ex-';
}
if(!empty($_POST['im'])){
    $sql_access .= 'im-';
}
if(!empty($_POST['ad_t'])){
    $sql_access .= 'ad_t-';
}


if(!empty($_POST['up_t'])){
    $sql_access .= 'up_t-';
}
if(!empty($_POST['d_t'])){
    $sql_access .= 'd_t-';
}
if(!empty($_POST['s_t'])){
    $sql_access .= 's_t-';
}
if(!empty($_POST['sql_r'])){
    $sql_access .= 'sql_r-';
}
if(!empty($_POST['v_t'])){
    $sql_access .= 'v_t-';
}
if(!empty($_POST['vis_z'])){
    $sql_access .= 'vis_z-';
}



$sql_access = substr($sql_access,0,-1);



$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
$sql = "UPDATE `access` SET `access_rights` = '$sql_access' WHERE `access`.`id` = '$id_element';";
if(mysqli_query($connect, $sql)){
    header("Location: user_rights_for_table.php?db=$db&table=$table&id_user=$id_user");
}


