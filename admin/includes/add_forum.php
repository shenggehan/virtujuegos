<div class="add_game_form_container">
<br />
<form id="edit_forum_0" name="edit_forum_0">
<div class="form_element_container">
   <div class="form_lable">
   <label>Forum name</label></div>
   <div class="form_element"><input class="text_box" name="forum_name" type="text" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="text_area" name="forum_description" ></textarea></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Parent forum</label></div>
   <div class="form_element" id="refresh_forums">
	   <select name="parent_forum">
			<option value="0">No parent</option>
			<?php ForumsDropdown(0);?>
		</select>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Read-only</label></div>
   <div class="form_element">
   		<input type="checkbox" name="read_only" value="1">
   </div>
</div>

<input name="id" type="hidden" value="0" id="id0" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="EditForumSubmit('0');" /></div>
</form>
</div>