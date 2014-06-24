<?php 
include '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

if ($_POST['type'] == 'games') {

	$dir = opendir('../../games');
	$sorted = array();
	while (false !== ($file = readdir($dir))) {
		$sorted[] = $file;
	}
	closedir($dir);
	
	natcasesort($sorted);
	
	echo '<select name="gFile" id="drop-down'.$_POST['id'].'">';
	foreach($sorted as $file) {
		if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store" && $file != "images") {

			if (strlen($file) > 25) {
				$name_file = substr($file, 0, 25)."...";
			}
			else {
				$name_file = $file;
			}
			if ($file == $_POST['selected']) {
				echo '<option value="'.$file.'" selected>Just uploaded: '.$file.'</option>';
			}
			else {
				echo '<option value="'.$file.'">'.$name_file.'</option>';
			}
		}
	}
	echo '</select>';
}

else {

	$dir = opendir('../../games/images');
	$sorted = array();
	while (false !== ($file = readdir($dir))) {
		$sorted[] = $file;
	}
	closedir($dir);
	
	natcasesort($sorted);
	
	echo '<select name="iFile" id="image-drop-down'.$_POST['id'].'">';
	foreach($sorted as $file) {
		if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store") {

			if (strlen($file) > 25) {
				$name_file = substr($file, 0, 25)."...";
			}
			else {
				$name_file = $file;
			}
			if ($file == $_POST['selected']) {
				echo '<option value="'.$file.'" selected>Just uploaded: '.$file.'</option>';
			}
			else {
				echo '<option value="'.$file.'">'.$name_file.'</option>';
			}
		}
	}
	echo '</select>';
}
?>