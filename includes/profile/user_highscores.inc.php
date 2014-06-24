<?php 
$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_highscores WHERE user = $id"),0);
if ($count >= 1) {
$query = mysql_query("SELECT * FROM ava_highscores WHERE user = $id ORDER BY score desc LIMIT 10");

echo '<ul class="user_highscore_list">
	<li>
	<div id="user_highscore_header">
		<div class="user_highscore_name">'.GAME.'</div>
		<div class="user_highscore_score">'.HIGHSCORE_SCORE.'</div>
	</div>
	</li>';

while ($highscore = mysql_fetch_array($query)) {
$game_query = mysql_query("SELECT * FROM ava_games WHERE id = $highscore[game]");
$highscore_game = mysql_fetch_array($game_query);

$date = FormatDate($highscore['date'], 'short');
$game_url = GameUrl($highscore_game['id'], $highscore_game['seo_url'], $highscore_game['category_id']);
$game_thumbnail = GameImageUrl($highscore_game['image'], $highscore_game['import'], $highscore_game['url']);

echo '<li>
	<div class="user_highscore_container">
		<div class="user_highscore_avatar">
			<a href="'.$game_url.'"><img src="'.$game_thumbnail.'" width="30" height="30"/></a>
		</div>
		<div class="user_highscore_name"><a href="'.$game_url.'">'.shortenStr($highscore_game['name'], 15).'</a></div>
		<div class="user_highscore_score">'.$highscore['score'].'</div>
	</div>
	</li>';
}
echo '</ul>';

} else {
	echo '<div class="user_no_highscores">'.HIGHSCORE_NONE.'</div>';
}
?>