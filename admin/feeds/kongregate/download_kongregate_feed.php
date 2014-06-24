<?php
if ($login_status != 1) exit();
ini_set("memory_limit","150M");
$i = 0;

$feed_setting = feed_setting('all');

$feed = 'http://www.kongregate.com/games_for_your_site.xml';

if ($feed_setting['curl'] == 1) {
	$data = curl($feed);
	$get_type = 'cURL';
} else {
	$data = file_get_contents($feed);
	$get_type = 'file_get_contents';
}

echo 'Downloading XML feed via '.$get_type.'...<br /><br />';

$xml = simplexml_load_string($data);

foreach($xml->game as $game) {	
	$id = intval($game->id);
	$count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_kongregate WHERE k_id=$id"),0);
	if ($count != 1) {
		$name = mysql_real_escape_string($game->title);
		$description = mysql_real_escape_string($game->description);
		$author = mysql_real_escape_string($game->developer_name);
		$instructions = mysql_real_escape_string($game->instructions);
		$category = mysql_real_escape_string($game->category);
		$thumb_url = mysql_real_escape_string($game->thumbnail);
		$swf_url = mysql_real_escape_string($game->flash_file);
		$width = $game->width;
		$height = $game->height;
	
		$sql = mysql_query("INSERT INTO ava_kongregate (k_id, name, description, thumb_url, file_url, width, height, author, category, instructions) VALUES ('$id', '$name', '$description', '$thumb_url', '$swf_url', '$width', '$height', '$author', '$category', '$instructions')") or die (mysql_error());
	
		$i += 1;
	}
}
echo $i.' games added to database<br /><br />';
?>
<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=kongregate#page=1&cat=All">Kongregate Feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed settings</a></div></div>
<br style="clear:both" />