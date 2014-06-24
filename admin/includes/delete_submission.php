<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$result = mysql_query("DELETE FROM ava_submissions WHERE id='".$_POST['id']."'");

if (isset($_POST['givepoints']))
	mysql_query("UPDATE ava_users SET points = points + $setting[points_submission] WHERE id= $_POST[user]") or die (mysql_error());

echo 'Success';
?>