<?php 
if (isset($_GET['page'])) {
	require_once '../../config.php';
	require_once '../../includes/core.php';
	include '../../language/'.$setting['language'].'.php';
	$id = intval($_GET['id']);
	$user = GetUser();
	if ($user['login_status'] == 1)
		$user_id = $user['id'];
}

if(!isset($_GET['page'])){
    $page = 1;
}
else if($_GET['page'] == ''){
    $page = 1;
} else {
    $page = intval($_GET['page']);
}

$max_results = 10;
$from = (($page * $max_results) - $max_results);

$lb_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards WHERE game_id = $id LIMIT 1"),0);
if ($lb_count != 0) {

	$leaderboard = mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $id");
	if (isset($_GET['lb_id']))
		$lb_id = mysql_secure($_GET['lb_id']);
	else
		$lb_id = 0;
	echo '<div class="highscore_title">'.LEADERBOARD.': <select name="leaderboard" id="leaderboard_select" onchange="HighscorePage('.$id.', 1, \'\', \''.$setting['site_url'].'\', 1); return false">';
		while ($leaderboards_q = mysql_fetch_array($leaderboard)) {
			if ($leaderboards_q['leaderboard_id'] == $lb_id) {
				echo '<option value="'.$leaderboards_q['leaderboard_id'].'" selected>'.$leaderboards_q['leaderboard_name'].'</option>';
				$get_leaderboard = $leaderboards_q;
			} else {
				echo '<option value="'.$leaderboards_q['leaderboard_id'].'">'.$leaderboards_q['leaderboard_name'].'</option>';
				if (!isset($get_leaderboard) && (!isset($_GET['lb_id']) || $_GET['lb_id'] == 'unspecified')) {
					$get_leaderboard = $leaderboards_q;
				}
			}
		}
	echo '</select>';
	
	if (isset($_COOKIE['ava_userid'])) {
		echo ' '.HIGHSCORES_SHOW.': 
		<select name="scope" id="leaderboard_scope" onchange="HighscorePage('.$id.', 1, \'\', \''.$setting['site_url'].'\', 1); return false">';
	
		if (isset($_GET['scope']) && $_GET['scope'] == 'friends') {
			echo '<option value="all">'.HIGHSCORES_ALL.'</div>
			<option value="friends" selected>'.HIGHSCORES_FRIENDS.'</div>';
		}
		else {
			echo '<option value="all" selected>'.HIGHSCORES_ALL.'</div>
			<option value="friends">'.HIGHSCORES_FRIENDS.'</div>';
		}

		echo '</select>';
	}
	
	echo '</div>';
	
	$lb_id = $get_leaderboard['leaderboard_id'];
	
	if (isset($_GET['scope']) && $_GET['scope'] == 'friends') {
		$count = mysql_result(mysql_query("SELECT COUNT(*) AS Num 
		FROM ava_users
			LEFT JOIN ava_friends
			ON ava_users.id = ava_friends.user1 AND ava_friends.user2 = $user_id
			RIGHT JOIN ava_highscores
			ON ava_highscores.user = ava_users.id
			WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]' AND  (user2 = $user_id OR ava_users.id = $user_id)"),0);
	}
	else {
		$count = mysql_result(mysql_query("SELECT COUNT(*) AS Num FROM ava_highscores WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]'"), 0);
	}
	
	if ($count) {

		if (isset($_GET['scope']) && $_GET['scope'] == 'friends') {
			$query = mysql_query("SELECT ava_users.*, ava_highscores.score, ava_highscores.date, ava_highscores.id as score_id 
			FROM ava_users
			LEFT JOIN ava_friends
			ON ava_users.id = ava_friends.user1 AND ava_friends.user2 = $user_id
			RIGHT JOIN ava_highscores
			ON ava_highscores.user = ava_users.id
			WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]' AND  (user2 = $user_id OR ava_users.id = $user_id)
			ORDER BY score $get_leaderboard[order_by] LIMIT $from, $max_results") or die(mysql_error());
		}
		else {
			$query = mysql_query("SELECT ava_users.*, ava_highscores.score, ava_highscores.date, ava_highscores.id as score_id 
			FROM ava_highscores 
			LEFT JOIN ava_users
			ON ava_users.id = ava_highscores.user
			WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]'
			ORDER BY score $get_leaderboard[order_by] LIMIT $from, $max_results");
		}
	
		echo '<ul class="game_highscore_list">
			<li>
			<div id="game_highscore_header">
			<div class="game_highscore_name">'.HIGHSCORE_USER.'</div>
			<div class="game_highscore_score">'.$get_leaderboard['label'].'</div>
			<div class="game_highscore_date">'.HIGHSCORE_DATE.'</div>
			</div>
			</li>';
		while ($highscore = mysql_fetch_array($query)) {
			$date = FormatDate($highscore['date'], 'short');
			$profile_url = ProfileUrl($highscore['id'], $highscore['seo_url']);
			$avatar_url = AvatarUrl($highscore['avatar'], $highscore['facebook'], $highscore['facebook_id']);

			echo '<li>
				<div class="game_highscore_container" id="game_highscore'.$highscore['score_id'].'">
					<div class="game_highscore_avatar">
						<a href="'.$profile_url.'"><img src="'.$avatar_url.'" width="30" height="30"/></a>
					</div>
					<div class="game_highscore_name"><a href="'.$profile_url.'">'.$highscore['username'].'</a></div>
					<div class="game_highscore_score">'.$highscore['score'];
					if ($user['admin'] == 1) {
						echo ' <img src="'.$setting['site_url'].'/images/smallx.png" title="Delete score" onclick="DeleteHighscore('.$highscore['score_id'].',  \''.$setting['site_url'].'\');"/>';
					}
					echo '</div>
					<div class="game_highscore_date">'.$date.'</div>
				</div>
				</li>';
		}

		echo '</ul>';

		$total_pages = ceil($count / $max_results);

		if ($total_pages != 1) {
			echo '<div class="game_highscore_pages" id="highscore_pages">';
			if ($page != 1) {
				$prev_page = $page - 1;
				echo '<p class="cmt_page_link"><a href="#" onclick="HighscorePage('.$id.', '.$prev_page.', \''.$lb_id.'\', \''.$setting['site_url'].'\', 2); return false">< '.PREVIOUS.'</a></p>';
			}
			if ($page != $total_pages) {
				$next_page = $page + 1;
				echo ' <p class="cmt_page_link"><a href="#" onclick="HighscorePage('.$id.', '.$next_page.', \''.$lb_id.'\', \''.$setting['site_url'].'\', 2); return false">'.NEXT.' ></a></p>';
			}
			echo '</div>';
		}
	} else {
		if (isset($_GET['scope']) && $_GET['scope'] == 'friends') {
			echo '<div class="game_no_highscores">'.FRIENDS_HIGHSCORE_NONE.'</div>';
		}
		else {
			echo '<div class="game_no_highscores">'.HIGHSCORE_NONE.'</div>';
		}
		echo '<div class="game_highscore_pages" id="highscore_pages"></div>';
	}
} else {
		echo '<div class="game_no_highscores">'.HIGHSCORE_NONE.'</div>
		<div id="highscore_pages"></div>';
}
?>