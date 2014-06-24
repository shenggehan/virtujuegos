<?php
$html = stripslashes($_POST['code']);

$find_height = preg_match('/height="([0-9]*)"/', $html, $height);
$find_width = preg_match('/width="([0-9]*)"/', $html, $width);
$find_src = preg_match('/src="(.*?)"/', $html, $src);

$found = 0;

if ($find_width) {
	$data['width'] = $width[1];
	$found = 1;
}
else {
	$data['width'] = '';
}

if ($find_height) {
	$data['height'] = $height[1];
	$found = 1;
}
else {
	$data['height'] = '';
}

if ($find_src) {
	$data['src'] = $src[1];
	$found = 1;
}
else {
	$data['src'] = '';
}

if ($found == 1) {
	$message = 'Values found:<br>';
	foreach ($data as $key => $type) {
		if ($type != '')
			$message .= '<br>'.ucfirst($key).': '.$type;
	}
	$message .= '<br><br>Use these values?';
}
else {
	$message = 'No width, height or src (file source) found. Paste the embed code for a game to get the width, height and file URL.';
}

$data['message'] = $message;

print_r(json_encode($data));
?>