<?php
if (isset($_REQUEST['game_tag'])) {
	include('../../config.php');
	include('../../includes/core.php');
	include('../admin_functions.php');
	ini_set("memory_limit","25M");
	
	$feed_setting = feed_setting('all');

	$game_info = 'http://feedmonger.mochimedia.com/feeds/query/?q=%28game%3A'.$_REQUEST['game_tag'].'%29&pubid='.$feed_setting['mochi_pubid'].'&format=json';
	if ($feed_setting['curl'] == 1) {
		$game_data = curl($game_info);
		$get_type = 'cURL';
	} else {
		$game_data = file_get_contents($game_info);
		$get_type = 'file_get_contents';
	}
	echo $game_data;
	$out = json_decode($game_data, true);

	foreach($out["games"] as $game) {

		$filename = str_replace(' ', '-', $game['name']);
		$filename = str_replace('/', '', $filename);
		$filename = str_replace("'", '', $filename);
		$filename = str_replace(":", '', $filename);
		$name = addslashes($game['name']);
		$description = addslashes($game['description']);
		$instructions = addslashes($game['instructions']);
		$category = feed_category($game['categories'][0]);
		$ext = substr($game['thumbnail_url'], strrpos($game['thumbnail_url'], '.') + 1);
		
		$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
		if (!in_array($ext, $valid_extensions)) {
			$ext = 'png';
		}

		if ($feed_setting['download'] == 1) {

			if ($feed_setting['curl'] == 1) {
				$game_file = curl($game['swf_url']);
				$thumb_file = curl($game['thumbnail_url']);
				$get_type = 'cURL';

			} else {
				$game_file = file_get_contents($game['swf_url']);
				$thumb_file = file_get_contents($game['thumbnail_url']);
			}

			$new_file = fopen("../../games/$filename.swf","wb");
			fwrite($new_file, $game_file);
			fclose($new_file);

			$new_thumb = fopen("../../games/images/$filename.$ext","wb");
			fwrite($new_thumb, $thumb_file);
			fclose($new_thumb);

			$url = $setting['site_url'].'/games/'.$filename.'.swf';
			$thumb_url = $setting['site_url'].'/games/images/'.$filename.'.'.$ext;

		}

		else {

			$url = escape($game['swf_url']);
			$thumb_url = escape($game['thumbnail_url']);

		}
	}

	if ($game['leaderboard_enabled'] == true) {
		$highscores = 1;
	}
	else {
		$highscores = 0;
	}

	$date = date("Y-m-d H:i:s");
	$default_ad =  $feed_setting['default_ad'];

	$seo_url = create_seoname($name, 0, 'game');

	mysql_query("INSERT INTO ava_games (name, description, url, category_id, published, filetype, width, height, image, instructions , mochi, date_added, advert_id, highscores, mochi_id, seo_url)
VALUES ('$name', '$description', '$url', '$category', 1, 'swf', '$game[width]', '$game[height]', '$thumb_url', '$instructions', 1, '$date', $default_ad, $highscores, '$game[game_tag]', '$seo_url')") or die (mysql_error());

	$new_id = mysql_insert_id();

	mysql_query("UPDATE ava_mochi SET visible='2' WHERE gametag='$game[game_tag]'");

	$tag_list = '';
	$ti = 0;
	print_r($game['tags']);
	foreach ($game['tags'] as $game_tags) {
		if ($ti == 1) {
			$tag_list = $tag_list.','.$game_tags;
		}
		else {
			$tag_list = $tag_list.$game_tags;
			$ti = 1;
		}

	}

	// Add game tags
	if ($feed_setting['get_tags'] == 1) {
		$tags = str_replace(" ", "", $tag_list);

		$tag_array = explode(",", $tags);

		add_tags($tag_array, $new_id);
		include 'tagcloud_gen.php';
	}
}
?>