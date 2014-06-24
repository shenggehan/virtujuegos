<?php
// VIEW A PRIVATE MESSAGE
defined( 'AVARCADE_' ) or die( '' );

if (isset($_COOKIE["ava_username"])) {
	$sql = mysql_query("SELECT * FROM ava_messages WHERE id= $id");
	$row = mysql_fetch_array($sql);

	if ($user['id'] == $row['user_id']) {

		// Display the PM and the options
		echo '<div class="pm_header">
	<div class="pm_subject">'.$row['title'].'</div>
	<div class="pm_details"><strong>'.PM_FROM.':</strong> <a href="'.$setting['site_url'].'/index.php?task=profile&amp;id='.$row['sender_id'].'">'.$row['sender_name'].'</a> <strong>'.PM_DATE.':</strong> '.FormatDate($row['date'], 'time').'</div></div>

	<div class="pm_message">'.$row['message'].'</div>';

	$profile_url = ProfileUrl($row['sender_id'], seoname($row['sender_name']));

	echo ' <div class="pm_footer">
		<p class="sub_button"><a href="'.$setting['site_url'].'/index.php?task=send_message&amp;id='.$row['sender_id'].'&re='.$row['id'].'">'.PM_REPLY.'</a></p> 
		<p class="sub_button"><a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=delete&id='.$row['id'].'">'.PM_DELETE_MESSAGE.'</a></p> 
		<p class="sub_button"><a href="'.$profile_url.'">'.PM_SENDER_PROFILE.'</a></p>
		<p class="sub_button"><a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=unread&id='.$row['id'].'">'.PM_MARK_UNREAD.'</a></p>';

		if ($row['highscore_game_id'] == 0) {
			echo ' <p class="sub_button"><a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/pm_report_form.php?id='.$row['id'].'\', \''.PM_REPORT.'\');return false">'.PM_REPORT.'</a></p>';
		}
		echo '</div>';
		if($row['read'] == 0) {
			mysql_query("UPDATE ava_messages SET `read` = 1 WHERE id = $row[id] LIMIT 1");
			// Update user messages counter
			$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE user_id=$user[id] AND `read`=0"),0);
			$update = mysql_query("UPDATE ava_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
		}

	}
	else {
		echo PM_NOT_YOURS;
	}
}
else {
	echo '<br />'.PM_LOGIN.'<br /><br />';
	include 'login_form.php';
}
?>