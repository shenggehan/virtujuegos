<?php

include('../../config.php');
include('../../includes/core.php');
include '../secure.php';
if ($login_status != 1) exit();
$id = $_POST['id'];
$old_details = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id = $id"));

$pass = str_replace(' ', '', $_POST['password']); 

if ($pass != '') {
	$password = md5($_POST['password']);
	mysql_query("UPDATE ava_users SET password = '$password' WHERE id = $id") or die (mysql_error());
}

$seo_url = seoname($_POST['username']);

if ($setting['forums_installed'] == 1) {
	$fs = ", forum_signature = '".mysql_real_escape_string($_POST['forum_signature'])."'";
}
else {
	$fs = '';
}

mysql_query("UPDATE ava_users SET username='".mysql_secure($_POST['username'])."', activate='".mysql_secure($_POST['active'])."', email='".mysql_secure($_POST['email'])."', location='".mysql_secure($_POST['location'])."',  about='".mysql_secure($_POST['about'])."', website='".mysql_secure($_POST['website'])."', admin='".mysql_secure($_POST['admin'])."', avatar='".mysql_secure($_POST['avatar'])."', points='".mysql_secure($_POST['points'])."', seo_url='$seo_url' $fs WHERE id='".mysql_secure($_POST['id'])."'") or die (mysql_error());

if ($old_details['username'] != $_POST['username']) {
	mysql_query("UPDATE ava_posts SET username='".mysql_secure($_POST['username'])."' WHERE username = '".mysql_secure($old_details['username'])."'");
	mysql_query("UPDATE ava_topics SET topic_starter='".mysql_secure($_POST['username'])."' WHERE topic_starter = '".mysql_secure($old_details['username'])."'");
	mysql_query("UPDATE ava_topics SET last_post_user='".mysql_secure($_POST['username'])."' WHERE last_post_user = '".mysql_secure($old_details['username'])."'");
}

?>