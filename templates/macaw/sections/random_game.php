<?php

$sqla = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY rand() LIMIT $template[random_game_limit]");

while($row = mysql_fetch_array($sqla)) {
	
	$random_game = GameData($row, 'random');
	
	
	$tuptip = '<div class=\'tooltipBOX_HORIZON\'><div style=\'float:left; width: 200px; padding: 10px 0 0 0px;\'>
	         <img class=\'BOXGAMESTIP_IMG\' src=\''.$random_game['image_url'].'\' alt=\'\' /><br />
	         <span class=\'tooltipBOX_title\'>'.$random_game['name'].'</span><br />
	         <span style=\'display:block; padding: 5px;\'>'.$random_game['description'].'</span>
	         <span style=\'display: block; width: 100px; padding: 0px 0 0 50px;\'>
	         '.$random_game['rating_image'].'
	         </span>
	         <div style=\'float:left; width: 200px; margin: 10px 0 5px 0;\'><span style=\'font-weight:bold; color: #ff7800;\'>'.$random_game['plays'].' People Played</span> </div>
	         </div></div>';

echo '
<li><a href="'.$random_game['url'].'" rel="tooltip" title="'.$tuptip.'">
<img class="randomBOXIMG" src="'.$random_game['image_url'].'" alt="'.$random_game['name'].'" />
</a>
</li>';

}
?>