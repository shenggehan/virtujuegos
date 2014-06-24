<?php
include('../../config.php');
include('../../includes/core.php');
include('../admin_functions.php');
include '../secure.php';
if ($login_status != 1) exit();
ini_set("memory_limit","25M");

$feed_setting = feed_setting('all');

$ext = substr($game['thumbnail_url'], strrpos($game['thumbnail_url'], '.') + 1);

if (((strpos($ext, "php") !== false) || $ext == 'aspx' || $ext == 'py' || $ext == 'htaccess') && !isset($allow_php_uploads)) {

}

if ($feed_setting['curl'] == 1) {
	$file = curl($_POST['url']);
} else {
	$file = file_get_contents($_POST['url']);
}

$filename = basename($_POST['url']); 
if($_POST['type'] == 1) {
	$new_file = fopen("../../games/$filename","wb");
}
else {
	$new_file = fopen("../../games/images/$filename","wb");
}
fwrite($new_file, $file);
fclose($new_file);
?>