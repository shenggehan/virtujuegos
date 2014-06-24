<?php
if (isset($_COOKIE["ava_username"])) {
	$abcd = seoname($_COOKIE["ava_username"]);

	if ($setting['seo_on'] == 0) {
		$url = 'index.php?task=profile&amp;id='.$_COOKIE['ava_userid'].'';
		$message_url = 'index.php?task=messages';
	}
	else {
		$url = 'profile/'.$_COOKIE['ava_userid'].'/'.$abcd.'';
		$message_url = 'messages';
	}

	$new_messages = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE `read` = 0 AND user_id=".$userid.""), 0);

	echo '<b>'.$_COOKIE['ava_username'].'</b> logged in'.$template['user_menu_seperator'].'<img src="'.$setting['site_url'].'/content/images/key.png"align="texttop" /> <a href="'.$setting['site_url'].'/login.php?action=logout">'.LOGOUT.'</a>'.$template['user_menu_seperator'].'<img src="'.$setting['site_url'].'/content/images/newmessage.png" align="texttop" /> <a href="'.$setting['site_url'].'/'.$message_url.'">'.MESSAGES.'</a> ('.$new_messages.')'.$template['user_menu_seperator'].'<img src="'.$setting['site_url'].'/content/images/profile.png" align="texttop" /> <a href="'.$setting['site_url'].'/'.$url.'">'.MY_PROFILE.'</a>';
	$sql = mysql_query("SELECT * FROM ava_users WHERE id=".$userid."");
	while ($row = mysql_fetch_array($sql)) {
		if ($row['admin'] == 1) {
			echo $template['user_menu_seperator'].'<img src="'.$setting['site_url'].'/content/images/admin.png"align="texttop" /> <a href='.$setting['site_url'].'/admin/>'.ADMIN.'</a>';
		}
	}
}
else {
	if ($setting['play_limit'] == 1) {
		if ($setting['plays'] <= $_COOKIE["ava_plays"]) {
			echo ''.REGISTER_NOW.' - ';
		}
		else {
			$left = ($setting['plays'] - $_COOKIE["ava_plays"]);
			echo ''.YOU_HAVE.' '.$left.' '.YOU_HAVE2.' - ';
		}}
	echo '<strong><a href="'.$setting['site_url'].'/index.php?task=login">'.LOGIN.'</a> | <a href="'.$setting['site_url'].'/index.php?task=register">'.REGISTER.'</a></strong>';

}
?>