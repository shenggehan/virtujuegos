<div class="add_game_form_container">
<br />
<form id="form1" name="form1" method="post" action="includes/edit_category_submit.php">
<div class="form_element_container">
   <div class="form_lable">
   <label>Category name</label></div>
   <div class="form_element"><input class="text_box" name="category_name" type="text" id="category_name0" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="text_area" name="category_description" id="category_description0"></textarea></div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>Keywords</label></div>
   <div class="form_element"><input class="text_box" name="category_keywords" type="text" id="category_keywords0" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Parent</label></div>
   <div class="form_element" id="refresh_category"><select name="parent_id" id="parent_id0">
   <?php 
   	    echo '<option value="0" selected>None</option>';
   $cq = mysql_query("SELECT * FROM ava_cats WHERE parent_id = 0 ORDER BY cat_order ASC");
   while($ca = mysql_fetch_array($cq)) {
		   echo '<option value="'.$ca['id'].'">'.$ca['name'].'</option>'; 
   }?>
   </select></div>
</div>


<input name="id" type="hidden" value="0" id="id0" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="EditCategorySubmit('0');" /></div>
</form>
</div>