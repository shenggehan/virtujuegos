<?php
if ($login_status != 1) exit();
ini_set("memory_limit","150M");
$i = 0;

$feed_setting = feed_setting('all');

$feed = 'http://playtomic.com/games/feed/mochi?format=json&limit='.$feed_setting['max_feed'];

if ($feed_setting['curl'] == 1) {
	$data = curl($feed);
	$get_type = 'cURL';
} else {
	$data = file_get_contents($feed);
	$get_type = 'file_get_contents';
}

echo 'Downloading feed via '.$get_type.'...<br /><br />';

$out = json_decode($data, true);

foreach($out["games"] as $game) {

$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_playtomic WHERE gametag='$game[game_tag]'"),0);
if ($count == 0) {

$name = mysql_real_escape_string($game['name']);
$description = mysql_real_escape_string($game['description']);
$author = mysql_real_escape_string($game['author']);
$author_url = mysql_real_escape_string($game['author_link']);
$instructions = mysql_real_escape_string($game['instructions']);
$category = mysql_real_escape_string($game['categories'][0]);
$thumb_url = mysql_real_escape_string($game['thumbnail_url']);
$swf_url = mysql_real_escape_string($game['swf_url']);
$a_link = mysql_real_escape_string($game['author_link']);

if ($game['recommended'] == true) {
	$featured = 1;
}
else {
	$featured = 0;
}

if ($game['leaderboard_enabled'] == true) {
	$highscores = 1;
}
else {
	$highscores = 0;
}

$tag_list = '';
$ti = 0;
foreach ($game['tags'] as $game_tags) {
	if ($ti == 1) {
		$tag_list = $tag_list.','.$game_tags;
	}
	else {
		$tag_list = $tag_list.$game_tags;
		$ti = 1;
	}
	
}

$tag_list = mysql_real_escape_string($tag_list);

$sql = mysql_query("INSERT INTO ava_playtomic (gametag, name, description, thumb_url, file_url, width, height, author, author_link, category, instructions, featured, tags, highscores) VALUES ('$game[game_tag]', '$name', '$description', '$thumb_url', '$swf_url', '$game[width]', '$game[height]', '$author', '$a_link', '$category', '$instructions', '$featured', '$tag_list', '$highscores')") or die (mysql_error());

$i = $i + 1;
}}
echo $i.' games added to database<br /><br />';
?>
<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=playtomic#page=1&cat=All">Playtomic feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed Settings</a></div></div>
<br style="clear:both" />