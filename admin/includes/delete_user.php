<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$q = mysql_query("SELECT * FROM ava_users WHERE id = $_POST[id]");
$r = mysql_fetch_array($q);

$result = mysql_query("DELETE FROM ava_users WHERE id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_comments WHERE user='".$_POST['id']."'");
mysql_query("DELETE FROM ava_news_comments WHERE user='".$_POST['id']."'");
mysql_query("DELETE FROM ava_highscores WHERE user='".$_POST['id']."'");
mysql_query("DELETE FROM ava_messages WHERE user_id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_favourites WHERE user_id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_friends WHERE user1='".$_POST['id']."' OR user2='".$_POST['id']."'");

$file = '../../uploads/avatars/'.$r['avatar'];
unlink($file);

echo 'Success';
?>