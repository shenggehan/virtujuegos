<?php

if (!defined('AVARCADE_')) {
	require_once 'config.php';
	include 'includes/core.php';
}

if (isset($_COOKIE['ava_lastpage'])) {
	$prevpage = $_COOKIE['ava_lastpage'];
	$len = strlen($setting['site_url']);
	if (substr( $prevpage, 0, $len ) === $setting['site_url']) {
		$prevpage = $_COOKIE['ava_lastpage'];
	}
	else {
		$prevpage = $setting['site_url'];
	}
}
else {
	$prevpage = $setting['site_url'];
}

if (isset($_GET["done"])) {
	session_start();

	if ((!$_POST['username']) || (!$_POST['password'])) { // User did not type a username and password	
		header("Location: index.php?task=login&em=1");
	}
	else {
		$username = mysql_secure($_POST['username']);
		$password = md5($_POST['password']);

		$sql = mysql_query("SELECT * FROM ava_users WHERE username='$username' AND password='$password' AND activate='1'");
		$login_check = mysql_num_rows($sql);

		if ($login_check > 0) {
			$row = mysql_fetch_array($sql);
			$user_id = $row['id'];
			
			if (isset($_POST['remember'])) {
				setcookie("ava_username", $username, time()+60*60*24*100);
				setcookie("ava_code", $password, time()+60*60*24*100);
				setcookie("ava_userid", $user_id, time()+60*60*24*100);
			}
			else {
				setcookie("ava_username", $username);
				setcookie("ava_code", $password);
				setcookie("ava_userid", $user_id); 
			}
			
			$lv = strtotime($row['last_activity']);
			setcookie('ava_lastvisit', $lv, 0, '/');
			setcookie('ava_lastactivity', time(), time()+60*60*24*100, '/');
			setcookie('ava_readtopics', '', time()-60*60*24*100, '/');
			setcookie('ava_readforums', '', time()-60*60*24*100, '/');

			if (isset($_GET['action']) && $_GET['action'] == 'admin') {
				header("Location: admin/index.php");
			}
			else {
				header('Location: '.urldecode($prevpage));
			}
		} 
		else {
			header("Location: index.php?task=login&em=2");
		}
	}
}
else if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	setcookie("ava_username", "", time()-3600);
	setcookie("ava_userid", "", time()-3600);
	setcookie("ava_code", "", time()-3600);
	setcookie("ava_iptrack", "", time()-3600);
	header("Location: index.php");
}
else { // No info was submitted - user is requesting login form
	if (isset($_GET['em'])) {
		if ($_GET['em'] == 1) {
			$error_message = LOGIN_ERROR1;
		}
		else {
			$error_message = LOGIN_ERROR2;
		}
	}
	if (isset($template['login_form'])) {
		include '.'.$setting['template_url'].'/'.$template['login_form'];
	}
	else {
		include 'includes/forms/login_form.php';
	}
}
?>