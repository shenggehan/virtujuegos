<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$get_category = mysql_fetch_array(mysql_query("SELECT * FROM ava_cats WHERE id = $_POST[id]"));

$result = mysql_query("DELETE FROM ava_cats WHERE id='".$_POST['id']."'");

$get_seo_url = mysql_fetch_array(mysql_query("SELECT * FROM ava_seonames WHERE seo_name = '$get_category[seo_url]'"));

if ($get_seo_url['uses'] == 1)
	mysql_query("DELETE FROM ava_seonames WHERE id = $get_seo_url[id]");

mysql_query("UPDATE ava_games SET category_id=$_POST[new_cat] WHERE category_id = $_POST[id]");

echo 'Success';
?>