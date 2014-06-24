<?php
include '../../config.php';
include '../../includes/core.php';
include '../secure.php';
include '../admin_functions.php';
if ($login_status != 1) exit();
$code = '';

if ($_POST['filetype'] == 2) {
	$url = $setting['site_url'].'/games/'.$_POST['game_url'];
}
elseif ($_POST['filetype'] == 5) {
	$url = '';
	$code = $_POST['html_code'];
}
else {
	$url = $_POST['game_url'];
}

if ($_POST['imagetype'] == 2) {
	$img = $setting['site_url'].'/games/images/'.$_POST['image_url'];
}
else {
	$img = $_POST['image_url'];
}

if ($_POST['published'] == 1) {
	$link_class = 'manage_column';
}
else {
	$link_class = 'manage_column_unpublished';
}

if ($_POST['filetype'] == 5) {
	$ext = 'code';
}
elseif (strpos($url, '.') !== false) {
	$ext = substr($url, strrpos($url, '.') + 1);
}
else {
	$ext = 'swf';
}

$name = escape($_POST['game_name']);

$category = mysql_fetch_array(mysql_query("SELECT parent_id FROM ava_cats WHERE id = $_POST[game_category]"));

// If the id is 0 that means we are adding a new game instead of editing
if ($_POST['id'] == 0) {
	$date = date("Y-m-d H:i:s");
	$seo_url = create_seoname($name, 0, 'game');

	mysql_query("INSERT INTO ava_games (name, description, url, category_id, category_parent, width, height, image, published, filetype, instructions, date_added, advert_id, highscores, mochi_id, seo_url, submitter, html_code)
	VALUES ('".escape($_POST['game_name'])."', '".escape($_POST['game_description'])."', '$url', $_POST[game_category], $category[parent_id], '$_POST[width]', '$_POST[height]', '$img', $_POST[published], '$ext', '".escape($_POST['game_instructions'])."', '$date', $_POST[game_advert], $_POST[highscores], '$_POST[mochi_id]', '$seo_url', '$_POST[submitter]', '$code')") or die ('There was a MySql error when adding the game: '.mysql_error());

	$newid = mysql_insert_id();

	$category = mysql_query("SELECT * FROM ava_cats WHERE id=".$_POST['game_category']."");
	$category = mysql_fetch_array($category);

	if(isset($_POST['homepage'])) {
		echo 'Game added successfully';
	}
	else {
		// Send back the newly added game container if not submitted from homepage
		$url = GameUrl($newid, $seo_url, $category['id']);

		echo '
<div id="game-'.$newid.'" class="manage_item_new"><div class="manage_column0">'.$newid.'</div><div id="tgame_name'.$newid.'" class="'.$link_class.'"><a href="'.$url.'" class="manage_link">'.stripslashes($_POST['game_name']).'</a></div><div id="tcategory_name'.$newid.'" class="manage_column2">'.$category['name'].'</div><div class="manage_column3" id="edit-image-'.$newid.'"><img src="images/edit.png" width="24" height="24" onclick="edit_game('.$newid.');"></div><div class="manage_column3" id="delete-image-'.$newid.'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$newid.');"></div><div class="manage_column3" id="feature_icon'.$newid.'"><img src="images/feature.png" width="24" height="24" onclick="FeatureGame('.$newid.', 1);"></div>';

		if ($_POST['published'] == 1) {
			echo '<div class="manage_column3" id="published-image-'.$newid.'"><img src="images/published.png" width="24" height="24" onclick="TogglePublished('.$newid.', 0);"></div>';
		}
		else {
			echo '<div class="manage_column3" id="published-image-'.$newid.'"><img src="images/unpublished.png" width="24" height="24" onclick="TogglePublished('.$newid.', 1);"></div>';
		}

		echo '<div class="manage_column4"  id="comments-image-'.$newid.'"><img src="images/comments.gif" width="24" height="24" onclick="gotourl(\'index.php?task=manage_comments#page=1&id='.$newid.'\')"></div>';

		if ($_POST['highscores'] == 1) {
			echo '<div class="manage_column3"  id="delete-image-'.$newid.'"><img src="images/highscores.png" width="22" height="23" onclick="gotourl(\'?task=manage_highscores&id='.$newid.'#page=1&leaderboard=default&game='.$newid.'\')"></div>';
		}
		
		echo '<div id="edit-game-'.$newid.'" class="edit_game_container"></div></div>';
	}
}
// Else we are updating a game
else {
	$seo_url = create_seoname($name, $_POST['id'], 'game');
	mysql_query("UPDATE ava_games SET name='".escape($_POST['game_name'])."', description='".escape($_POST['game_description'])."', url='$url', category_id= $_POST[game_category], category_parent='$category[parent_id]', width='$_POST[width]', height='$_POST[height]', image='$img', published='$_POST[published]', filetype='$ext', instructions='".escape($_POST['game_instructions'])."', advert_id = $_POST[game_advert], highscores = $_POST[highscores], mochi_id = '$_POST[mochi_id]', seo_url = '$seo_url', submitter = '$_POST[submitter]', html_code = '$code' WHERE id='".$_POST['id']."'") or die (mysql_error());
	echo 'Success';

	$newid = $_POST['id'];
	mysql_query("DELETE FROM ava_tag_relations WHERE game_id='$newid'");
}

// Add game tags
if ($_POST['tags'] != '') {
	$tags = str_replace("  ", " ", $_POST['tags']);
	$tags = str_replace(", ", ",", $_POST['tags']);

	$tag_array = explode(",", $tags);

	add_tags($tag_array, $newid);
}

include 'tagcloud_gen.php';
?>