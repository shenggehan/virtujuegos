<?php
defined( 'AVARCADE_' ) or die( '' );

$comment = array();
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_comments WHERE user='".$id."'"), 0);
if ($total_results <= 0) {
	echo "$profile[name] ".PROFILE_NO_COMMENTS;
}
else {
	if ($_GET['task'] == 'profile') {
		$sql = mysql_query("SELECT * FROM ava_comments WHERE user=".$id." ORDER BY id DESC LIMIT 8");
	}
	else {
		$sql = mysql_query("SELECT * FROM ava_comments WHERE user=".$id." ORDER BY id DESC");
	}

	while ($row = mysql_fetch_array($sql)) {
		
		$game_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE id=$row[link_id]"), 0);
		if ($game_exists == 1) {
			$sql2 = mysql_query("SELECT * FROM ava_games WHERE id=".$row['link_id']." LIMIT 1");
			$row2 = mysql_fetch_array($sql2);
		
			$comment['the_comment'] = nl2br(htmlspecialchars($row['comment']));
			$comment['game_name'] = $row2['name'];
		
			$comment['game_url'] = GameUrl($row2['id'], $row2['seo_url'], $row2['category_id']);
		
			if ($user['admin'] == 1) {
				$comment['admin_options'] = ' <a href='.$setting['site_url'].'/admin/index.php?action=delete_comment&amp;id='.$row['id'].'&link_id='.$row2['id'].'><img src="'.$setting['site_url'].'/admin/delete.png" align="absmiddle" /></a>';
			}
		
			include('.'.$setting['template_url'].'/'.$template['users_comments']);
		}
	}
}


?>