<?php
include('../../config.php');
include('../../includes/core.php');

ksort($_POST);
$i = 1;
foreach($_POST as $key => $value) {
	if ($key != 'signature') {
		$value = rawurlencode($value);
		if ($i == 1) {
			$auth_string = $key.'='.$value;
			$i = 2;
		}
		else {
			$auth_string .= '&'.$key.'='.$value;
		}
	}
}
$auth_string .= $mochi['secret'];
$auth = md5($auth_string);

if ($auth == $_POST['signature']) {
	$score = intval($_POST['score']);
	$user = intval($_POST['userID']);
	$leaderboard = mysql_secure($_POST['boardID']);
	$gametag = mysql_secure($_POST['gameID']);

	$get_game = mysql_fetch_array(mysql_query("SELECT id FROM ava_games WHERE mochi_id = '$gametag'"));

	$check_for_prev_score = mysql_result(mysql_query("SELECT COUNT(*) AS Num FROM ava_highscores WHERE user = $user AND score = $score AND leaderboard = '$leaderboard'"),0);

	if ($check_for_prev_score == 0) {

		$date = date("Y-m-d H:i:s");

		mysql_query("INSERT INTO ava_highscores (game, score, user, date, leaderboard) VALUES ($get_game[id], $score, $user, '$date', '$leaderboard')") or die (mysql_error);

		mysql_query("UPDATE ava_users SET points = points + $setting[points_highscore] WHERE id = $user");

		$leaderboard_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards WHERE game_id = $get_game[id] AND leaderboard_id = '$leaderboard'"),0);

		if ($leaderboard_exists == 0) {

			// Was a leaderboard created with incorrect data?
			$failed_leaderboard_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards WHERE game_id = $get_game[id] AND leaderboard_id = '0'"),0);
			if ($failed_leaderboard_exists == 1) {
				mysql_query("UPDATE ava_leaderboards SET leaderboard_id = '$leaderboard' WHERE game_id = $get_game[id]");
				mysql_query("UPDATE ava_highscores SET leaderboard = '$leaderboard' WHERE game = $get_game[id]");
			}
			else {
				$lb_name = mysql_secure($_POST['title']);
				$lb_data = mysql_secure($_POST['datatype']);
				$lb_order = mysql_secure($_POST['sortOrder']);
				$lb_label = mysql_secure($_POST['scoreLabel']);

				mysql_query("INSERT INTO ava_leaderboards (game_id, leaderboard_id, leaderboard_name, data_type, order_by, label) VALUES ($get_game[id], '$leaderboard', '$lb_name', '$lb_data', '$lb_order', '$lb_label')") or die (mysql_error);
			}
		}
	}
}

?>