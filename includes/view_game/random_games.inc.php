<?php
defined( 'AVARCADE_' ) or die( '' );
$sqla = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY rand() LIMIT $template[random_game_limit]");

while($row = mysql_fetch_array($sqla)) {
	
	$random_game = GameData($row, 'random');
		
	include('.'.$setting['template_url'].'/'.$template['random_game']);
}
?>