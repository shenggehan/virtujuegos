<?php
$sql = mysql_query("SELECT * FROM ava_links WHERE sitewide=1 AND published=1 ORDER BY id desc LIMIT 5");

while ($row = mysql_fetch_array($sql))
	echo '<li class="red_bullet"><a href="'.$row['url'].'">'.htmlspecialchars($row['name']).'</a></li>';


if ($setting['seo_on'] == 0) {
	if($setting['link_exchange'] == 1) {
		echo '<li class="red_bullet"><a href="'.$setting['site_url'].'/index.php?task=links"><strong>'.LINK_EXCHANGE.'</strong></a></li>';
	}
	
	echo '<li class="red_bullet"><a href="'.$setting['site_url'].'/index.php?task=links"><strong>'.MORELINKS.'</strong></a></li>';
}
else {
	if($setting['link_exchange'] == 1) {
		echo '<li class="red_bullet"><a href="'.$setting['site_url'].'/links'.$setting['seo_extension'].'"><strong>'.LINK_EXCHANGE.'</strong></a></li>';
	}
	echo '<li class="red_bullet"><a href="'.$setting['site_url'].'/links'.$setting['seo_extension'].'"><strong>'.MORELINKS.'</strong></a></li>';
}
?>