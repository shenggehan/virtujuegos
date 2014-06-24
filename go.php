<?php

require_once 'config.php';
include 'includes/core.php';
include 'language/'.$setting['language'].'.php';

// Check and set referrer
if (isset($_GET['ref'])) {
	setcookie("ava_ref", $_GET['ref'], time()+60*60*24*100);
}

$id = intval($_GET['id']);

$game = mysql_query("SELECT * FROM ava_games WHERE id=$id");
$get_game = mysql_fetch_array($game);

$url = GameUrl($get_game['id'], $get_game['seo_url'], $get_game['category_id']);
$url = str_replace("&amp;", "&", $url);

header("Location: $url");

?>