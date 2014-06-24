<?php
if ($login_status != 1) exit();
ini_set("memory_limit","150M");
$i = 0;

$feed_setting = feed_setting('all');

$feed = 'http://www.freegamesforyourwebsite.com/feeds/games/?category=all&thumb=small&limit='.$feed_setting['max_feed'].'&format=json';

if ($feed_setting['curl'] == 1) {
	$data = curl($feed);
	$get_type = 'cURL';
} else {
	$data = file_get_contents($feed);
	$get_type = 'file_get_contents';
}

echo 'Downloading feed via '.$get_type.'...<br /><br />';

$out = json_decode($data, true);

foreach($out as $game) {

$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_fog WHERE fog_id='$game[id]'"),0);
if ($count == 0) {

$name = mysql_real_escape_string($game['title']);
$description = mysql_real_escape_string($game['description']);
$instructions = mysql_real_escape_string($game['controls']);
$category = mysql_real_escape_string('Demo');
$thumb_url = mysql_real_escape_string($game['med_thumbnail_url']);
$swf_url = mysql_real_escape_string($game['swf_file']);

if (isset($game['tags']) && $game['tags'] != '') {
	$tags = '';
	$ti = 0;
	foreach ($game['tags'] as $tag) {
		$tag = str_replace(" Games", "", $tag);
		
		if ($ti == 1) {
			$tags .= ', '.$tag;
		}
		else {
			$tags .= $tag;
			$ti = 1;
		}
	}	
}
else {
	$tags = '';
}

$dimensions =  explode('x', $game['resolution']);

$sql = mysql_query("INSERT INTO ava_fog (fog_id, name, description, thumb_url, file_url, width, height, category, instructions, tags) VALUES ('$game[id]', '$name', '$description', '$thumb_url', '$swf_url', '$dimensions[0]', '$dimensions[1]', '$category', '$instructions', '$tags')") or die (mysql_error());

$i = $i + 1;
}}
echo $i.' games added to database<br /><br />';
?>
<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=fog#page=1&cat=All">FOG feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed Settings</a></div></div>
<br style="clear:both" />