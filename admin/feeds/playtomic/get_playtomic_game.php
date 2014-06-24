<?php
include('../../../config.php');
include('../../../includes/core.php');
include('../../admin_functions.php');
include '../../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","50M");

$feed_setting = feed_setting('all');
 
$playtomic_game_query = mysql_query("SELECT * FROM ava_playtomic WHERE gametag='".$_POST['gametag']."'");
$playtomic_game = mysql_fetch_array($playtomic_game_query);

$filename = str_replace(' ', '-', $playtomic_game['name']);
$filename = str_replace('/', '', $filename);
$filename = str_replace("'", '', $filename);
$filename = str_replace(":", '', $filename);
$description = strip_tags($playtomic_game['description']);
$description = addslashes($description);
$name = addslashes($playtomic_game['name']);
$instructions = addslashes($playtomic_game['instructions']);  
$category_id = feed_category($playtomic_game['category']);
$ext = substr($playtomic_game['thumb_url'], strrpos($playtomic_game['thumb_url'], '.') + 1);

$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
if (!in_array($ext, $valid_extensions)) {
	$ext = 'png';
}

if ($feed_setting['download'] == 1) {

	if ($feed_setting['curl'] == 1) {
		$game = curl($playtomic_game['file_url']);
		$thumb = curl($playtomic_game['thumb_url']);
		$get_type = 'cURL';
	
	} else {
		$game = file_get_contents($playtomic_game['file_url']);
		$thumb = file_get_contents($playtomic_game['thumb_url']);
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

	$url = escape($playtomic_game['file_url']);
	$thumb_url = escape($playtomic_game['thumb_url']); 
	
}

$date = date("Y-m-d H:i:s");
$default_ad =  $feed_setting['default_ad'];

$seo_url = create_seoname($playtomic_game['name'], 0, 'game');

mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions, mochi, date_added, advert_id, highscores, mochi_id, seo_url) 
VALUES ('$name', '$description', '$url', '$category_id', 1, 'swf', '$playtomic_game[width]', '$playtomic_game[height]', '$thumb_url', '$instructions', 1, '$date', $default_ad, $playtomic_game[highscores], '$playtomic_game[gametag]', '$seo_url')");

$new_id = mysql_insert_id();

mysql_query("UPDATE ava_playtomic SET visible='2' WHERE id='$playtomic_game[id]'");

if ($feed_setting['get_tags'] == 1) {
	// Add game tags
	$tags = str_replace(" ", "", $playtomic_game['tags']);

	$tag_array = explode(",", $tags);

	add_tags($tag_array, $new_id);
}

echo '{"success":1,"new_id":'.$new_id.'}';
?>