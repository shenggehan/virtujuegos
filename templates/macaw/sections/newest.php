<?php

$sql = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY id desc LIMIT 6");
while($row = mysql_fetch_array($sql)) {
	
	$url = GameUrl($row['id'], $row['seo_url'], $row['category_id']);
	
	$game = GameData($row, 'new');
		
	$name = shortenStr($row['name'], $template['module_max_chars']);
	
	if ($setting['module_thumbs'] == 1) {
		$image_url = GameImageUrl($row['image'], $row['import'], $row['url']);
		$image = '<img src="'.$image_url.'" class="newgamesBOXIMG" alt="" /> ';
	}
	else {
		$image = '';
	}
	
	$toolnip = '<div class=\'tooltipBOX_HORIZON\'><div style=\'float:left; width: 200px; padding: 10px 0 0 0px;\'>
	         <img class=\'BOXGAMESTIP_IMG\' src=\''.$image_url.'\' alt=\'\' /><br />
	         <span class=\'tooltipBOX_title\'>'.$name.'</span><br />
	         <span style=\'display:block; padding: 5px;\'>'.$game['description'].'</span>
	         <span style=\'display: block; width: 100px; padding: 0px 0 0 50px;\'>
	         '.$game['rating'].'
	         </span>
	         <div style=\'float:left; width: 200px; margin: 10px 0 5px 0;\'><span style=\'font-weight:bold; color: #ff7800;\'>'.$game['plays'].' People Played</span> </div>
	         </div></div>';
	
	
	if (strlen($name) > 25) {
$name = substr($row['name'], 0,25).'...';
}
	
	echo '<li>
	<a href="'.$url.'" rel="tooltip" title="'.$toolnip.'">
	'.$image.'<br />'.$name.'  
	</a>
	</li>';
}

?>