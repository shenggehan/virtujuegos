<?php
// This file is included by AV Arcade and should not be included in the template file

defined( 'AVARCADE_' ) or die( '' );

// Get by id or seo_name depending on SEO setting
if (isset($_GET['name'])) {
	$cat_seo_url = mysql_secure($_GET['cat']);
	$category = mysql_fetch_array(mysql_query("SELECT * FROM ava_cats WHERE seo_url = '$cat_seo_url'"));
	$seo_url = mysql_secure($_GET['name']);
	$game_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE seo_url = '$seo_url' AND category_id = '$category[id]' AND published=1"),0);
}
else {
	$game_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE id= '$id' AND published=1"),0);
}
	
if ($game_exists != 0) {
	
	if ($setting['play_limit'] == 1) {
		
		if(!isset($_COOKIE["ava_username"])) { 
			if (isset($_COOKIE["ava_plays"])) {
				$newplay = ($_COOKIE["ava_plays"] + 1);
				setcookie("ava_plays", $newplay, time()+60*60*24*100, '/');
			}
			else {
				$newplay = 1;
				setcookie("ava_plays", 1, time()+60*60*24*100, '/');
			}
			
			if ($setting['plays'] <= $newplay) {
				$show = 0;
			}
			else {
				// User has not used all plays
				$show = 1;
			}
		}
		else {
			// AVA Username is set
			$show = 1;
		}
	}
	else {
		// No play limit
		$show = 1;
	}
}
else {
	// Game not found
	header("HTTP/1.0 404 Not Found");
	include 'includes/misc/404.php';
	exit();
}

if (isset($_GET['name'])) {
	$sql = mysql_query("SELECT * FROM ava_games WHERE seo_url = '$seo_url'");
}
else {
	$sql = mysql_query("SELECT * FROM ava_games WHERE id = $id");
}
$row2 = mysql_fetch_array($sql);
$id = $row2['id'];
	
// Define 'game_info' array for usage in the view game template
$game = GameData($row2, 'view_game');

// Detect the right fullscreen mode
$game['full_screen'] = 1;
if (($row2['filetype'] == 'swf') && ($setting['fullscreen_mode'] == 1)) {
	$game['full_screen_url'] = '#" onclick="ResizeFlash('.$row2['height'].', '.$row2['width'].'); return false';
}
else if ($row2['filetype'] == 'unity' || $row2['filetype'] == 'unity3d' || $row2['filetype'] == 'code') {
	$game['full_screen_url'] = '#';
	$game['full_screen'] = 0;
}
else {
	$game['full_screen_url'] = $setting['site_url'].'/full_screen.php?id='.$id;
}
	
// Favourite game button
if ($user['login_status'] == 1) {
	$user_fav_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_favourites WHERE user_id='$user[id]' AND game_id='$id'"), 0);
	if ($user_fav_yet >= 1) {
		$game['fav_game'] = '<div class="normal_button" id="favbutton"><a href="#">'.GAME_UNFAVOURITE.'</a></div>';
	}
	else {
		$game['fav_game'] = '<div class="normal_button" id="favbutton"><a href="#">'.GAME_FAVOURITE.'</a></div>';
	}
}
else {
	$game['fav_game'] = '<div class="normal_button" id="favbutton"><a href="'.$user['login_link'].'">'.LOGIN.'</a></div>';
}

// Report game button
if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) { 
	$game['report_game'] = '<div class="normal_button"><a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/game_report_form.php?id='.$row2['id'].'\', \''.GAME_REPORT.'\'); return false">'.GAME_REPORT.'</a></div>';
}
		
// Define the 'new rating' section for the template
if(isset($_COOKIE["ava_username"]))
{
	$user_rated_yet = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_ratings WHERE user_id='$user[id]' AND game_id='$id'"), 0);
	if ($user_rated_yet >= 1) {
		$ur = mysql_query("SELECT * FROM ava_ratings WHERE game_id=$id AND user_id='$user[id]'");
		$user_rating = mysql_fetch_array($ur);
			
		$game['new_rating_form'] = GenerateRating($user_rating['rating'], 'view_game');
	}
	else {
		$game['new_rating_form'] = '<div id="rateMe" title="Rate Me...">
    	<a onclick="rateIt(this, '.$id.')" id="_1" title="1" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.')" id="_2" title="2" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.')" id="_3" title="3" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.')" id="_4" title="4" onmouseover="rating(this)" onmouseout="off(this)"></a>
    	<a onclick="rateIt(this, '.$id.')" id="_5" title="5" onmouseover="rating(this)" onmouseout="off(this)"></a>
		</div>';
	}
}
else {
	$game['new_rating_form'] = GAME_LOGIN_TO_RATE;
}

$game['tags'] = TagList($row2['id'], "&nbsp; ", 1);

if ($game['tags'] == '') {
	$game['tags'] = NO_TAGS;
}

if ($user['login_status'] == 1) {
	$user_has_highscore = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_highscores WHERE user= $user[id] AND game = $id"), 0);
	if ($user_has_highscore) {
		$style = 'display: inherit';
		$message = HIGHSCORE_ALREADY_SUBMITTED;
	}
	else {
		$style = 'display: none';
		$message = HIGHSCORE_SUBMITTED;
	}
	
	$game['game_message'] = '<div id="game_message" style="'.$style.'">'.$message.' - <a href="#" id="challenge_link" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/view_game/ajax/challenge_friend.php?id='.$game['id'].'\', \''.CHALLENGE_HEADING.'\'); return false">'.CHALLENGE_A_FRIEND_LONG.'</a></div>';
}
else {
	$game['game_message'] = '';
}

$game['edit_game_link'] = $setting['site_url'].'/admin/?task=manage_games#id='.$id;
	
// If admin is logged in, show admin options
if($user['admin'] == 1) {
	$game['admin_options'] = '<a href="'.$game['edit_game_link'].'">Edit game</a>';
}
else {
	$game['admin_options'] = '';
}
?>