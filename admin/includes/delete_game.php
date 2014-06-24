<?php
require_once '../../config.php';
include '../secure.php';
include '../../includes/core.php';
if ($login_status != 1) exit();

$q = mysql_query("SELECT * FROM ava_games WHERE id=$_POST[id]");
$r = mysql_fetch_array($q);

$result = mysql_query("DELETE FROM ava_games WHERE id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_tag_relations WHERE game_id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_ratings WHERE game_id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_comments WHERE link_id='".$_POST['id']."'");
mysql_query("DELETE FROM ava_leaderboards WHERE game_id = '$_POST[id]'");
mysql_query("DELETE FROM ava_highscores WHERE game = $_POST[id]");

include 'tagcloud_gen.php';

if ($_POST['files'] == 1) {
	if (strstr($r['url'], $setting['site_url'])) {
		$file = str_replace($setting['site_url'], '', $r['url']);
		$file = '../..'.$file;
		unlink($file);
	}
	else if ($r['import'] == 1) {
		$file = '../../games/'.$r['id'].'.swf';
		unlink($file);
	}
	if (strstr($r['image'], $setting['site_url'])) {
		$file = str_replace($setting['site_url'], '', $r['image']);
		$file = '../..'.$file;
		unlink($file);
	}
	else if ($r['import'] == 1) {
		$file = '../../games/images/'.$r['id'].'.png';
		unlink($file);
	}
}

echo 'Success';
?>