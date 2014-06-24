<?php
include '../../config.php';
include '../../includes/core.php';
include('../admin_functions.php');
include '../secure.php';
if ($login_status != 1) exit();

$name = htmlspecialchars($_POST['name']);
$description = htmlspecialchars(addslashes($_POST['description']));

if ($_POST['id'] != 0) {	
	$seo_url = create_seoname($_POST['name'], $_POST['id'], 'category');
	
	if ($_POST['parent_id'] != 0) {
		$parent = mysql_fetch_array(mysql_query("SELECT cat_order FROM ava_cats WHERE id = $_POST[parent_id]"));
		$cat_order = intval($parent['cat_order']).'.1';
		
		$update_cat_order = "cat_order = '$cat_order',";
	}
	else {
		$update_cat_order = '';
	}
	
	mysql_query("UPDATE ava_cats SET name='$name', $update_cat_order description = '$description', keywords = '$_POST[keywords]', seo_url = '$seo_url', parent_id = $_POST[parent_id] WHERE id='$_POST[id]'");
	mysql_query("UPDATE ava_games SET category_parent = $_POST[parent_id] WHERE category_id = $_POST[id]");
}
else {
	if ($_POST['parent_id'] == 0) {
		$cat_order = (mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_cats WHERE parent_id = 0"),0) + 1);
	}
	else {
		$parent = mysql_fetch_array(mysql_query("SELECT cat_order FROM ava_cats WHERE id = $_POST[parent_id]"));
		$cat_order = intval($parent['cat_order']).'.1';
	}
	
	$seo_url = create_seoname($_POST['name'], 0, 'category');
	
	mysql_query("INSERT INTO ava_cats (name, cat_order, description, keywords, seo_url, parent_id)
	VALUES ('$name', $cat_order, '$description', '$_POST[keywords]', '$seo_url', $_POST[parent_id])") or die ('There was a MySql error when adding the category: '.mysql_error());
	
	$newid = mysql_insert_id();
	$url = CategoryUrl($newid, $seo_url, 1, 'newest');
	
	echo '<div id="category-'.$newid.'" class="manage_item_new"><div class="manage_column0">'.$newid.'</div><div id="category-name-'.$newid.'" 
	class="manage_column"><a href="'.$url.'" class="manage_link">'.$_POST['name'].'</a></div><div class="manage_column3" 
	id="delete-image-'.$newid.'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$newid.');"></div><div class="manage_column3" 
	id="edit-image-'.$newid.'"><img src="images/edit.png" width="24" height="24" onclick="EditCategory('.$newid.', ';

	echo "'".$_POST['name']."'";
	echo ');"></div>
	<div class="manage_column_totalgames"><a href="?task=manage_games#page=1&cat='.$newid.'">0</a></div>
	<div class="order_column"><input type="text" onfocus="EditOrderDefault('.$newid.')" onchange="EditOrderSubmit('.$newid.');" class="category_order_text_box" value="'.$cat_order.'" name="order_box'.$newid.'" id="order_box'.$newid.'"></div>
	<div id="edit-category-'.$newid.'" class="edit_game_container"></div></div>';
}

?>