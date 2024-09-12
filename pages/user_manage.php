<?php
include "db_config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
;

$user_DB = new Server($servername, $DBusername, $DBpassword, 'loginDB');
$user_conn = $user_DB->getConnection();
// $user_data = $user_DB->getSole($user_conn, 'users', $_SESSION['id']);
$default_img = "https://firebasestorage.googleapis.com/v0/b/loginsys-b8d67.appspot.com/o/default_avatar.jpg?alt=media&token=7f437efa-c1af-46c6-a652-6445ea259caf";
$user = $user_DB->getSoleJoin($user_conn, $userTable, $userInfoTable, 'id','id', $_SESSION['id'] );
$avatar = $user['avatar'] == "default_avatar" ? $default_img : "../image/upload/".$_SESSION['id']."/" . $user['avatar'];

$fullname = ((isset($user['fname']) && $user['fname'] != "ยังไม่ได้ตั้ง") && (isset($user['lname']) && $user['lname'] != "ยังไม่ได้ตั้ง"))
    ? $user['fname'] . " " . $user['lname']
    : "ยังไม่ได้ตั้งชื่อ";

error_reporting(0);

?>