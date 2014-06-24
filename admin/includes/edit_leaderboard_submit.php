<?php
include '../../config.php';
include '../../includes/core.php';
include '../secure.php';
include '../admin_functions.php';
if ($login_status != 1) exit();

mysql_query("UPDATE ava_leaderboards SET leaderboard_name= '$_POST[name]', label = '$_POST[units]', order_by = '$_POST[sort]' WHERE id = $_POST[id]");
?>