<?php if ($login_status != 1) exit(); ?>

<div class="category_add_item"><div class="add_child"><div class="add_text"><a href="?task=add_advert">Add an advert</a></div><div class="add_icon" id="add_icon"><a href="?task=add_advert"><img src="images/add.png" /></a></div></div></div><br />

<div class="manage_header"><div class="manage_header_column">Advert name (Times used)</div><div class="manage_header_column3" id="load_image"></div></div>

<div id="advert_container"><div id="thetop"></div>

<?php 

$query = mysql_query("SELECT * FROM ava_adverts ORDER BY id ASC");

while ($go = mysql_fetch_array($query)) 
{

if ($setting['default_ad'] == $go['id']) {
	$times_used = 'Sitewide default';
}
else {
	$times_used = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE advert_id=$go[id]"),0);
}
if ($go['id'] != 1) {
echo '
<div id="advert-'.$go['id'].'" class="manage_item"><div id="advert-name-'.$go['id'].'" class="manage_column">'.$go['ad_name'].' ('.$times_used.')</div><div class="manage_column3" id="delete-image-'.$go['id'].'">';


 echo '<img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');">';


echo '</div><div class="manage_column3" id="edit-image-'.$go['id'].'"><a href="?task=edit_advert&id='.$go['id'].'"><img src="images/edit.png" width="24" height="24"></a></div>

<div id="edit-advert-'.$go['id'].'" class="edit_game_container"></div>

</div>';
}
}

echo '</div>';

?>