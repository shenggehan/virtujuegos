<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$get_lb = mysql_fetch_array(mysql_query("SELECT game_id, leaderboard_id FROM ava_leaderboards WHERE id= '$_POST[id]'"));

mysql_query("DELETE FROM ava_leaderboards WHERE id = '$_POST[id]'");

mysql_query("DELETE FROM ava_highscores WHERE leaderboard = '$get_lb[leaderboard_id]' AND game = $get_lb[game_id]");

echo 'Success';
?>