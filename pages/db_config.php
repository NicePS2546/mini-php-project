<?php
include "../utils/Server.php";
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db_654230015';
$table = 'tb_reservation';
$userInfoTable = 'user_info';
$userTable = 'users';
$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);

$connect = $server->getConnection();
?>