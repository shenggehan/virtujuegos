<?php
defined( 'AVARCADE_' ) or die( '' );

if ($setting['homepage_order'] == 'random') {
	$order = "rand()";
}
else if ($setting['homepage_order'] == 'newest') {
	$order = "id DESC";
}
else {
	$order = "rating DESC";
}

$category_games = mysql_query("SELECT * FROM ava_games WHERE (category_id = $row[id] OR category_parent = $row[id]) AND published=1 ORDER BY $order LIMIT ".$template['homepage_game_limit']."");
	
while($cat_games = mysql_fetch_array($category_games)) {
	$game = GameData($cat_games, 'homepage');
		
	include('.'.$setting['template_url'].'/'.$template['home_game']);

}
?>