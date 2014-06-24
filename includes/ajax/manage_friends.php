<?php
include '../../config.php';
include '../../includes/core.php';
include '../../language/'.$setting['language'].'.php';

if (isset($_COOKIE["ava_username"])) {
	$xuser = $_COOKIE['ava_username'];
	$xcode = $_COOKIE['ava_code'];
	$xuserid = intval($_COOKIE['ava_userid']);
	$xcode2 = preg_replace("/[^a-z,A-Z,0-9]/", "", $xcode);


	$sql = mysql_query("SELECT * FROM ava_users WHERE id='$xuserid' AND password='$xcode2' LIMIT 1");
	$login_check = mysql_num_rows($sql);
	if ($login_check == 1) {
		$friend = intval($_POST['id']);
		// Delete a mutual friend
		if ($_POST['type'] == 'delete_friend') {
			mysql_query("DELETE FROM ava_friends WHERE user1 = $xuserid AND user2 = $friend");
			mysql_query("DELETE FROM ava_friends WHERE user1 = $friend AND user2 = $xuserid");
		}
		// Delete/Reject a friend request
		else if ($_POST['type'] == 'delete_request') {
			mysql_query("DELETE FROM ava_friend_requests WHERE from_user = $friend AND to_user = $xuserid") or die (mysql_error());	
			mysql_query("UPDATE ava_users SET friend_requests = friend_requests - 1 WHERE id = $xuserid");
		}
		// Send request
		else if ($_POST['type'] == 'send_request') {
			$request_exists = mysql_query("SELECT * FROM ava_friend_requests WHERE (from_user = $friend AND to_user = $xuserid) OR (from_user = $xuserid AND to_user = $friend)");
			$already_friends = mysql_query("SELECT * FROM ava_friends WHERE user1 = $friend AND user2 = $xuserid");
			if ((!mysql_num_rows($request_exists)) && (!mysql_num_rows($already_friends))) {
				mysql_query("INSERT INTO ava_friend_requests SET from_user = $xuserid, to_user = $friend");
				mysql_query("UPDATE ava_users SET friend_requests = friend_requests + 1, new_frs = 1 WHERE id = $friend");
				
				$user_data = mysql_query("SELECT * FROM ava_users WHERE id = $friend OR id = $xuserid");
				while ($user = mysql_fetch_array($user_data)) {
					if  ($user['id'] == $friend) {
						$to_data = array('email_address' => $user['email'], 'to_username' => $user['username'], 'send_email' => $user['email_friend_request']);
					}
					else {
						$from_data = array('from_username' => $user['username'], 'from_join_date' => $user['joined'], 'from_location' => $user['location']);
						$from_data['from_avatar'] = AvatarUrl($user['avatar'], $user['facebook'], $user['facebook_id']);
					}
				}
				$data = $to_data + $from_data;
				$data['subject'] = EMAIL_FR_HEADING;
				if ($setting['seo_on'] != 0) {
					$data['accept_link'] = $setting['site_url'].'/friends';
				}
				else {
					$data['accept_link'] = $setting['site_url'].'/?task=friends';
				}
				SendEmail($data, 'friend_request');
			}
		}
		// Accept friend request
		else {
			$valid_request = mysql_query("SELECT * FROM ava_friend_requests WHERE from_user = $friend AND to_user = $xuserid");
			if (mysql_num_rows($valid_request)) {
				mysql_query("INSERT INTO ava_friends SET user1 = $xuserid, user2 = $friend");
				mysql_query("INSERT INTO ava_friends SET user1 = $friend, user2 = $xuserid");
				mysql_query("DELETE FROM ava_friend_requests WHERE from_user = $friend AND to_user = $xuserid") or die (mysql_error());	
				mysql_query("UPDATE ava_users SET friend_requests = friend_requests - 1 WHERE id = $xuserid");
			}
		}
	}
}
?>