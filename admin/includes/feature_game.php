<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$q = mysql_query("SELECT featured FROM ava_games WHERE id=$_POST[id]");
$game = mysql_fetch_array($q);

if ($game['featured'] == 1) {
	mysql_query("UPDATE ava_games SET featured=0 WHERE id=$_POST[id]");
}
else {
	mysql_query("UPDATE ava_games SET featured=1 WHERE id=$_POST[id]");
}
