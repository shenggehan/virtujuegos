<?php

if ($setting['seo_on'] == 0) {
	$message_url = 'index.php?task=messages';
}
else {
	$message_url = 'messages';
}

$url = ProfileUrl($_COOKIE['ava_userid'], seourl($_COOKIE['ava_username']));

if (isset($_COOKIE["ava_username"])) {
	$new_messages = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE `read` = 0 AND user_id=".$userid.""), 0);

	echo '<b>'.$_COOKIE['ava_username'].' logged in</b><br /><a href='.$setting['site_url'].'/login.php?action=logout>'.LOGOUT.'</a><br /><a href="'.$setting['site_url'].'/'.$message_url.'">'.MESSAGES.'</a> ('.$new_messages.')<br><a href='.$setting['site_url'].'/'.$url.'>'.MY_PROFILE.'</a>';
	$sql = mysql_query("SELECT * FROM ava_users WHERE id=".$userid."");
	while ($row = mysql_fetch_array($sql)) {
		if ($row['admin'] == 1) {
			echo "<br /><a href=".$setting['site_url']."/admin/>Administration</a>";
		}
	}
}
else {
	echo '<div align="center">';
	if ($setting['play_limit'] == 1) {
		if ($setting['plays'] <= $_COOKIE["ava_plays"]) {
			echo '<strong>'.REGISTER_NOW.'</strong>';
		}
		else {
			$left = ($setting['plays'] - $_COOKIE["ava_plays"]);
			echo '<strong>'.YOU_HAVE.' '.$left.' '.YOU_HAVE2.'</strong>';
		}}
	include 'content/login.php';
}
?>