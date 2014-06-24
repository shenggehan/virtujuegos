<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$result = mysql_query("UPDATE ava_users SET banned = $_POST[value] WHERE id= $_POST[id]");
?>