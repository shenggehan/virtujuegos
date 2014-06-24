<?php
defined( 'AVARCADE_' ) or die( '' );
if (($user['login_status'] == 1) && ($setting['allow_submissions'] == 1)) {
	if ($_POST) {
		// If 'step' isn't set, we're doing the first step, game info
		if (!isset($_GET['id'])) {
			$strippedname = str_replace(" ", "-", $_POST['name']);
			if ($strippedname != '' && $_POST['description'] != '' &&  $_POST['instructions'] != '') {
				//Сheck that we have a file
				$upload_image = upload_file('image', 'thumbnail', '5', $setting['submissions_folder'].'/thumbnails');
				if ($upload_image['success']) {
				
					$name = mysql_secure($_POST['name']);
					$description = mysql_secure($_POST['description']);
					$instructions = mysql_secure($_POST['instructions']);
					$tags = mysql_secure($_POST['tags']);
					$category = intval($_POST['category']);
				
					mysql_query("INSERT INTO ava_submissions (name, description, instructions, tags, thumbnail, category, user) VALUES ('$name', '$description', '$instructions', '$tags', '$setting[site_url]/$upload_image[url]', $category, $user[id])") or die (mysql_error());
					
					$submission_id = mysql_insert_id();
					echo '<div id="error_message">'.FILE_DISCLAIMER.'</div>';
					include 'includes/forms/submit_game_file.php'; 
				}
				else {
					echo '<div id="error_message">'.$upload_image['error'].'</div>';
					include 'includes/forms/submit_game.php';
				}
			} else {
				echo '<div id="error_message">'.SUBMIT_E_UNFILLED.'</div>';
				include 'includes/forms/submit_game.php';
			}
		}
		// Else we're doing part 2, the swf upload
		else {
			$submission_id = intval($_GET['id']);
			$valid_submission = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_submissions WHERE id = $submission_id AND file = '' AND user = $user[id]"), 0);
			if ($valid_submission == 1) {
				$upload_file = upload_file('game', 'file', '5', $setting['submissions_folder'].'/games');
				if ($upload_file['success']) {
					$file_url = $setting['site_url'].'/'.$upload_file['url'];
					$dimensions = getimagesize($file_url);
				
					mysql_query("UPDATE ava_submissions SET file = '$file_url', width = '$dimensions[0]', height = '$dimensions[1]' WHERE id = '$submission_id' AND user = $user[id]") or die (mysql_error());
				
					echo '<div id="error_message">'.SUBMIT_SUCCESS.'</div>';
					include 'includes/forms/submit_game.php'; 
				}
				else {
					echo '<div id="error_message">'.$upload_file['error'].'</div>';
					$submission_id = intval($_GET['id']);
					include 'includes/forms/submit_game_file.php';
				}
			}
			else {
				echo ERROR_MESSAGE; // No valid submission, either you were not the uploader or the file has already been submitted
			}
		}
	}
	else {
		if (!isset($_GET['id'])) {
			$pending_subs = mysql_query("SELECT * FROM ava_submissions WHERE user = $user[id] AND file = ''");
			$pending_count = mysql_num_rows($pending_subs);
			if ($pending_count != 0) {
				echo '<div id="error_message">';
				while ($pending_game = mysql_fetch_array($pending_subs)) {
					echo SUBMIT_PARTIAL.' "'.$pending_game['name'].'". <a href="'.$setting['site_url'].'/index.php?task=submit&id='.$pending_game['id'].'">'.SUBMIT_PARTIAL_LINK.'</a><br />';
				}
				echo '</div>';
			}
		
			include 'includes/forms/submit_game.php';
		}
		else {
			$submission_id = intval($_GET['id']);
			echo '<div id="error_message">'.FILE_DISCLAIMER.'</div>';
			include 'includes/forms/submit_game_file.php'; 
		}
	}
}
else {
	if ($setting['allow_submissions'] == 1) {
		echo '<div id="error_message">'.SUBMIT_E_NOLOGIN.'</div>';
	}
	else {
		echo '<div id="error_message">'.SUBMIT_E_DISABLED.'</div>';
	}
}

?>