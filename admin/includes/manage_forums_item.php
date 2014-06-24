<?php
echo '
<div id="forum-'.$forum['id'].'" class="manage_item">
	<div class="manage_column0">'.$forum['id'].'</div>
	<div id="forum-name-'.$forum['id'].'" class="cat_manage_column">';
	
	if ($forum['parent_id'] != 0) {
		echo $indent.'&rsaquo; &nbsp;';
	}
	
	$url = ForumUrl($forum['id'], $forum['seo_url'], 1);
	echo '<a href="'.$url.'" class="manage_link">'.$forum['name'].'</a></div>
	
	<div class="manage_column3" id="delete-image-'.$forum['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$forum['id'].');"></div>
	<div class="manage_column3" id="edit-image-'.$forum['id'].'"><img src="images/edit.png" width="24" height="24" onclick="EditForum('.$forum['id'].');"></div>
	
	<div class="order_column" id="order_column'.$forum['id'].'">
	<input type="text" onfocus="EditOrderDefault('.$forum['id'].')" onchange="EditOrderSubmit('.$forum['id'].');" class="category_order_text_box" value="'.intval($forum['forum_order']).'" name="order_box'.$forum['id'].'" id="order_box'.$forum['id'].'">
	</div><div id="edit-forum-'.$forum['id'].'" class="edit_game_container"></div>
</div>';

if ($forum['has_children'] == 1) {
	$sub_level++;
	printForums($forums['children']);
	$sub_level--;
}

?>