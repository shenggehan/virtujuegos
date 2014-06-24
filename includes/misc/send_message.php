<?php
defined( 'AVARCADE_' ) or die( '' );

if (isset($_GET['id'])) {
	if ($user['login_status'] == 1) {
		$last_comment = mysql_query("SELECT last_pm FROM ava_users WHERE id = $user[id] AND last_pm > NOW() - INTERVAL 1 MINUTE");
		if (mysql_num_rows($last_comment) == '0' || $user['admin'] == 1) {
			if (isset($_GET['done'])) {
				if ($_POST['message_title'] == "") {
					$subject = PM_NO_SUBJECT;
				}
				else {
					$subject = mysql_secure($_POST['message_title']);
				}
				$message = mysql_secure($_POST['message']);

				SendPM($subject, $message, $id);
			
				$date = date("Y-m-d H:i:s");
				mysql_query("UPDATE ava_users SET last_pm = '$date' WHERE id = $user[id]") or die (mysql_error());
			
				echo PM_MESSAGE_SENT.'<br /><br />
				<a href="'.$setting['site_url'].'/index.php?task=profile&id='.$id.'">'.PM_RETURN_TO_PROFILE.'</a><br /> 
				<a href="'.$setting['site_url'].'/index.php?task=messages">'.PM_RETURN_TO_INBOX.'</a>';
				
				$subject = secure($_POST['message_title']);
				$message = secure($_POST['message']);
			
				$to_user = mysql_fetch_array(mysql_query("SELECT username,email,email_new_message from ava_users WHERE id = $id"));
				$data = array('to_username' => $to_user['username'], 'email_address' => $to_user['email'], 'from_username' => $user['username'], 'from_avatar' => $user['avatar'], 'message' => $message, 'message_title' => $subject, 'subject' => $user['username'].' '.EMAIL_MESSAGE_INTRO, 'send_email' => $to_user['email_new_message']);

				if ($setting['seo_on'] != 0) {
					$data['message_url'] = $setting['site_url'].'/messages';
				}
				else {
					$data['message_url'] = $setting['site_url'].'/?task=messages';
				}
			
				SendEmail($data, 'new_message');
			}
			else {
				if(isset($_GET['re'])) {
					$re = intval($_GET['re']);
					$re = mysql_query("SELECT * FROM ava_messages WHERE id=$re AND user_id=$user[id]");
					$re2 = mysql_fetch_array($re);
					$title = str_replace("Re: ", "", $re2['title']);
					$subject = 'Re: '.$title;
				}
				else {
					$subject = '';
				}
				if (isset($template['pm_form'])) {
					include '.'.$setting['template_url'].'/'.$template['pm_form'];
				}
				else {
					include 'includes/forms/pm_form.php';
				}
			}
		}
		else {
			echo '<div id="pm_task_complete">'.PM_FLOOD_CONTROL.'</div>';
			include 'includes/misc/messages.php';
		}
	}
	else {
		echo '<br />'.PM_LOGIN.'<br /><br />';
		include 'includes/forms/login_form.php';
	}
}

?>