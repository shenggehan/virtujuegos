<?php
defined( 'AVARCADE_' ) or die( '' );

if ($_POST) {
	//Сheck that we have a file
	if ((!empty($_FILES["img_file"])) && ($_FILES['img_file']['error'] == 0)) {
		//Check if the file is an image using mime details and file extension
		$filename = basename($_FILES['img_file']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);
		if (($ext == "png" || $ext == "jpg" || $ext == "jpeg" || $ext == "gif" || $ext == "PNG" || $ext == "JPG" || $ext == "JPEG" || $ext == "GIF")
		&& ($_FILES["img_file"]["type"] == "image/png" || $_FILES["img_file"]["type"] == "image/x-png" || $_FILES["img_file"]["type"] == "image/jpeg" || $_FILES["img_file"]["type"] == "image/pjpeg" || $_FILES["img_file"]["type"] == "image/gif")) {
			if ($_FILES["img_file"]["size"] <= 1048576) {
				list($width, $height) = getimagesize($_FILES['img_file']['tmp_name']);
				if ($width <= 300 && $height <= 300) {
					//Determine the path to which we want to save this file
					$rand_name = rand();
					$avatar_name = 'user-'.$user['id'].'.'.$ext;
					$newname = 'uploads/avatars/'.$avatar_name;
					if ((move_uploaded_file($_FILES['img_file']['tmp_name'], $newname))) {
						mysql_query("UPDATE ava_users SET avatar='$avatar_name' WHERE id='$user[id]'") or die (mysql_error());
						$user['avatar'] = $setting['site_url'].'/'.$newname;
						echo '<div id="error_message">'.AV_SUCCESS.'</div>';
					} else {
						echo '<div id="error_message">'.AV_ERROR1.'</div>';
					}
				} else {
					echo '<div id="error_message">'.AV_ERROR2.'</div>';
				}
			} else {
				echo '<div id="error_message">'.AV_ERROR3.'</div>';
			}
		}
		else {
			echo '<div id="error_message">'.AV_ERROR4.'</div>';
		}
	}
	else {
		echo '<div id="error_message">'.AV_ERROR5.'w</div>';
	}
}
else {
	include 'includes/forms/avatar_form.php';
}
?>