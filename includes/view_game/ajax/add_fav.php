<?php
include '../../../config.php';
$id = intval($_POST['id']);
$userid = intval($_COOKIE['ava_userid']);

$sql = mysql_query("SELECT * FROM ava_users WHERE id=".$userid."");
$row = mysql_fetch_array($sql);
if ($row['password'] == $_COOKIE['ava_code'] && $row['banned'] == 0) {
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_favourites WHERE user_id='$userid' AND game_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		// Remove favourite
		mysql_query("DELETE FROM ava_favourites WHERE user_id='$userid' AND game_id='$id'");
		$user_favs = str_replace(', '.$id, '', $row['favourites']);
		mysql_query("UPDATE ava_users SET favourites='$user_favs' WHERE id='$userid'");
	}
	else {
		// Add favourite
		mysql_query("INSERT INTO ava_favourites (user_id, game_id) VALUES ('$userid', '$id')");
		mysql_query("UPDATE ava_users SET favourites = CONCAT(favourites, ', $id') WHERE id='$userid'");
	}
}
?>