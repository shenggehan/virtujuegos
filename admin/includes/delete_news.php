<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$result = mysql_query("DELETE FROM ava_news WHERE id='".$_POST['id']."'");

echo 'Success';
?>