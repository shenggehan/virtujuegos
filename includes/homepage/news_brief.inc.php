<?php
defined( 'AVARCADE_' ) or die( '' );
$sql = mysql_query("SELECT * FROM ava_news ORDER BY id DESC LIMIT 3");
while($row = mysql_fetch_array($sql)) {
	$content = strip_tags($row['content']);
	if (strlen($content) > 65) {
		$content = substr($content, 0, 65)."...";
	}
	
	$news_url = NewsUrl($row['id'], $row['seo_url']);
	
	$image_url = $setting['site_url'].'/uploads/news_icons/'.$row['image'];
	$image = '<img src="'.$image_url.'" width="25" height="25" style="vertical-align: middle;" />';
	
	echo '<div class="homepage_news"><strong>'.$image.' <a href="'.$news_url.'">'.$row['title'].'</a></strong> - '.$content.'</div>';
}
if ($setting['seo_on'] != 0) {
	$url = '/news';
}
else {
	$url = '/?task=news';
}

echo '<div class="homepage_more_news"><a href="'.$setting['site_url'].$url.'">'.HOME_VIEW_MORE.'</a></div>';
?>