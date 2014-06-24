<?php
if ($login_status != 1) exit();
ini_set("memory_limit","150M");
$i = 0;

$feed_setting = feed_setting('all');

$feed = 'http://flashgamedistribution.com/feed.php?start=0&gpp='.$feed_setting['max_feed'].'&feed=json';

if ($feed_setting['curl'] == 1) {
	$data = curl($feed);
	$get_type = 'cURL';
} else {
	$data = file_get_contents($feed);
	$get_type = 'file_get_contents';
}

echo 'Downloading feed via '.$get_type.'...<br /><br />';

$out = json_decode($data, true);
//print_r($out);
foreach($out as $game) {

//print_r($game);

$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_fgd WHERE fgd_id='$game[game_id]'"),0);
if ($count != 1) {

$name = mysql_real_escape_string($game['title']);
$description = mysql_real_escape_string($game['full_description']);
$author = mysql_real_escape_string($game['author']);

$genres = $game['genres'];
$genres = str_replace(" ", "", $genres);
$category = explode(",", $genres);

$thumb_url = $game['thumb_filename'];
$swf_url = $game['swf_filename'];

$sql = mysql_query("INSERT INTO ava_fgd (fgd_id, name, description, thumb_url, file_url, width, height, author, category, tags) VALUES ('$game[game_id]', '$name', '$description', '$thumb_url', '$swf_url', '$game[width]', '$game[height]', '$author', '$category[0]', 'nonefornow')") or die (mysql_error());

$i = $i + 1;
}}
echo $i.' games added to database<br /><br />';
?>
<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=fgd#page=1&cat=All">FGD Feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed Settings</a></div></div>
<br style="clear:both" />