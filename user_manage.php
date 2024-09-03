<?php
include "65_41_conDB.php";
include "header.php";
include "footer.php";
 $user_DB = new Server($servername, $DBusername, $DBpassword, 'loginDB');
 $user_conn = $user_DB->getConnection();
 $user_data = $user_DB->getSole($user_conn,'users',$_SESSION['id']);

 $user = $user_DB->getSole($user_conn,$userInfoTable,$_SESSION['id']);

 $fullname = ((isset($user['fname']) && $user['fname'] != "ยังไม่ได้ตั้ง") && (isset($user['lname']) && $user['lname'] != "ยังไม่ได้ตั้ง")) 
 ? $user['fname'] . " " . $user['lname']
 : "ยังไม่ได้ตั้งชื่อ";

error_reporting(0);
 
?>