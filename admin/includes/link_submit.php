<?php
include('../../config.php');
include '../secure.php';
if ($login_status != 1) exit();

if ($_POST['id'] != 0) {	
	mysql_query("UPDATE ava_links SET name='$_POST[name]', description='$_POST[description]', url='$_POST[url]', sitewide='$_POST[sitewide]', published='$_POST[published]', submitter = '$_POST[submitter]' WHERE id='$_POST[id]'") or die (mysql_error());
}
else {
	mysql_query("INSERT INTO ava_links (name, url, description, sitewide, published, submitter) VALUES ('$_POST[name]', '$_POST[url]', '$_POST[description]', '$_POST[sitewide]', '$_POST[published]', '$_POST[submitter]')");
	
	$newid = mysql_insert_id();
	
	echo '
<div id="link-'.$newid.'" class="manage_item_new"><div class="manage_column0">'.$newid.'</div><div id="tlink_name'.$newid.'" class="manage_column"><a href="'.$_POST['url'].'" class="manage_link">'.$_POST['name'].'</a></div><div id="tcategory_name'.$newid.'" class="manage_column2"></div>

<div class="manage_column2fixed">0</div>
<div class="manage_column2fixed">0</div>

<div class="manage_column3" id="delete-image-'.$newid.'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$newid.');"></div>
<div class="manage_column3" id="edit-image-'.$newid.'"><img src="images/edit.png" width="24" height="24" onclick="edit_link('.$newid.');"></div>';

if ($_POST['published'] == 1) {
	echo '<div class="manage_column3" id="published-image-'.$newid.'"><img src="images/published.png" width="24" height="24" onclick="TogglePublished('.$newid.', 0);"></div>';
}
else {
	echo '<div class="manage_column3" id="published-image-'.$newid.'"><img src="images/unpublished.png" width="24" height="24" onclick="TogglePublished('.$newid.', 1);"></div>';
}

echo '<div id="edit-link-'.$newid.'" class="edit_game_container"></div>

</div>';


}

?>