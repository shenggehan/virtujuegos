<?php
define('AVARCADE_', 1);

if (isset($get_load_time)) {
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$start = $time;
}

require_once 'config.php';
include 'includes/core.php';

// Include language file
include 'language/'.$setting['language'].'.php';

$time_now = date("Y-m-d H:i:s");

if (isset($_COOKIE['ava_lastpage'])) {
	$prev_page = secure($_COOKIE['ava_lastpage']);
}
// Set current page
if (!isset($_GET['task']) || (isset($_GET['task']) && $_GET['task'] != 'register' && $_GET['task'] != 'validate' && $_GET['task'] != 'login')) {
	setcookie('ava_lastpage', curPageUrl(), time()+60*60*24*100, '/');
}

// Get logged in user
$user = getUser();

// Update the user IP if this is a new session, update users last activity
if ($user['login_status'] == 1) {
	$update_new_frs = '';
	$update_topic = '';
	if ($user['new_pms'] == 0) {
		$update_new_frs = ", new_frs = 0";
	}
	if (isset($_GET['task']) && $_GET['task'] == 'topic') {
		$update_topic = ", new_topic = 0";
	}
	if (!isset($_COOKIE['ava_iptrack'])) {
		mysql_query("UPDATE ava_users SET lastip = '$user[ip]', last_activity = '$time_now', new_pms = 0$update_new_frs$update_topic WHERE id = $user[id]") or die (mysql_error());
		setcookie("ava_iptrack", '1');
	}
	else {
		mysql_query("UPDATE ava_users SET last_activity = '$time_now', new_pms = 0$update_new_frs$update_topic WHERE id = $user[id]") or die (mysql_error());
	}
	
	if ($setting['seo_on'] == 0) {
		$user['message_url'] = $setting['site_url'].'/index.php?task=messages';
		$user['friends_url'] = $setting['site_url'].'/index.php?task=friends';
	}
	else {
		$user['message_url'] = $setting['site_url'].'/messages'.$setting['seo_extension'];
		$user['friends_url'] = $setting['site_url'].'/friends';
	}

	if ($user['admin'] == 1) {
		$user['admin_link'] = '<a href="'.$setting['site_url'].'/admin/">'.UA_ADMIN.'</a>';
	}
	else {
		$user['admin_link'] = '';
	}

	if ($user['friend_requests'] == 0) {
		$user['friends_anchor'] = UA_FRIENDS;
	}
	else if ($user['friend_requests'] == 1) {
			$user['friends_anchor'] = $user['friend_requests'].' '.UA_FRIENDS_1NEW;
		}
	else {
		$user['friends_anchor'] = $user['friend_requests'].' '.UA_FRIENDS_NEW;
	}
}

// Update users online
include 'includes/update_users_online.php';

if ($setting['seo_on'] != 0) {
	$search_function = "searchSubmit('$setting[site_url]', '$setting[seo_extension]'); return false;";
}
else {
	$search_function = "this.submit();return false;";
}

// Make safe id
if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
}

// Check and set referrer
if (isset($_GET['ref'])) {
	setcookie("ava_ref", $_GET['ref'], time()+60*60*24*100);
}
if (isset($_GET['r']) && !isset($_COOKIE['ava_lr'])) {
	$referer_id = intval($_GET['r']);
	mysql_query("UPDATE ava_links SET inbound = inbound + 1 WHERE id = $referer_id");
	setcookie("ava_lr", 1, time()+86400);	
} 

// Get search query
if (isset($_GET['q'])) {
	$search_val = htmlspecialchars($_GET['q']);
}
else {
	$search_val = SEARCH_DEFAULT;
}

if ($setting['forums_installed'] == 1 && isset($_GET['task']) && ($_GET['task'] == 'forums' || $_GET['task'] == 'forum' || $_GET['task'] == 'topic' || $_GET['task'] == 'forum_search')) {
	if ($setting['forum_template'] != 'default') {
		$setting['template_url'] = $setting['forum_template'];
	}
}

if (($setting['site_offline'] == 0) || ($user['admin'] == 1)) {
	// Include the template
	if (file_exists('.'.$setting['template_url'].'/template_settings.php')) {
		// Include the template settings
		include '.'.$setting['template_url'].'/template_settings.php';
	
		// Include unique required files
		if (isset($_GET['task'])) {
			if ($_GET['task'] == 'view') {
				include('includes/view_game/view_game_main.inc.php');
			}
			else if ($_GET['task'] == 'profile') {
				include('includes/profile/profile_main.inc.php');
			}
			else if ($_GET['task'] == 'category') {
				include('includes/category/category_header.inc.php');
			}
			else if ($_GET['task'] == 'news') {
				include('includes/news/news_header.inc.php');
			}
			else if ($_GET['task'] == 'view_page') {
				if (isset($_GET['id'])) {
					$get_page_data = mysql_query("SELECT * FROM ava_pages WHERE id = $id");
				}
				else {
					$name = mysql_secure($_GET['name']);
					$get_page_data = mysql_query("SELECT * FROM ava_pages WHERE seo_url= '$name'");
				}
				$page = mysql_fetch_array($get_page_data);
			}
		}

		// Include the correct template page
		if ($setting['forums_installed'] == 1 && isset($_GET['task']) && ($_GET['task'] == 'forums' || $_GET['task'] == 'forum' || $_GET['task'] == 'topic' || $_GET['task'] == 'forum_search')) {
			include 'avforums/index.php';
		}
		else {
			include '.'.$setting['template_url'].'/template_structure.php';
		}
	}
	else {
		echo 'template_settings.php was not found in the template folder you specified. Your template may be missing.'; 
	}
}
else {
	include ('includes/misc/site_offline.php');
}

if (isset($get_load_time)) {
	$time = microtime();
	$time = explode(' ', $time);
	$time = $time[1] + $time[0];
	$finish = $time;
	$total_time = round(($finish - $start), 4);
	echo 'Page generated in '.$total_time.' seconds.'."\n";
}
?>