<?php
defined( 'AVARCADE_' ) or die( '' );
if ($user['login_status'] != 0) {
	if (isset($_POST['location'])) {
			
		$location = mysql_secure($_POST['location']);
		$interests = mysql_secure($_POST['interests']);
		$about = mysql_secure($_POST['about']);
		$email_new_message = intval($_POST['email_new_message']);
		$email_friend_request = intval($_POST['email_friend_request']);
		$email_highscore_challenge = intval($_POST['email_highscore_challenge']);
			
		if (strpos($_POST['website'], "http://") === false) {
			$website = 'http://'.$_POST['website'];
		}
		else {
			$website = $_POST['website'];
		}
			
		$website = mysql_secure($website);
		
		if (isset($_POST['mbbc-editor'])) {
			$forum_signature = ", forum_signature = '".mysql_secure($_POST['mbbc-editor'], 0)."'";
		}
		else {
			$forum_signature = '';
		}
			
		mysql_query("UPDATE ava_users SET location='$location', interests='$interests', about='$about', website='$website', email_new_message = $email_new_message, email_friend_request = $email_friend_request, email_highscore_challenge = $email_highscore_challenge $forum_signature WHERE id='$user[id]'") 
		or die (mysql_error());
			
		$pass = str_replace(' ', '', $_POST['new_password']); 
			
		if ($pass != '') {
			$password = md5($_POST['new_password']);
			mysql_query("UPDATE ava_users SET password='$password' WHERE id= $user[id]") 
			or die (mysql_error());
		}
			
		echo '<div id="error_message">'.PROFILE_UPDATED."</div>";
		
	}
	else if (isset($_GET['done']) && $_GET['done'] == 'avatar') {
		include('avatar_upload.php');
	}
			
	$sql = mysql_query("SELECT * FROM ava_users WHERE id= $user[id]");
	$profile_info = mysql_fetch_array($sql);
		
	if (isset($template['edit_profile_form'])) {
		include('.'.$setting['template_url'].'/'.$template['edit_profile_form']);
	}
	else {
		include('./includes/forms/edit_profile_form.php');
	}
}
else { 
	echo "Login to edit your profile"; 
}
?>
