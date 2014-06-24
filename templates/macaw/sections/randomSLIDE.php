<div class="randomslides">
<ul>
<?php

$sqla = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY rand() LIMIT $template[random_game_limit]");

while($row = mysql_fetch_array($sqla)) {
	
	$random_game = GameData($row, 'random');
	
	$name = shortenStr($row['name'], $template['module_max_chars']);
	
	
echo '
<li><a href="'.$random_game['url'].'" rel="'.$random_game['image_url'].'" class="screenshot" title="'.$name.'">
<img class="randomBOXIMG" src="'.$random_game['image_url'].'" alt="'.$random_game['name'].'" />
</a>
</li>';

}
?>
</ul>
</div>