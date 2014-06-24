<?php
include '../../../config.php';
include '../../core.php';
include '../../../language/'.$setting['language'].'.php';
$id = intval($_POST['id']);
$userid = intval($_COOKIE['ava_userid']);

$game_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE id = $id"), 0);

if (isset($_COOKIE["ava_username"]) && $game_exists == 1) {
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_ratings WHERE user_id='$userid' AND game_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		$error = ALREADY_RATED;
	}
	else {
		$ava_userid = intval($_COOKIE['ava_userid']);
		$rating = intval($_POST['rating']);

		if ($_POST['rating'] > 5 || $_POST['rating'] < 0) {
			$error = "({success: 0, error: 'False rating'})";
			exit();
		}


		$sql = mysql_query("SELECT * FROM ava_users WHERE id=".$userid."");
		$user = mysql_fetch_array($sql);
		
		$date = time();
		$point_spam_control = $date - $setting['point_spam_time'];
		
		if ($user['password'] == $_COOKIE['ava_code'] && $user['banned'] == 0) {
			mysql_query("INSERT INTO ava_ratings (game_id, user_id, rating, ip) VALUES ('$id', '$ava_userid', '$rating', '$_SERVER[REMOTE_ADDR]')");
				
			$no_of_ratings = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_ratings WHERE game_id='$id'"),0);
			$get_ratings = mysql_query("SELECT sum(rating) AS rating FROM ava_ratings WHERE game_id='$id'");
			$ratings_sum = mysql_fetch_array($get_ratings);

			$rating = ($ratings_sum['rating'] / $no_of_ratings);
				
			mysql_query("UPDATE ava_games SET rating='$rating' WHERE id='$id'") or die (mysql_error());
			
			if ($point_spam_control > $user['last_points_time'] || $user['last_points_game'] == $id) {
				mysql_query("UPDATE ava_users SET ratings = ratings + 1, points = points + $setting[points_rate], last_points_time = $date, last_points_game = $id WHERE id='".$userid."'") or die (mysql_error());
				echo "({success: 1, message: '".addslashes(N_POINTS_EARNED1)." <span style=\"font-weight:bold;\">$setting[points_rate] ".addslashes(N_POINTS_EARNED2)."</span> ".addslashes(N_POINTS_EARNED_RATING)."', points: $setting[points_rate]})";
			}
			else {
				echo "({success: 0, message: '".addslashes(N_NO_POINTS)." <a href=\"#\">Info</a>'})";
			}
		}
	}
}

?>