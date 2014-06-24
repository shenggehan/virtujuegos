<?php
if (!defined( 'AVARCADE_' )) {
	include '../../config.php';
	include '../core.php';
}
$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE featured=1 AND published=1"),0);

if ($cat_numb > 0) {
	$category_games = mysql_query("SELECT * FROM ava_games WHERE featured=1 AND published=1 ORDER BY id desc");
	
	while($cat_games = mysql_fetch_array($category_games)) {
		$featured_game = GameData($cat_games, 'featured');
		
		include('.'.$setting['template_url'].'/'.$template['featured_game']);
	}
}
?>