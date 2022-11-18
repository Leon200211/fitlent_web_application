<?php




$db = $_POST['db'];
$id_user = $_POST['id_user'];
$id_element = $_POST['id_element'];



$sql_access = '';
if(!empty($_POST['v'])){
    $sql_access .= 'v-';
}
if(!empty($_POST['d'])){
    $sql_access .= 'd-';
}
if(!empty($_POST['vis_z'])){
    $sql_access .= 'vis_z-';
}
if(!empty($_POST['SQL_q'])){
    $sql_access .= 'SQL_q-';
}
if(!empty($_POST['d_s'])){
    $sql_access .= 'd_s-';
}
if(!empty($_POST['ex'])){
    $sql_access .= 'ex-';
}
if(!empty($_POST['im'])){
    $sql_access .= 'im-';
}
if(!empty($_POST['c_t'])){
    $sql_access .= 'c_t-';
}


if(!empty($_POST['v_t'])){
    $sql_access .= 'v_t-';
}
if(!empty($_POST['v_e'])){
    $sql_access .= 'v_e-';
}
if(!empty($_POST['v_p'])){
    $sql_access .= 'v_p-';
}
if(!empty($_POST['c_t'])){
    $sql_access .= 'c_t-';
}
if(!empty($_POST['c_e'])){
    $sql_access .= 'c_e-';
}
if(!empty($_POST['c_p'])){
    $sql_access .= 'c_p-';
}
if(!empty($_POST['v_d'])){
    $sql_access .= 'v_d-';
}
if(!empty($_POST['c_d'])){
    $sql_access .= 'c_d-';
}


$sql_access = substr($sql_access,0,-1);



$connect = mysqli_connect('127.0.0.1:3307', 'root', 'root', 'admin_panel');
$sql = "UPDATE `access` SET `access_rights` = '$sql_access' WHERE `access`.`id` = '$id_element';";
if(mysqli_query($connect, $sql)){
    header("Location: user_rights_for_db.php?db=$db&id_user=$id_user");
}


