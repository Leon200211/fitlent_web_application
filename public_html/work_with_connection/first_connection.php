<?php





function access_rights_check($connect_to_new_server, $user_name){

    // пробное решение
    $sql = "SELECT IF(COUNT(*) > 0, TRUE, FALSE) AS Allowed FROM INFORMATION_SCHEMA.USER_PRIVILEGES WHERE GRANTEE LIKE '%$user_name%' AND PRIVILEGE_TYPE = 'ROLE_ADMIN';";

    $result = $connect_to_new_server->query($sql);
    $is_admin = $result->fetch_assoc();

    return $is_admin['Allowed'];

}


// создаем среду на сервере для работы гуи
function create_environment_for_work($host, $user_name, $password){

    $filename = "create_environment.sql";
    // формируем запрос к консоли бд
    $command = 'mysql -h ' . $host . ' -u ' . $user_name . ' -p' . $password . ' < ' . $filename;
    // выполняем команду
    exec($command, $output, $worked);
    switch ($worked) {
        case 0:
            //echo 'Import file <b>' . $filename . '</b> successfully imported to database <b>' . '</b>';
            break;
        case 1:
            echo 'There was an error during import.'
                . 'Please make sure the import file is saved in the same folder as this script and check your values:'
                . '<br/><br/><table>'
                . '<tr><td>MySQL User Name:</td><td><b>' . $user_name . '</b></td></tr>'
                . '<tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr>'
                . '<tr><td>MySQL Host Name:</td><td><b>' . $host . '</b></td></tr>'
                . '<tr><td>MySQL Import Filename:</td><td><b>' . $filename . '</b></td>'
                . '</tr></table>';
            break;
    }




    $filename_2 = "admin_panel.sql";
    // формируем запрос к консоли бд
    $command_2 = 'mysql -h ' . $host . ' -u ' . $user_name . ' -p' . $password . ' test_scritp' . ' < ' . $filename_2;
    // выполняем команду
    exec($command_2, $output_2, $worked_2);
    switch ($worked_2) {
        case 0:
            //echo 'Import file <b>' . $filename . '</b> successfully imported to database <b>' . '</b>';
            break;
        case 1:
            echo 'There was an error during import.'
                . 'Please make sure the import file is saved in the same folder as this script and check your values:'
                . '<br/><br/><table>'
                . '<tr><td>MySQL Database Name:</td><td><b>' .  '</b></td></tr>'
                . '<tr><td>MySQL User Name:</td><td><b>' . $user_name . '</b></td></tr>'
                . '<tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr>'
                . '<tr><td>MySQL Host Name:</td><td><b>' . $host . '</b></td></tr>'
                . '<tr><td>MySQL Import Filename:</td><td><b>' . $filename_2 . '</b></td>'
                . '</tr></table>';
            break;
    }


    if($worked == 0 and $worked_2 == 0){
        return 1;
    }

}

