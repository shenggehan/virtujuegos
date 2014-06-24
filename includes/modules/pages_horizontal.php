<?php
if ($setting['seo_on'] == 0) {
	echo '<li><a href="'.$setting['site_url'].'">'.HOMEPAGE.'</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=news">'.NEWS.'</a></li>';
	if ($setting['forums_installed'] == 1) {
		echo '<a href="'.$setting['site_url'].'/index.php?task=forums">'.FORUMS.'</a></li>';
	}
	echo '<li><a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=member_list">'.MEMBER_LIST.'</a></li>
	<li><a href="'.$setting['site_url'].'/index.php?task=links">'.LINKS.'</a></li>';
	
	if ($setting['allow_submissions'] == 1) {
		echo $template['pages_menu_seperator'].'<a href="'.$setting['site_url'].'/index.php?task=submit">'.SUBMIT_GAME.'</a></li>';
		
	}
}
else {
	echo '<li><a href="'.$setting['site_url'].'">'.HOMEPAGE.'</a></li>
	<li><a href="'.$setting['site_url'].'/news'.$setting['seo_extension'].'">'.NEWS.'</a></li>';
	if ($setting['forums_installed'] == 1) {
		echo '<li><a href="'.$setting['site_url'].'/forums">'.FORUMS.'</a></li>';
	}
	echo '<li><a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a></li>
	<li><a href="'.$setting['site_url'].'/members'.$setting['seo_extension'].'">'.MEMBER_LIST.'</a></li>
	<li><a href="'.$setting['site_url'].'/links'.$setting['seo_extension'].'">'.LINKS.'</a></li>';
	if ($setting['allow_submissions'] == 1) {
		echo '<li><a href="'.$setting['site_url'].'/submit-game'.$setting['seo_extension'].'">'.SUBMIT_GAME.'</a></li>';
	}
} 


	
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_pages WHERE menu = 1"),0); 
if ($total_results >= 1) {
	$sql = mysql_query("SELECT * FROM ava_pages WHERE menu = 1 ORDER BY id");
	while($row = mysql_fetch_array($sql)) {
		$url = PageUrl($row['id'], $row['seo_url']);
		echo '<li><a href="'.$url.'">'.$row['name'].'</a></li>';
	}
}
?>
