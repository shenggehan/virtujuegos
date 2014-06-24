<?php
include('../../../config.php');
include('../../../includes/core.php');
include('../../admin_functions.php');
include '../../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","25M");

$feed_setting = feed_setting('all');
 
$fgd_game_query = mysql_query("SELECT * FROM ava_fgd WHERE fgd_id='".$_POST['fgd_id']."'");
$fgd_game = mysql_fetch_array($fgd_game_query);

$filename = str_replace(' ', '-', $fgd_game['name']);
$filename = str_replace('/', '', $filename);
$filename = str_replace("'", '', $filename);
$filename = str_replace(":", '', $filename);
$description = strip_tags($fgd_game['description']);
$description = addslashes($description);
$name = addslashes($fgd_game['name']);
$category_id = feed_category($fgd_game['category']);
$ext = substr($fgd_game['thumb_url'], strrpos($fgd_game['thumb_url'], '.') + 1);

$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
if (!in_array($ext, $valid_extensions)) {
	$ext = 'png';
}
$url = $fgd_game['file_url'];
$thumb_url = $fgd_game['thumb_url'];

if ($feed_setting['download'] == 1) {
	if ($feed_setting['curl'] == 1) {
		$game = curl($url);
		$thumb = curl($thumb_url);
		$get_type = 'cURL';
	
	} else {
		$game = file_get_contents($url);
		$thumb = file_get_contents($thumb_url);
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

$date = date("Y-m-d H:i:s");
$default_ad =  $feed_setting['default_ad'];

$seo_url = create_seoname($fgd_game['name'], 0, 'game');

mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, date_added, advert_id, seo_url) 
VALUES ('$name', '$description', '$url', '$category_id', 1, 'swf', '$fgd_game[width]', '$fgd_game[height]', '$thumb_url', '$date', '$default_ad', '$seo_url')") or die (mysql_error());

$new_id = mysql_insert_id();

mysql_query("UPDATE ava_fgd SET visible='2' WHERE id='$fgd_game[id]'");

echo '{"success":1,"new_id":'.$new_id.'}';
?>