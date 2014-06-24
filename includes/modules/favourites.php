<?php
if ($user['login_status'] == 1) {
	$q = mysql_query("SELECT favourites from ava_users WHERE id=$user[id]");
	$favs = mysql_fetch_array($q);
	if ($favs['favourites'] == '') {
		echo '<p class="sb_error">'.PROFILE_NO_FAVS.'</p>';
	}
	else {

		$favourites = substr($favs['favourites'], 2);

		$sql = mysql_query("SELECT * from ava_games WHERE id IN ($favourites) AND published = 1 LIMIT 10");
		while($row = mysql_fetch_array($sql)) {
			
			$url = GameUrl($row['id'], $row['seo_url'], $row['category_id']);
	
			$name = shortenStr($row['name'], $template['module_max_chars']);
			
			if ($setting['module_thumbs'] == 1) {
				$image_url = GameImageUrl($row['image'], $row['import'], $row['url']);
				$image = '<img class="sidebar_gamesIMG_list" src="'.$image_url.'" alt="" /> ';
			}
			else {
				$image = '';
			}
	
			echo '<li><a href="'.$url.'">'.$image.'<span style="float:left; margin: 10px 0 0 0;">'.$name.'</span></a></li>';
		}
		
		echo '<li class="moreview"><a href="'.ProfileUrl($user['id'], $user['seo_url']).'">'.FAVOURITES_VIEW_ALL.' &raquo;</a></li>';
	}
}
else {
	echo '<p class="sb_error">'.FAVOURITES_LOG_IN.'</p>';
}
?>
