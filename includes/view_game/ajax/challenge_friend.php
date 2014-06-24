<?php 
include '../../../config.php';
include '../../../language/'.$setting['language'].'.php';

$game_id = intval($_GET['id']);
$user_id = intval($_COOKIE['ava_userid']);

$has_highscore = mysql_num_rows(mysql_query("SELECT * FROM ava_highscores WHERE game = $game_id AND user = $user_id"));
if ($has_highscore) {

	echo '<form action="" method="get" onsubmit="return false;">
	'.CHALLENGE_LABEL.': 
	<select name="friend" id="challenge_friend_id">';
	
	$friends_q = mysql_query("SELECT ava_users.*
	FROM ava_friends
	LEFT JOIN ava_users 
	ON ava_friends.user2 = ava_users.id
	WHERE ava_friends.user1 = $user_id");
	
	while($friend = mysql_fetch_array($friends_q)) {
		   echo '<option value="'.$friend['id'].'">'.$friend['username'].'</option>'; 
    }
   echo '</select>
   '.CHALLENGE_LEADERBOARD_LABEL.':
   <select name="score_type" id="challenge_score_type">
   <option value="latest">'.CHALLENGE_NEWEST.'</option>';
   
   $leaderboards = mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $game_id");
   while ($leaderboard = mysql_fetch_array($leaderboards)) {
   		$has_highscore = mysql_num_rows(mysql_query("SELECT * FROM ava_highscores WHERE game = $game_id AND user = $user_id AND leaderboard = '$leaderboard[leaderboard_id]'"));
   		if ($has_highscore) {
   			echo '<option value="'.$leaderboard['leaderboard_id'].'">'.CHALLENGE_BEST.' ('.LEADERBOARD.': '.$leaderboard['leaderboard_name'].')</option>';
   		}
   }
   
   echo '</select><br />
      
   <div class="challenge_buttons">
   	<input type="submit" name="Submit" id="submit_challenge" value="'.CHALLENGE_SUBMIT.'" onclick="SubmitChallenge('.$game_id.')" />
   	<input type="button" name="close" id="close_popup" value="'.CHALLENGE_CLOSE.'" onclick="HidePopup(\'ava-popup\')" />
   </div>
	</form>';
}
else {
	echo '<div class="challenge_no_score">'.CHALLENGE_NOSCORE.'</div>
		<div class="challenge_buttons"><input type="button" name="close" id="close_popup" value="'.CHALLENGE_CLOSE.'" onclick="HidePopup(\'ava-popup\')" /></div>';
}
?>