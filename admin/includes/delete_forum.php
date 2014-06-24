<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

mysql_query("DELETE FROM ava_forums WHERE id = $_POST[id]");

mysql_query("UPDATE ava_forums SET parent_id = $_POST[new_forum] WHERE parent_id = $_POST[id]");
?>