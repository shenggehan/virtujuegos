<?php

$sql = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY hits desc LIMIT 5");
while($row = mysql_fetch_array($sql)) {
	
	$url = GameUrl($row['id'], $row['seo_url'], $row['category_id']);
		
	$name = shortenStr($row['name'], $template['module_max_chars']);
	
		$gamew = GameData($row, 'new');

	
	
	if ($setting['module_thumbs'] == 1) {
		$image_url = GameImageUrl($row['image'], $row['import'], $row['url']);
		$image = '<img class="sidebar_gamesIMG" src="'.$image_url.'" alt="" /> ';
	}
	else {
		$image = '';
	}
	
	echo '<li><a href="'.$url.'">'.$image.'</a>
	<p class="sidebar_gamename"><a href="'.$url.'">'.$name.'</a></p>
	<span class="small_play">'.$gamew['plays'].' Users Played</span></li>';
}

?>