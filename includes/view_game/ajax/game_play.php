<?php
include '../../../config.php';
include '../../../includes/core.php';
	
$id = intval($_POST['game_id']);

mysql_query("UPDATE ava_games SET hits = hits + 1 WHERE id=$id") or die (mysql_error());
?>