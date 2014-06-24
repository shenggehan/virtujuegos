<?php
if ($login_status != 1) exit();
ini_set("memory_limit","150M");
$i = 0;

$feed_setting = feed_setting('all');

$feed = 'http://publishers.spilgames.com/rss?lang=en-US&tsize=2&format=json&limit='.$feed_setting['max_feed'].'&format=json';

if ($feed_setting['curl'] == 1) {
	$data = curl($feed);
	$get_type = 'cURL';
} else {
	$data = file_get_contents($feed);
	$get_type = 'file_get_contents';
}

echo 'Downloading feed via '.$get_type.'...<br /><br />';

$out = json_decode($data, true);

foreach($out['entries'] as $game) {

$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_spil WHERE spil_id='$game[id]'"),0);
if ($count == 0) {

$name = mysql_real_escape_string($game['title']);
$description = mysql_real_escape_string($game['description']);
$category = mysql_real_escape_string(str_replace(" Games", "", $game['category']));
$thumb_url = mysql_real_escape_string($game['thumbnails'][1]['url']);
$swf_url = mysql_real_escape_string($game['player']['url']);

$width = $game['player']['width'];
$height = $game['player']['height'];

$sql = mysql_query("INSERT INTO ava_spil (spil_id, name, description, thumb_url, file_url, width, height, category) VALUES ('$game[id]', '$name', '$description', '$thumb_url', '$swf_url', '$width', '$height', '$category')") or die (mysql_error());

$i = $i + 1;
}}
echo $i.' games added to database<br /><br />';
?>
<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=spil#page=1&cat=All">Spil Games feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed Settings</a></div></div>
<br style="clear:both" />