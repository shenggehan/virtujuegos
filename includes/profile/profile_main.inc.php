<?php
defined( 'AVARCADE_' ) or die( '' );

if (isset($_GET['name'])) {
	$seo_url = mysql_secure($_GET['name']);
	$sql = mysql_query("SELECT * FROM ava_users WHERE seo_url='".$seo_url."'");
}
else {
	$sql = mysql_query("SELECT * FROM ava_users WHERE id='".$id."'");
}

$user_exists = mysql_num_rows($sql);
if ($user_exists != 1) {
	header("HTTP/1.0 404 Not Found");
	include 'includes/misc/404.php';
	exit();
}

$row = mysql_fetch_array($sql);
$profile = array();
$profile['name'] = $row['username'];
$id = $row['id'];

if ($row['location'] == '') {
	$profile['location'] = PROFILE_NO_INFO;
}
else {
	$profile['location'] = $row['location'];
}
if ($row['website'] == '') {
	$profile['website'] = PROFILE_NO_INFO;
}
else {
	$profile['website'] = $row['website'];
}
if ($row['website'] == '') {
	$profile['website_link'] = PROFILE_NO_INFO;
}
else {
	$profile['website_link'] = '<a href="'.$row['website'].'" rel="nofollow">'.$row['website'].'</a>';
}
if ($row['about'] == '') {
	$profile['about'] = PROFILE_NO_INFO;
}
else {
	$profile['about'] = $row['about'];
}
if ($row['interests'] == '') {
	$profile['interests'] = PROFILE_NO_INFO;
}
else {
	$profile['interests'] = $row['interests'];
}
if ($row['avatar'] == '') {
	if ($row['facebook'] == 1) {
		$profile['avatar_url'] = 'http://graph.facebook.com/'.$row['facebook_id'].'/picture';
	}
	else {
		$profile['avatar_url'] = $setting['site_url'].'/uploads/avatars/default.png';
	}
}
else {
	$profile['avatar_url'] = $setting['site_url'].'/uploads/avatars/'.$row['avatar'];
}

$profile['last_activity'] = FormatDate($row['last_activity'], 'time');

$profile['comments'] = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_comments WHERE user=$id"),0);
$profile['id'] = $row['id'];
$profile['plays'] = $row['plays'];
$profile['comments'] = $row['comments'];
$profile['ratings'] = $row['ratings'];
$profile['forum_posts'] = $row['forum_posts'];
$profile['forum_signature'] = $row['forum_signature'];
$profile['forum_posts_link'] = $setting['site_url'].'/index.php?task=forum_search&post_user='.$profile['name'].'&search_type=posts';
if ($row['points'] == '') {
	$profile['points'] = 0;
}
else {
	$profile['points'] = $row['points'];
}
$profile['join_date'] = FormatDate($row['joined'], 'short');

if ($id == $_COOKIE['ava_userid']) 
{
  $profile['button1'] = '<a href="'.$setting['site_url'].'/index.php?task=edit_profile">'.PROFILE_EDIT.'</a>';
}
else 
{ 
 $profile['button1'] = '<a href="'.$setting['site_url'].'/index.php?task=send_message&amp;id='.$id.'">'.PROFILE_SEND_MESSAGE.'</a>';
}

// Check if user is friend
if (($user['login_status'] == 1) && ($id != $user['id'])) {
	$is_friend = mysql_query("SELECT * FROM ava_friends WHERE user1 = $user[id] AND user2 = $row[id]");
	if (mysql_num_rows($is_friend)) {
		$profile['button2'] = '<div id="friend_button"><a href="#" onclick="ManageFriend('.$row['id'].', \'delete_friend\', \'profile\');return false">'.UNFRIEND.'</a></div>';
	}
	else {
		$request_pending = mysql_query("SELECT * FROM ava_friend_requests WHERE from_user = $user[id] AND to_user = $row[id]");
		if (mysql_num_rows($request_pending)) {
			$profile['button2'] = '<div id="friend_button"><a href="#">'.REQUEST_SENT.'</a></div>';
		}
		else {
			$profile['button2'] = '<div id="friend_button"><a href="#" onclick="ManageFriend('.$row['id'].', \'send_request\', \'profile\');return false">'.ADD_FRIEND.'</a></div>';
		}
	}
}
else {
	$profile['button2'] = '';
}

// If admin is logged in show admin option otherwise show report option
if($user['admin'] == 1) {
	$profile['admin_edit'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_users#id='.$id.'">Edit user</a>';
}
else {
	$profile['admin_edit'] = '<a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/user_report_form.php?id='.$profile['id'].'\', \''.REPORT_USER.'\');return false">'.REPORT_USER.'</a>';
}
?>