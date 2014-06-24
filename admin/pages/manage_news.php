<?php if ($login_status != 1) exit(); ?>

<div class="category_add_item"><div class="add_child"><div class="add_text"><a href="?task=add_news">Add news</a></div><div class="add_icon" id="add_icon"><a href="?task=add_news"><img src="images/add.png" /></a></div></div></div><br />

<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">news name</div><div class="manage_header_column3" id="load_image"></div></div>

<div id="news_container"><div id="thetop"></div>

<?php 

$query = mysql_query("SELECT * FROM ava_news ORDER BY id DESC");

while ($go = mysql_fetch_array($query)) 
{

$url = NewsUrl($go['id'], $go['seo_url']);

echo '
<div id="news-'.$go['id'].'" class="manage_item"><div class="manage_column0">'.$go['id'].'</div><div id="news-name-'.$go['id'].'" class="manage_column"><a href="'.$url.'" class="manage_link">'.$go['title'].'</a></div><div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div><div class="manage_column3" id="edit-image-'.$go['id'].'"><a href="?task=edit_news&id='.$go['id'].'"><img src="images/edit.png" width="24" height="24"></a></div>

<div class="manage_column3"  id="comments-image-'.$go['id'].'"><img src="images/comments.gif" width="24" height="24" onclick="gotourl(\'index.php?task=manage_news_comments#page=1&id='.$go['id'].'\')"></div>

<div id="edit-news-'.$go['id'].'" class="edit_game_container"></div>

</div>';

}

echo '</div>';

?>