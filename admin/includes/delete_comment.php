<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$comment = mysql_query("SELECT * FROM ava_comments WHERE id='".$_POST['id']."'");
$get_comment = mysql_fetch_array($comment);
mysql_query("UPDATE ava_users SET comments = comments - 1, points = points - $setting[points_comment] WHERE id='".$get_comment['user']."'") or die (mysql_error());

$result = mysql_query("DELETE FROM ava_comments WHERE id='".$_POST['id']."'");
echo $_POST['id'];

echo 'Success';
?>