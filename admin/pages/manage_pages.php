<?php if ($login_status != 1) exit(); ?>

<div class="category_add_item"><div class="add_child"><div class="add_text"><a href="?task=add_page">Add a page</a></div><div class="add_icon" id="add_icon"><a href="?task=add_page"><img src="images/add.png" /></a></div></div></div><br />

<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">Page name</div><div class="manage_header_column3" id="load_image"></div></div>

<div id="page_container"><div id="thetop"></div>

<?php 

$query = mysql_query("SELECT * FROM ava_pages ORDER BY id DESC");

while ($go = mysql_fetch_array($query)) 
{

$url = PageUrl($go['id'], $go['seo_url']);

echo '
<div id="page-'.$go['id'].'" class="manage_item"><div class="manage_column0">'.$go['id'].'</div><div id="page-name-'.$go['id'].'" class="manage_column"><a href="'.$url.'" class="manage_link">'.$go['name'].'</a></div><div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div><div class="manage_column3" id="edit-image-'.$go['id'].'"><a href="?task=edit_page&id='.$go['id'].'"><img src="images/edit.png" width="24" height="24"></a></div>

<div id="edit-page-'.$go['id'].'" class="edit_game_container"></div>

</div>';

}

echo '</div>';

?>