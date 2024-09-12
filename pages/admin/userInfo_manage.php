<?php
    include_once '../../loginCrud/db_config.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    };
    
    $user = $server->getSoleJoin($connect, $table, $userInfoTable, 'id','id', $_SESSION['id'] );
    $avatar = $user['avatar'] == "default_avatar" ? $default_img : "../../image/upload/" . $user['avatar'];

?>