<?php
if(isset($_COOKIE["ava_userid"]) && isset($_POST['core'])) {
	include '../../../config.php';
	include '../../../includes/core.php';
	include '../../../language/'.$setting['language'].'.php';

	$cookie_id = intval($_COOKIE["ava_userid"]);
	$game_id = intval($_POST['game_id']);
	
	$sql = mysql_query("SELECT * FROM ava_users WHERE id= $cookie_id");
	$user = mysql_fetch_array($sql);
	if ($user['password'] == $_COOKIE['ava_code'] && $user['banned'] == 0) {
		$date = time();
		$point_spam_control = $date - $setting['point_spam_time'];
		
		if ($point_spam_control > $user['last_points_time'] || $user['last_points_game'] == $game_id) {
			mysql_query("UPDATE ava_users SET plays = plays + 1, points = points + $setting[points_play], last_points_time = $date, last_points_game = $game_id WHERE id='".$cookie_id."'") or die (mysql_error());
			echo "({success: 1, message: '".addslashes(N_POINTS_EARNED1)." <span style=\"font-weight:bold;\">$setting[points_play] ".addslashes(N_POINTS_EARNED2)."</span> ".addslashes(N_POINTS_EARNED_PLAY)."', points: $setting[points_play]})";
		}
		else {
			echo "({success: 0, message: '".addslashes(N_NO_POINTS)."'})";
		}
	}
}
?>