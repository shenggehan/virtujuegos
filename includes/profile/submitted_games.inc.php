<?php
defined( 'AVARCADE_' ) or die( '' );
$sqla = mysql_query("SELECT * FROM ava_games WHERE submitter=$id");
$count = mysql_num_rows($sqla);
if ($count >= 1) {
	while($row = mysql_fetch_array($sqla)) {
	
		$game = GameData($row, 'random');
		
		include('.'.$setting['template_url'].'/'.$template['submitted_game']);
	}
}
else {
	echo NO_SUBMITTED_GAMES;
}
?>