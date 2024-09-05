<?php
include "condb.php";
$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'db_654230015';
$table = 'tb_reservation';
$userInfoTable = 'user_info';

$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);

$connect = $server->getConnection();
?>