<?php
include('../../../config.php');

if (isset($_REQUEST['game_id'])) {
	include('../../../includes/core.php');
	include('../../admin_functions.php');
	ini_set("memory_limit","25M");
	
	$feed_setting = feed_setting('all');
	
	$game_tag = $_REQUEST['game_id'];

	$game_info = 'http://www.freegamesforyourwebsite.com/feeds/games/'.$game_tag.'/?format=json';
	
	echo $game_info;
	
	if ($feed_setting['curl'] == 1) {
		$game_data = curl($game_info);
		$get_type = 'cURL';
	} else {
		$game_data = file_get_contents($game_info);
		$get_type = 'file_get_contents';
	}

	$out = json_decode($game_data, true);

	foreach($out as $game) {

		$filename = str_replace(' ', '-', $game['title']);
		$filename = str_replace('/', '', $filename);
		$filename = str_replace("'", '', $filename);
		$filename = str_replace(":", '', $filename);
		$name = addslashes($game['title']);
		$description = addslashes($game['description']);
		$instructions = addslashes($game['controls']);
		$category = feed_category('Autopost');
		$ext = substr($game['med_thumbnail_url'], strrpos($game['med_thumbnail_url'], '.') + 1);

		if ($feed_setting['download'] == 1) {

			if ($feed_setting['curl'] == 1) {
				$game_file = curl($game['swf_file']);
				$thumb_file = curl($game['med_thumbnail_url']);
				$get_type = 'cURL';

			} else {
				$game_file = file_get_contents($game['swf_file']);
				$thumb_file = file_get_contents($game['med_thumbnail_url']);
			}

			$new_file = fopen("../../../games/$filename.swf","wb");
			fwrite($new_file, $game_file);
			fclose($new_file);

			$new_thumb = fopen("../../../games/images/$filename.$ext","wb");
			fwrite($new_thumb, $thumb_file);
			fclose($new_thumb);

			$url = $setting['site_url'].'/games/'.$filename.'.swf';
			$thumb_url = $setting['site_url'].'/games/images/'.$filename.'.'.$ext;

		}

		else {
			$url = escape($game['swf_file']);
			$thumb_url = escape($game['med_thumbnail_url']);
		}
	}

	$date = date("Y-m-d H:i:s");
	$default_ad =  $feed_setting['default_ad'];
	$dimensions =  explode('x', $game['resolution']);

	$seo_url = create_seoname($name, 0, 'game');

	mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions , mochi, date_added, advert_id, seo_url)
VALUES ('$name', '$description', '$url', '$category', 1, 'swf', '$dimensions[0]', '$dimensions[1]', '$thumb_url', '$instructions', 1, '$date', $default_ad, '$seo_url')") or die (mysql_error());

	$new_id = mysql_insert_id();

	mysql_query("UPDATE ava_mochi SET visible='2' WHERE fog_id='$game[id]'");
}
?>