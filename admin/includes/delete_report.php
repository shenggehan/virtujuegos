<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

if (($_POST['type'] == 1) && ($_POST['user'] != 0)) {
	mysql_query("UPDATE ava_users SET points = points + $setting[points_report] WHERE id= $_POST[user]") or die (mysql_error());
}

$result = mysql_query("DELETE FROM ava_reported WHERE id='".$_POST['id']."'");
echo $_POST['id'];

echo 'Success';
?>