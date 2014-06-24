<?php
include('../../../config.php');
include('../../../includes/core.php');
include('../../admin_functions.php');
include '../../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","25M");

$feed_setting = feed_setting('all');

$mochi_game_query = mysql_query("SELECT * FROM ava_mochi WHERE gametag='".$_POST['gametag']."'");
$mochi_game = mysql_fetch_array($mochi_game_query);

$filename = str_replace(' ', '-', $mochi_game['name']);
$filename = str_replace('/', '', $filename);
$filename = str_replace("'", '', $filename);
$filename = str_replace(":", '', $filename);
$description = strip_tags($mochi_game['description']);
$description = addslashes($description);
$name = addslashes($mochi_game['name']);
$instructions = addslashes($mochi_game['instructions']);  
$category_id = feed_category($mochi_game['category']);
$ext = substr($mochi_game['thumb_url'], strrpos($mochi_game['thumb_url'], '.') + 1);

$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
if (!in_array($ext, $valid_extensions)) {
	$ext = 'png';
}

if ($feed_setting['download'] == 1) {

	if ($feed_setting['curl'] == 1) {
		$game = curl($mochi_game['file_url']);
		$thumb = curl($mochi_game['thumb_url']);
		$get_type = 'cURL';
	
	} else {
		$game = file_get_contents($mochi_game['file_url']);
		$thumb = file_get_contents($mochi_game['thumb_url']);
	}

	$new_file = fopen("../../../games/$filename.swf","wb");
	fwrite($new_file, $game);
	fclose($new_file);

	$new_thumb = fopen("../../../games/images/$filename.$ext","wb");
	fwrite($new_thumb, $thumb);
	fclose($new_thumb);

	$url = $setting['site_url'].'/games/'.$filename.'.swf';
	$thumb_url = $setting['site_url'].'/games/images/'.$filename.'.'.$ext;
	
}

else {

	$url = escape($mochi_game['file_url']);
	$thumb_url = escape($mochi_game['thumb_url']); 
	
}

$date = date("Y-m-d H:i:s");
$default_ad =  $feed_setting['default_ad'];

$seo_url = create_seoname($mochi_game['name'], 0, 'game');

mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions, mochi, date_added, advert_id, highscores, mochi_id, seo_url) 
VALUES ('$name', '$description', '$url', '$category_id', 1, 'swf', '$mochi_game[width]', '$mochi_game[height]', '$thumb_url', '$instructions', 1, '$date', $default_ad, $mochi_game[highscores], '$mochi_game[gametag]', '$seo_url')");

$new_id = mysql_insert_id();

mysql_query("UPDATE ava_mochi SET visible='2' WHERE id='$mochi_game[id]'");

if ($feed_setting['get_tags'] == 1) {
	// Add game tags
	$tags = str_replace(" ", "", $mochi_game['tags']);

	$tag_array = explode(",", $tags);

	add_tags($tag_array, $new_id);
	
	$thisismochi = 1;
	include '../../includes/tagcloud_gen.php';
}

echo '{"success":1,"new_id":'.$new_id.'}';
?>