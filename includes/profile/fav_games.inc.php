<?php
defined( 'AVARCADE_' ) or die( '' );

$q = mysql_query("SELECT favourites from ava_users WHERE id=$id");
$favs = mysql_fetch_array($q);
if ($favs['favourites'] == '') {
	echo PROFILE_NO_FAVS;
}
else {
	$favourites = substr($favs['favourites'], 2);

	$q2 = mysql_query("SELECT * from ava_games WHERE id IN ($favourites) AND published = 1");
	while ($games = mysql_fetch_array($q2)) {
		$game = GameData($games, 'favourite');
		
		// Include the template for favourite games
		include('.'.$setting['template_url'].'/'.$template['favourite_game']);
	}
}
?>