<?php
if (isset($_POST['id']) && isset($_POST['comment'])) {
	$userid = intval($_COOKIE['ava_userid']);
	include '../../../config.php';
	include '../../core.php';
	include('../../..'.$setting['template_url'].'/template_settings.php');
	$the_comment = mysql_secure($_POST['comment'], 0);
	$id = intval($_POST['id']);

	if(isset($_COOKIE["ava_username"])){
	
		$cookie_id = intval($_COOKIE["ava_userid"]);
		$code = preg_replace("/[^a-z,A-Z,0-9]/", "", $_COOKIE['ava_code']);
		
		$user = mysql_query("SELECT * FROM ava_users WHERE id= $cookie_id");
		$user2 = mysql_fetch_array($user);
		
		$last_comment = mysql_query("SELECT last_comment FROM ava_users WHERE id = $cookie_id AND last_comment > NOW() - INTERVAL 1 MINUTE");
		if (mysql_num_rows($last_comment) == '0' || $user2['admin'] == 1) {

			if ($user2['password'] == $code && $user2['banned'] == 0) {

				$date = date("Y-m-d H:i:s");

				mysql_query("INSERT INTO ava_comments (user, comment, link_id, date, ip) VALUES ('$cookie_id', '$the_comment', '$id', '$date', '$_SERVER[REMOTE_ADDR]')");

				$comment = array('username' => $user2['username'], 'content' => stripslashes(nl2br(htmlspecialchars($_POST['comment']))), 'user_points' => $user2['points'], 'date' => FormatDate($date, 'time'));

				$comment['delete'] = '';
				$comment['report_button'] = '';

				$seo_username = seoname($user2['username']);
			
				$comment['user_url'] = ProfileUrl($user2['id'], $user2['seo_url']);
		
				if ($user2['avatar'] == '') {
					if ($user2['facebook'] == 1) {
						$comment['avatar_url'] = 'http://graph.facebook.com/'.$user2['facebook_id'].'/picture';
					}
					else {
						$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/default.png';
					}
				}
				else {
					$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/'.$user2['avatar'];
				}

				echo '<a name="1"></a>';
				include('../../..'.$setting['template_url'].'/'.$template['game_comment']);

				mysql_query("UPDATE ava_users SET comments = comments + 1, points = points + $setting[points_comment], last_comment = '$date' WHERE id='".$cookie_id."'") or die (mysql_error());

			}
		}
		else {
			echo '<e1>';
		}
	}
}
?>