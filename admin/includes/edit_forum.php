<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

include ('../../avforums/forum_core.php');

$forum = mysql_fetch_array(mysql_query("SELECT * FROM ava_forums WHERE id = $_POST[id]"));
?>

<div class="add_game_form_container">
<br />
<form id="edit_forum_<?php echo $forum['id'];?>" name="edit_forum_<?php echo $forum['id'];?>">
<div class="form_element_container">
   <div class="form_lable">
   <label>Forum name</label></div>
   <div class="form_element"><input class="text_box" name="forum_name" type="text" value="<?php echo $forum['name'];?>" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="text_area" name="forum_description"><?php echo $forum['description'];?></textarea></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Parent forum</label></div>
   <div class="form_element" id="refresh_category">
	   <select name="parent_forum">
			<option value="0">No parent</option>
			<?php ForumsDropdown($forum['parent_id']);?>
		</select>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Read-only</label></div>
   <div class="form_element">
   <?php if ($forum['read_only'] == 1) {
   		echo '<input type="checkbox" name="read_only" value="1" checked="checked">';
   	}
   	else {
   		echo '<input type="checkbox" name="read_only" value="1">';
   	}
   	?>
   </div>
</div>

<input name="id" type="hidden" value="<?php echo $forum['id'];?>" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="EditForumSubmit('<?php echo $forum['id'];?>');" /></div>
</form>
</div>