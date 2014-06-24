<?php
include('../../../config.php');
include('../../../includes/core.php');
include('../../admin_functions.php');
include '../../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","50M");

$feed_setting = feed_setting('all');
 
$fog_game_query = mysql_query("SELECT * FROM ava_fog WHERE fog_id='".$_POST['fog_id']."'");
$fog_game = mysql_fetch_array($fog_game_query);

$filename = str_replace(' ', '-', $fog_game['name']);
$filename = str_replace('/', '', $filename);
$filename = str_replace("'", '', $filename);
$filename = str_replace(":", '', $filename);
$description = strip_tags($fog_game['description']);
$description = addslashes($description);
$name = addslashes($fog_game['name']);
$instructions = addslashes(strip_tags($fog_game['instructions']));  
$category_id = $_POST['category'];
$ext = substr($fog_game['thumb_url'], strrpos($fog_game['thumb_url'], '.') + 1);

$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
if (!in_array($ext, $valid_extensions)) {
	$ext = 'png';
}

if ($feed_setting['download'] == 1) {

	if ($feed_setting['curl'] == 1) {
		$game = curl($fog_game['file_url']);
		$thumb = curl($fog_game['thumb_url']);
		$get_type = 'cURL';
	
	} else {
		$game = file_get_contents($fog_game['file_url']);
		$thumb = file_get_contents($fog_game['thumb_url']);
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

	$url = escape($fog_game['file_url']);
	$thumb_url = escape($fog_game['thumb_url']); 
	
}

$date = date("Y-m-d H:i:s");
$default_ad =  $feed_setting['default_ad'];

$seo_url = create_seoname($fog_game['name'], 0, 'game');

mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions, date_added, advert_id, mochi_id, seo_url) 
VALUES ('$name', '$description', '$url', '$category_id', 1, 'swf', '$fog_game[width]', '$fog_game[height]', '$thumb_url', '$instructions', '$date', $default_ad, '', '$seo_url')");

$new_id = mysql_insert_id();

mysql_query("UPDATE ava_fog SET visible='2' WHERE id='$fog_game[id]'");

echo '{"success":1,"new_id":'.$new_id.'}';
?>