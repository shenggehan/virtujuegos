<?php
session_start();
$session=session_id();
$time=time();

if (isset($user['login_status']) && $user['login_status'] == 1) {
	$user_id = $user['id'];
	$sql = mysql_query("SELECT * FROM ava_usersonline WHERE user_id = $user_id"); 
}
else if (isset($core_admin)) {
	$user_id = $admin['id'];
	$sql = mysql_query("SELECT * FROM ava_usersonline WHERE user_id = $user_id");
}
else {
	$user_id = 0;
	$sql = mysql_query("SELECT * FROM ava_usersonline WHERE session_id = '$session'");
}

$count = mysql_num_rows($sql);

if ($count == 0) {
	mysql_query("INSERT INTO ava_usersonline (session_id, time, user_id) VALUES ('$session', '$time', '$user_id')");
}
else {
	if ($user_id != 0) {
		mysql_query("UPDATE ava_usersonline SET time= '$time', session_id = '$session' WHERE user_id = '$user_id'");
	}
	else {
		mysql_query("UPDATE ava_usersonline SET time= '$time', user_id = '$user_id' WHERE session_id = '$session'");
	}
}

$time_check = $time-600; // Current time minus 10 mins

// Delete all records older than 10 mins
mysql_query("DELETE FROM ava_usersonline WHERE time < $time_check");

?>