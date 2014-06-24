<?php

// ======= DO NOT EDIT BELOW THIS LINE - UNLESS YOU KNOW WHAT YOU DOING ========================================================= //


// Make a string SEO friendly
function seoname($name) {
	global $language_char_conversions, $originals, $replacements;
	if ((isset($language_char_conversions)) && ($language_char_conversions == 1)) {
		$search = explode(",", $originals);
		$replace = explode(",", $replacements);
		$name = str_replace($search, $replace, $name);
	}
	$name = stripslashes($name);
	$name = strtolower($name);
	$name = str_replace("&", "and", $name);
	$name = str_replace(" ", "-", $name);
	$name = str_replace("---", "-", $name);
	$name = str_replace("/", "-", $name);
	$name = str_replace("?", "", $name);
	$name = preg_replace( "/[\.,\";'\:]/", "", $name );
	//$name = urlencode($name);
	return $name;
}

function feed_setting($setting) {
	if ($setting == 'all') {
		$sql = mysql_query("SELECT * FROM ava_feed_settings");
		while ($get_setting = mysql_fetch_array($sql)) {
			$feed_setting[$get_setting['name']] = $get_setting['value'];
		}
	}
	else {
		$get_setting = mysql_fetch_array(mysql_query("SELECT * FROM ava_feed_settings WHERE name = '$setting'"));
		$feed_setting = $get_setting['value'];
	}
	return $feed_setting;
}
$mochi['pubid'] = trim(@feed_setting('mochi_pubid'));
$mochi['secret'] = trim(@feed_setting('mochi_secretkey'));

// Mysql escape/secure function
function mysql_secure($string, $html = 1) {
	if ($html == 1) {
		$string = strip_tags($string);
		$string = htmlspecialchars($string);
	}
	$string = trim($string);
	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);
	}
	$string = mysql_real_escape_string($string);
	return $string;
}

// General escape/secure function
function secure($string) {
	$string = strip_tags($string);
	$string = htmlspecialchars($string);
	$string = trim($string);
	if (get_magic_quotes_gpc()) {
		$string = stripslashes($string);
	}
	return $string;
}

// Check if user is admin function
function user_is_admin() {
	if(isset($_COOKIE["ava_username"])) {
		$user = $_COOKIE['ava_username'];
		$code = $_COOKIE['ava_code'];
		$userid = intval($_COOKIE['ava_userid']);
		$code2 = preg_replace("/[^a-z,A-Z,0-9]/", "", $code);

		$sql = mysql_query("SELECT * FROM ava_users WHERE id='$userid' AND password='$code2' AND admin='1'");
		$login_check = mysql_num_rows($sql);
		if($login_check <= 0) {
			return(FALSE);
		}
		else {
			return(TRUE);
		}
	}
	else {
		return(FALSE);
	}
}

// Generate a 5 star rating image
function GenerateRating($rating, $location) {
	global $setting, $template;

	if ($location == 'view_game') {
		$empty_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['view_game_empty_star'].'\' alt=\'Rating star\' />';
		$half_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['view_game_half_star'].'\' alt=\'Rating star\' />';
		$star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['view_game_star'].'\' alt=\'Rating star\' />';
	}
	else if ($location == 'category') {
		$empty_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_empty_star'].'\' alt=\'Rating star\' />';
		$half_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_half_star'].'\' alt=\'Rating star\' />';
		$star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['category_star'].'\' alt=\'Rating star\' />';
	}
	else if ($location == 'homepage') {
		$empty_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_empty_star'].'\' alt=\'Rating star\' />';
		$half_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_half_star'].'\' alt=\'Rating star\' />';
		$star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['homepage_star'].'\' alt=\'Rating star\' />';
	}
	else {
		$empty_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_empty_star'].'\' alt=\'Rating star\' />';
		$half_star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_half_star'].'\' alt=\'Rating star\' />';
		$star = '<img class=\'star_IMG\' src=\''.$setting['site_url'].$setting['template_url'].'/images/'.$template['featured_star'].'\' alt=\'Rating star\' />';
	}


	if ($rating <= 0  ){$rating_images = $empty_star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 0.5){$rating_images = $half_star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 1  ){$rating_images = $star.$empty_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 1.5){$rating_images = $star.$half_star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 2  ){$rating_images = $star.$star.$empty_star.$empty_star.$empty_star;}
	if ($rating >= 2.5){$rating_images = $star.$star.$half_star.$empty_star.$empty_star;}
	if ($rating >= 3  ){$rating_images = $star.$star.$star.$empty_star.$empty_star;}
	if ($rating >= 3.5){$rating_images = $star.$star.$star.$half_star.$empty_star;}
	if ($rating >= 4  ){$rating_images = $star.$star.$star.$star.$empty_star;}
	if ($rating >= 4.5){$rating_images = $star.$star.$star.$star.$half_star;}
	if ($rating >= 5  ){$rating_images = $star.$star.$star.$star.$star;}

	return $rating_images;
	// Get rating END
}

// Advert function
function advert($type) {
	global $setting;

	if ($setting['adsense'] == 1) {
		if ($type == 'leaderboard') {
			$ad = $setting['default_leaderboard'];
		}
		else if ($type == 'banner') {
				$ad = $setting['default_banner'];
			}
		else if ($type == 'small_square') {
				$ad = $setting['default_square'];
			}
		if ($ad != 0) {
			$get_ad = mysql_fetch_array(mysql_query("SELECT ad_content FROM ava_adverts WHERE id = $ad"));
			echo $get_ad['ad_content'];
		}
	}
}

// Shorten string function
function shortenStr ($str, $len) {
	global $setting;

	if (strlen($str) > $len) {
		if ($setting['use_mb_strlen'] == 0)
			$str = substr($str, 0, $len)."…";
		else
			$str = mb_substr($str, 0, $len, 'UTF-8')."…";
	}
	return $str;
}

// Format date & time from Mysql format to readable format
function FormatDate($str, $depth) {
	global $setting;

	if ($depth == 'time') {
		if ($str != '0000-00-00 00:00:00') {
			$s = date("$setting[date_format], H:i",strtotime($str));
		}
		else {
			$s = DATE_UNKNOWN;
		}
	}
	else if ($depth == 'short') {
			if ($str != '0000-00-00 00:00:00') {
				$s = date($setting['date_format'],strtotime($str));
			}
			else {
				$s = DATE_UNKNOWN;
			}
		}
	else if ($depth == 'admin_date') {
			if ($str != '0000-00-00 00:00:00') {
				$s = date($setting['date_format'],strtotime($str));
			}
			else {
				$s = 'No record';
			}
		}
	else if ($depth == 'admin_datetime') {
			if ($str != '0000-00-00 00:00:00') {
				$s = date($setting['date_format'].', H:i',strtotime($str));
			}
			else {
				$s = 'No record';
			}
		}
	else {
		if ($str != '0000-00-00 00:00:00') {
			$s = date($setting['date_format'],strtotime($str));
		}
		else {
			$s = DATE_UNKNOWN;
		}
	}
	return $s;
}

// Generate game URL function
function GameUrl($id, $seo_name, $cat_id) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=view&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 2) {
			$cat_name = mysql_fetch_array(mysql_query("SELECT name FROM ava_cats WHERE id=$cat_id"));
			$seo_cat_name = seoname($cat_name['name']);
			$url = $setting['site_url'].'/'.$seo_cat_name.'/'.$id.'/'.$seo_name.$setting['seo_extension'];
		}
	else if ($setting['seo_on'] == 3) {
			$cat_name = mysql_fetch_array(mysql_query("SELECT name FROM ava_cats WHERE id=$cat_id"));
			$seo_cat_name = seoname($cat_name['name']);
			$url = $setting['site_url'].'/'.$seo_cat_name.'/'.$seo_name.$setting['seo_extension'];
		}
	else {
		$url = $setting['site_url'].'/view/'.$id.'/'.$seo_name.$setting['seo_extension'];
	}
	return $url;
}

// Generate game thumbnail URL function
function GameImageUrl($image_url, $import, $url) {
	global $setting;
	if ($import == 1) {
		$url = $setting['site_url'].'/games/images/'.$url.'.png';
	}
	else if ($import == 3) {
			$url = $setting['site_url'].'/games/images/'.$image_url;
		}
	else {
		if ($image_url == '') {
			$url = $setting['site_url'].'/images/blank_thumb.png';
		}
		else {
			$url = $image_url;
		}
	}
	return $url;
}

// Generate profile URL function
function ProfileUrl($id, $seo_name) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = 'index.php?task=profile&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 3) {
			$url = 'profile/'.$seo_name.$setting['seo_extension'];
		}
	else {
		$url = 'profile/'.$id.'/'.$seo_name.$setting['seo_extension'];
	}
	return $setting['site_url'].'/'.$url;
}

// Generate avatar URL function
function AvatarUrl($avatar_url, $facebook, $facebook_id) {
	global $setting;
	if($avatar_url == '') {
		if ($facebook == 1) {
			$avatar = 'http://graph.facebook.com/'.$facebook_id.'/picture';
		}
		else {
			$avatar = $setting['site_url'].'/uploads/avatars/default.png';
		}
	}
	else {
		$avatar = $setting['site_url'].'/uploads/avatars/'.$avatar_url;
	}
	return $avatar;
}

// Generate news URL function
function NewsUrl($id, $seo_title) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = '/index.php?task=news&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 3) {
			$url = '/news/'.$seo_title.$setting['seo_extension'];
		}
	else {
		$url = '/news/item/'.$id.'/'.$seo_title.$setting['seo_extension'];
	}

	return $setting['site_url'].$url;
}

function NewsPagesUrl($page) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = '/index.php?task=news&page='.$page;
	}
	else {
		$url = '/news/page'.$page.$setting['seo_extension'];
	}

	return $setting['site_url'].$url;
}

// Generate category URL function
function CategoryUrl($id, $seo_name, $page, $sortby) {
	global $setting;

	if (!isset($sortby))
		$sortby = 'newest';

	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=category&amp;id='.$id.'&sortby='.$sortby.'&page='.$page;
	}
	else if ($setting['seo_on'] == 2) {
			$url = $setting['site_url'].'/cat/'.$id.'/'.$seo_name.'/'.$sortby.'-'.$page.$setting['seo_extension'];
		}
	else if ($setting['seo_on'] == 3) {
			if (($page == 1) && ($sortby == 'newest')) {
				$url = $setting['site_url'].'/'.$seo_name.$setting['seo_extension'];
			}
			else {
				$url = $setting['site_url'].'/'.$seo_name.'/'.$sortby.'/'.$page.$setting['seo_extension'];
			}
		}
	else {
		$url = $setting['site_url'].'/cat/'.$id.'/'.$seo_name.'/'.$sortby.'/p'.$page.$setting['seo_extension'];
	}

	return $url;
}

function CategoryUrlTab($php10, $php1, $php6, $php2) {global $setting;if (!isset($php2))$php2 = 'newest';$php7 = '#'.$php1;return $php7;} function CategoryUrlTabinfo($php10, $php1, $php6, $php2) {global $setting;if (!isset($php2))$php2 = 'newest';$php7 = $php1.$setting['seo_extension'];return $php7;}

function TagUrl($tag, $page, $sort) {
	global $setting;

	if (!isset($sort))
		$sort = 'newest';

	if (($page == 1) && ($sort == 'newest')) {
		if ($setting['seo_on'] == 0) {
			$tag_link = '/index.php?task=tag&t='.$tag;
		}
		else {
			$tag_link = '/tag/'.$tag;
		}
	}
	else {
		if ($setting['seo_on'] == 0) {
			$tag_link = '/index.php?task=tag&t='.$tag.'&sortby='.$sort.'&page='.$page;
		}
		else {
			$tag_link = '/tag/'.$tag.'/'.$sort.'/'.$page;
		}
	}

	return $setting['site_url'].$tag_link;
}

// Generate member list URL
function MemberListUrl($sort, $order, $page) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=member_list&sort='.$sort.'&order='.$order.'&page='.$page;
	}
	else {
		$url = $setting['site_url'].'/members/'.$sort.'-'.$order.'/page'.$page.$setting['seo_extension'];
	}

	return $url;

}

// Generate page url
function PageUrl($id, $seo_name) {
	global $setting;

	if ($setting['seo_on'] == 0) {
		$url = $setting['site_url'].'/index.php?task=view_page&amp;id='.$id;
	}
	else if ($setting['seo_on'] == 3) {
			$url = $setting['site_url'].'/page/'.$seo_name.$setting['seo_extension'];
		}
	else {
		$url = $setting['site_url'].'/page/'.$id.'/'.$seo_name.$setting['seo_extension'];
	}

	return $url;

}

// Generate a short referal url
function ShortUrl($id) {
	global $setting, $user;

	if ($user['login_status'] == 1) {
		if ($setting['seo_on'] == 0) {
			$url = '/go.php?id='.$id.'&ref='.$user['id'];
		}
		else {
			$url = '/r-'.$id.'-'.$user['id'];
		}
	}
	else {
		if ($setting['seo_on'] == 0) {
			$url = '/go.php?id='.$id;
		}
		else {
			$url = '/r-'.$id;
		}
	}

	return $setting['site_url'].$url;
}

// Generate the list of tags for a game
function TagList($id, $spacer, $link) {
	global $setting, $game_keywords, $lang_tags_id;
	$tags = mysql_query("
	SELECT *
	FROM ava_tag_relations bt, ava_tags t
	WHERE bt.tag_id = t.id
	AND bt.game_id = $id
	GROUP BY bt.id
	") or die (mysql_error());

	$tag_list = '';
	$tag_no = 0;

	while($get_tags = mysql_fetch_array($tags)) {

		$tag_link = TagUrl($get_tags['seo_url'], 1, 'newest');

		if ($tag_no == 1) {
			if ($link == 1) {
				$tag_list = $tag_list.$spacer.'<a href="'.$tag_link.'">'.$get_tags['tag_name'].'</a>';
				$game_keywords = $game_keywords.','.$get_tags['tag_name'];
			}
			else {
				$tag_list = $tag_list.$spacer.$get_tags['tag_name'];
			}
		}
		else {
			if ($link == 1) {
				$tag_list = $tag_list.'<a href="'.$tag_link.'">'.$get_tags['tag_name'].'</a>';
				$game_keywords = $game_keywords.$get_tags['tag_name'];
			}
			else {
				$tag_list = $tag_list.$get_tags['tag_name'];
			}

			$tag_no = 1;
		}
	}
	return $tag_list;
}

function upload_file($type, $uploaded_file, $max_size, $location) {
	global $setting;
	$success = FALSE;
	if ((!empty($_FILES[$uploaded_file])) && ($_FILES[$uploaded_file]['error'] == 0)) {
		//Check if the file is an image using mime details and file extension
		$filename = basename($_FILES[$uploaded_file]['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);

		if ($type == 'image') {
			$valid_extensions = array('png', 'jpg', 'jpeg', 'gif', 'PNG', 'JPG', 'JPEG', 'GIF');
			$valid_types = array("image/png", "image/x-png", "image/jpeg", "image/pjpeg", "image/gif");

			list($width, $height) = getimagesize($_FILES[$uploaded_file]['tmp_name']);

			if ($width >= 5 && $height >= 5)
				$dimensions_pass = TRUE;
		}
		else {
			$valid_extensions = array('swf', 'SWF');
			$valid_types = array("application/x-shockwave-flash");
			$dimensions_pass = TRUE;
		}

		// Is the filetype allowed?
		if ((in_array($ext, $valid_extensions)) && (in_array($_FILES[$uploaded_file]["type"], $valid_types))) {

			$max_file_size = ($max_size * 1048576);
			if ($_FILES[$uploaded_file]["size"] <= $max_file_size) {

				if ($dimensions_pass) {

					$rand_name = rand();
					$name = substr($filename, 0,strrpos($filename,'.'));
					$name = seoname($name);
					$file_name = $name.'_'.$rand_name.'.'.$ext;
					$newname = $location.'/'.$file_name;
					if ((move_uploaded_file($_FILES[$uploaded_file]['tmp_name'], $newname))) {

						$success = TRUE;

						$error = SUBMIT_SUCCESS;
					} else {
						$error = SUBMIT_E;
					}
				} else {
					$error = SUBMIT_E_DIMENSIONS;
				}
			} else {
				$error = SUBMIT_E_SIZE;
			}
		} else {
			$error = SUBMIT_E_FILETYPE;
			foreach ($valid_extensions as $extension) {
				$error .= ' '.$extension;
			}
		}
	} else {
		$error = SUBMIT_E_NOFILE;
	}

	return array ('success' => $success, 'error' => $error, 'url' => $newname);
}

function categorylist($selected) {
	$cq = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order ASC");
	while($ca = mysql_fetch_array($cq)) {
		if ($ca['id'] == $selected) {
			echo '<option value="'.$ca['id'].'" selected>';
		}
		else {
			echo '<option value="'.$ca['id'].'">';
		}
		if ($ca['parent_id'] != 0) {
			echo ' &nbsp; &nbsp;';
		}
		echo $ca['name'].'</option>';
	}
}

function GameData($raw_data, $type) {
	global $setting, $template, $user;

	$game = array('id' => $raw_data['id'], 'instructions' => nl2br($raw_data['instructions']), 'plays' => $raw_data['hits'],  'highscores' => $raw_data['highscores'],  'seo_url' => $raw_data['seo_url'],  'category' => $raw_data['category_id'], 'submitter' => $raw_data['submitter']);

	if ($type != 'view_game') {
		$description_stripped = htmlspecialchars(strip_tags($raw_data['description']));
	}

	if (isset($template[$type.'_game_chars'])) {
		$game['name'] = shortenStr($raw_data['name'], $template[$type.'_game_chars']);
	}
	else {
		$game['name'] = $raw_data['name'];
	}

	if (isset($template[$type.'_game_desc_chars'])) {
		$game['description'] = shortenStr($description_stripped , $template[$type.'_game_desc_chars']);
	}
	else {
		$game['description'] = $raw_data['description'];
	}

	$game['url'] = GameUrl($raw_data['id'], $raw_data['seo_url'], $raw_data['category_id']);
	$game['image_url'] = GameImageUrl($raw_data['image'], $raw_data['import'], $raw_data['url']);

	if ($raw_data['highscores'] == 1) {
		$game['highscore_image'] = $template['highscore_image'];
	}
	else {
		$game['highscore_image'] = '';
	}

	if ($user['admin'] == 1) {
		$game['admin_edit'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_games#id='.$raw_data['id'].'">Edit</a>';
	}
	else {
		$game['admin_edit'] = '';
	}

	$game['date_added'] = FormatDate($raw_data['date_added'], 'date');

	// Define the overall rating for use in the template
	$game['rating'] = $game['rating_image'] = GenerateRating($raw_data['rating'], $type);
	$game['rating_value'] = $raw_data['rating'];

	// Get the submitter name and URL
	if ($raw_data['submitter'] != 0) {
		$submitter = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id = $raw_data[submitter]"));
		$game['submitter_name'] = $submitter['username'];
		$game['submitter_url'] = ProfileUrl($submitter['id'], $submitter['seo_url']);
	}

	return $game;
}

function SendEmail($data, $template) {
	global $setting;

	if ($data['send_email'] != 0) {

		if ($template == 'friend_request' || $template == 'highscore_challenge') {
			$location = '../../';
		}
		else {
			$location = '';
		}

		if ($template == 'reset_password' || $template == 'validate_email' || ($setting['email_notifications'] == 1)) {

			include $location."templates/email_templates/default/$template.php";
			$from = $setting['admin_email'];
			$headers = 'From: '.$setting['site_name'].' <' . $from . ">\r\n" .
				'Reply-To: ' . $from . "\r\n" .
				'X-Mailer: PHP/' . phpversion() . "\r\n" .
				'MIME-Version: 1.0' . "\r\n" .
				'Content-type: text/html; charset=utf-8\r\n' . "\r\n";

			mail($data['email_address'], $data['subject'], $message, $headers);
		}
	}
}



function getUser() {
	global $setting;
	// Check for login & valid cookie
	if (isset($_COOKIE["ava_username"])) {
		$cookie_id = intval($_COOKIE['ava_userid']);
		$cookie_password = preg_replace("/[^a-z,A-Z,0-9]/", "", $_COOKIE['ava_code']);

		$sql = mysql_query("SELECT * FROM ava_users WHERE id='$cookie_id' AND password='$cookie_password' LIMIT 1");
		$user = mysql_fetch_array($sql);
		//$login_check = mysql_num_rows($sql);

		if (!isset($user['username'])) {
			$info = INVALID_LOGIN1.' <a href='.$setting['site_url'].'/login.php?action=logout>'.UA_LOGOUT.'</a> '.INVALID_LOGIN2;
			if (defined( 'AVARCADE_' ))
				include ('includes/misc/login_fail.php');
			exit();
		}
		else if ($user['banned'] == 1) {
				$info = BANNED_MSG;
				//if (defined( 'AVARCADE_' ))
					include ('includes/misc/login_fail.php');
				exit();
			}
		else {
			$user['ip'] = secure($_SERVER['REMOTE_ADDR']);
			$user['login_status'] = 1;

			if ($user['avatar'] == '') {
				if ($user['facebook'] == 1) {
					$user['avatar'] = 'http://graph.facebook.com/'.$user['facebook_id'].'/picture';
				}
				else {
					$user['avatar'] = $setting['site_url'].'/uploads/avatars/default.png';
				}
			}
			else {
				$user['avatar'] = $setting['site_url'].'/uploads/avatars/'.$user['avatar'];
			}

			$user['url'] = ProfileUrl($user['id'], $user['seo_url']);
		}
	}
	else {
		$user['login_status'] = 0;
		$user['admin'] = 0;
		$user['login_link'] = $setting['site_url'].'/index.php?task=login';
	}

	return $user;
}

function create_seoname($name, $id, $type) {
	$seo_name = seoname($name);
	
	// Game exists before now, has the name changed?
	if ($id != 0) {
		if ($type == 'game') {
			$game_info = mysql_fetch_array(mysql_query("SELECT name,seo_url FROM ava_games WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($game_info['name'] == $name) {
				$seo_name = $game_info['seo_url'];
				return $seo_name;
			}
		}
		else if ($type == 'category') {
			$cat_info = mysql_fetch_array(mysql_query("SELECT name,seo_url FROM ava_cats WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($cat_info['name'] == $name) {
				$seo_name = $cat_info['seo_url'];
				return $seo_name;
			}
		}
		else if ($type == 'news') {
			$news_info = mysql_fetch_array(mysql_query("SELECT title,seo_url FROM ava_news WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($news_info['title'] == $name) {
				$seo_name = $news_info['seo_url'];
				return $seo_name;
			}
		}
		else if ($type == 'page') {
			$page_info = mysql_fetch_array(mysql_query("SELECT name,seo_url FROM ava_pages WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($page_info['name'] == $name) {
				$seo_name = $page_info['seo_url'];
				return $seo_name;
			}
		}
		else if ($type == 'topic') {
			$topic_info = mysql_fetch_array(mysql_query("SELECT title,seo_url FROM ava_topics WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($topic_info['title'] == $name) {
				$seo_name = $page_info['seo_url'];
				return $seo_name;
			}
		}
		else if ($type == 'forum') {
			$forum_info = mysql_fetch_array(mysql_query("SELECT name,seo_url FROM ava_forums WHERE id = $id"));
			// If the name hasnt changed, return the current seo_url value
			if ($forum_info['name'] == $name) {
				$seo_name = $forum_info['seo_url'];
				return $seo_name;
			}
		}
	}
		
$seo_name_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_seonames WHERE seo_name = '$seo_name' AND type = '$type'"),0); if($seo_name_exists >= 1) { $seo_name_count = mysql_fetch_array(mysql_query("SELECT uses FROM ava_seonames WHERE seo_name = '$seo_name' AND type = '$type'")); mysql_query("UPDATE ava_seonames SET uses = uses + 1 WHERE seo_name = '$seo_name' AND type = '$type'"); $number = $seo_name_count['uses'] + 1; $seo_name = $seo_name.'-'.$number; } else { mysql_query("INSERT INTO ava_seonames (seo_name, type, uses) VALUES ('$seo_name', '$type', 1)"); } return $seo_name; } function curPageURL() {$pageURL = 'http';if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}$pageURL .= "://";if ($_SERVER["SERVER_PORT"] != "80") {$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];} else {$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];} return $pageURL;}  function SendPM($subject, $message, $to_user_id, $highscore_game_id = 0) {global $setting, $user;$date = date("Y-m-d H:i:s");mysql_query("INSERT INTO ava_messages (user_id, sender_id, sender_name, title, message, date, ip, highscore_game_id)VALUES ('$to_user_id', '$user[id]', '$user[username]', '$subject', '$message', '$date', '$_SERVER[REMOTE_ADDR]', $highscore_game_id)") or die (mysql_error());mysql_query("UPDATE ava_users SET messages = messages + 1, new_pms = 1 WHERE id = $to_user_id") or die (mysql_error());}

// Lang char conversions
// Uncomment the lines below if you want to convert special characters

//$language_char_conversions = 1; // Set to 1 to use conversion
//$originals = "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,O,Ö";
//$replacements = "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,O,O"
?>