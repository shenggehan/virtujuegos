<?php
if (!isset($core_admin)) {
	require_once '../../config.php';
	include ('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
}

$query = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order ASC");

while ($go = mysql_fetch_array($query)) {

	$url = CategoryUrl($go['id'], $go['seo_url'], 1, 'newest');
	$total_games = mysql_num_rows(mysql_query("SELECT * FROM ava_games WHERE category_id = $go[id]"));

echo '
<div id="category-'.$go['id'].'" class="manage_item">
	<div class="manage_column0">'.$go['id'].'</div>
	<div id="category-name-'.$go['id'].'" class="cat_manage_column">';
	
	if ($go['parent_id'] != 0) {
		echo ' &rarr; &nbsp;';
	}
	
	echo '<a href="'.$url.'" class="manage_link">'.$go['name'].'</a></div>
	
	<div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>
	<div class="manage_column3" id="edit-image-'.$go['id'].'"><img src="images/edit.png" width="24" height="24" onclick="EditCategory('.$go['id'].', \''.$go['name'].'\');"></div>
	<div class="manage_column_totalgames"><a href="?task=manage_games#page=1&cat='.$go['id'].'">'.$total_games.'</a></div>
	<div class="order_column" id="order_column'.$go['id'].'">';
	if ($go['parent_id'] == 0) {
		echo '<input type="text" onfocus="EditOrderDefault('.$go['id'].')" onchange="EditOrderSubmit('.$go['id'].');" class="category_order_text_box" value="'.intval($go['cat_order']).'" name="order_box'.$go['id'].'" id="order_box'.$go['id'].'">';
	}
	echo '</div><div id="edit-category-'.$go['id'].'" class="edit_game_container"></div>
</div>';

}

echo '<div id="thetop"></div>';