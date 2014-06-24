<?php
include('../../../config.php');
include('../../../includes/core.php');
include('../../admin_functions.php');
include '../../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","30M");

$feed_setting = feed_setting('all');
 
$k_game_query = mysql_query("SELECT * FROM ava_kongregate WHERE k_id='".$_POST['k_id']."'");
$k_game = mysql_fetch_array($k_game_query);

$filename = str_replace(' ', '-', $k_game['name']);
$filename = str_replace('/', '', $filename);
$filename = str_replace("'", '', $filename);
$filename = str_replace(":", '', $filename);
$description = addslashes($k_game['description']);
$name = addslashes($k_game['name']);
$instructions = addslashes($k_game['instructions']);  
$category_id = feed_category($k_game['category']);
$ext = 'jpg';

if ($feed_setting['download'] == 1) {

	if ($feed_setting['curl'] == 1) {
		$game = curl($k_game['file_url']);
		$thumb = curl($k_game['thumb_url']);
		$get_type = 'cURL';
	
	} else {
		$game = file_get_contents($k_game['file_url']);
		$thumb = file_get_contents($k_game['thumb_url']);
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

	$url = escape($k_game['file_url']);
	$thumb_url = escape($k_game['thumb_url']); 
	
}

$date = date("Y-m-d H:i:s");
$default_ad =  $feed_setting['default_ad'];

$seo_url = create_seoname($name, 0, 'game');

mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions, date_added, advert_id, seo_url) 
VALUES ('$name', '$description', '$url', '$category_id', 1, 'swf', '$k_game[width]', '$k_game[height]', '$thumb_url', '$instructions', '$date', $default_ad, '$seo_url')") or die (mysql_error());

$new_id = mysql_insert_id();

mysql_query("UPDATE ava_kongregate SET visible='2' WHERE id='$k_game[id]'");

echo '{"success":1,"new_id":'.$new_id.'}';
?>