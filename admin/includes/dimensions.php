<?php
include '../../config.php';

if ($_POST['type'] == 2) {
	$url = $setting['site_url'].'/games/'.$_POST['file'];
}
else {
	$url = $_POST['file'];
}

$url = str_replace($setting['site_url'], "../..", $url);

$dimensions = @getimagesize($url);

if (!$dimensions) {
	echo '{"success":0,"width":0,"height":0}';
}
else {
	echo '{"success":1,"width":'.$dimensions[0].',"height":'.$dimensions[1].'}';
}

?>