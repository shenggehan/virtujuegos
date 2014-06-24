<?php
include '../../config.php';
include '../../includes/core.php';
include '../../language/'.$setting['language'].'.php';

$cookie_id = intval($_COOKIE["ava_userid"]);
$code = preg_replace("/[^a-z,A-Z,0-9]/", "", $_COOKIE['ava_code']);

$friend_id = intval($_POST['friend_id']);
$leaderboard_id = mysql_secure($_POST['leaderboard']);
$game_id = intval($_POST['game_id']);

$get_user = mysql_query("SELECT * FROM ava_users WHERE id= $cookie_id");
$user = mysql_fetch_array($get_user);
$are_friends = mysql_num_rows(mysql_query("SELECT * FROM ava_friends WHERE user1 = $cookie_id AND user2 = $friend_id"));

if ($user['password'] == $code && $user['banned'] == 0 && $are_friends == 1) {

	if ($leaderboard_id == 'latest') {
		$score = mysql_query("SELECT * FROM ava_highscores WHERE user = $user[id] AND game = $game_id ORDER BY id DESC LIMIT 1");
		$highscore = mysql_fetch_array($score);
		$leaderboard = mysql_fetch_array(mysql_query("SELECT * FROM ava_leaderboards WHERE leaderboard_id = '$highscore[leaderboard]' AND game_id = $game_id"));
	}
	else {
		$leaderboard = mysql_fetch_array(mysql_query("SELECT * FROM ava_leaderboards WHERE leaderboard_id = '$leaderboard_id' AND game_id = $game_id"));
		$score = mysql_query("SELECT * FROM ava_highscores WHERE user = $user[id] AND game = $game_id AND leaderboard = '$leaderboard_id' ORDER BY score $leaderboard[order_by] LIMIT 1");
		$highscore = mysql_fetch_array($score);
	}

	$already_challenged = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE highscore_game_id = $highscore[game]"), 0);

	if ($already_challenged == 0) {

		$game = mysql_fetch_array(mysql_query("SELECT * FROM ava_games WHERE id = $game_id"));

		$subject = CHALLENGE_PM_SUBJECT1." $highscore[score] ".CHALLENGE_PM_SUBJECT2." $game[name]";

		$game_thumbnail = GameImageUrl($game['image'], $game['import'], $game['url']);
		$game_url = GameUrl($game['id'], $game['seo_url'], $game['category_id']);

		$get_to_user = mysql_query("SELECT * FROM ava_users WHERE id= $friend_id");
		$to_user = mysql_fetch_array($get_to_user);

		$message = CHALLENGE_PM_GREETING1.' '.$to_user['username'].', '.$user['username'].' '.CHALLENGE_PM_GREETING2.'
		<div class="challenge_pm_container">
			<div class="challenge_pm_image"><img src="'.$game_thumbnail.'" width="80" height="80"/></div>
			<div class="challenge_pm_info"><b>'.GAME.'</b>: <a href="'.$game_url.'">'.$game['name'].'</a><br /><b>'.LEADERBOARD.'</b>: '.$leaderboard['leaderboard_name'].'<br /><b>'.HIGHSCORE_SCORE.'</b>: '.$highscore['score'].'</div>
		</div>';

		SendPM($subject, $message, $friend_id, $game['id']);

		mysql_query("UPDATE ava_users SET points = points + $setting[points_challenge] WHERE id = $user[id]");

		$data = array('to_username' => $to_user['username'], 'email_address' => $to_user['email'], 'from_username' => $user['username'], 'from_avatar' => $user['avatar'], 'subject' => $user['username'].' '.CHALLENGE_PM_GREETING2, 'send_email' => $to_user['email_new_message'], 'game_name' => $game['name'], 'game_url' => $game_url, 'game_image' => $game_thumbnail, 'leaderboard_name' => $leaderboard['leaderboard_name'], 'score' => $highscore['score']);

		SendEmail($data, 'highscore_challenge');
		
		echo "({success: 1, message: '".addslashes(N_POINTS_EARNED1)." <span style=\"font-weight:bold;\">$setting[points_challenge] ".addslashes(N_POINTS_EARNED2)."</span> ".addslashes(N_POINTS_EARNED_CHALLENGE)."', points: $setting[points_challenge]})";
	}
	else {
		echo "({success: 0, message: 'You have already challenged that friend'})";
	}
}
?>