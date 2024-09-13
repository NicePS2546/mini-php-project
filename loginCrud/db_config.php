<?php
// include "../utils/Server.php";
include __DIR__ . "/../utils/Server.php";

$servername = 'localhost';
$DBusername = 'root';
$DBpassword = '';
$dataBaseName = 'LoginDB';
$table = 'users';
$userInfoTable = 'user_info';


$server = new Server($servername, $DBusername, $DBpassword, $dataBaseName);
$connect = $server->getConnection();

?>