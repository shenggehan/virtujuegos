<?php 
header("Content-Type: text/xml");

include('config.php');
include('includes/core.php');
include 'language/'.$setting['language'].'.php';

if (isset($_GET['feed']) && $_GET['feed'] == 'popular') {
	$get = 'hits DESC';
	$desc = POPULAR_MODULE;}
else {
	$get = 'id DESC';
	$desc = NEWEST_MODULE;
}

echo '<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

<channel>
  <title>'.$setting['site_name'].'</title>
  <link>'.$setting['site_url'].'</link>
  <description>'.$desc.'</description>';

$sql = mysql_query("SELECT * FROM ava_games WHERE published=1 ORDER BY $get LIMIT 20");
while($row = mysql_fetch_array($sql)) {

    $name = str_replace('&', "", $row['name']);
    $url = GameUrl($row['id'], $row['seo_url'], $row['category_id']);
    $imgurl = GameImageUrl($row['image'], $row['import'], $row['url']);

echo '
  <item>
    <title>'.$name.'</title>
    <link>'.$url.'</link>
    <description><![CDATA[ <a href="'.$url.'"><img align="left" vspace="4" hspace="6" src='.str_replace(' ','%20',$imgurl).' title="'.$name.'" alt="'.$name.'" width="100" height="100" /></a> '.strip_tags($row['description']).']]></description>
    <pubDate>'.date('D, d M Y H:i:s O', strtotime($row['date_added'])).'</pubDate>
  </item>';}
  echo '
</channel>

</rss>';

?> 