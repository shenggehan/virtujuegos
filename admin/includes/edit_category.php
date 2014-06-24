<?php 
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();
include ('../../includes/core.php');
$id = $_POST['id'];
$q = mysql_query("SELECT * FROM ava_cats WHERE id=$id");
$r = mysql_fetch_array($q);
$category_name = htmlspecialchars($r['name']);
$tags = TagList($r['id'], ", ", 0);
?>
<div class="form_container">
<br />
<form id="form1" name="form1" method="post" action="includes/edit_category_submit.php">
<div class="form_element_container">
   <div class="form_lable">
   <label>Category name</label></div>
   <div class="form_element"><input class="text_box" name="category_name" type="text" id="category_name<?php echo $r['id'];?>" value="<?php echo $category_name;?>" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="text_area" name="category_description" id="category_description<?php echo $r['id'];?>"><?php echo $r['description'];?></textarea></div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>Keywords</label></div>
   <div class="form_element"><input class="text_box" name="category_keywords" type="text" id="category_keywords<?php echo $r['id'];?>" value="<?php echo $r['keywords'];?>" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Parent</label></div>
   <div class="form_element"><select name="parent_id" id="parent_id<?php echo $r['id'];?>">
   <?php 
   if ($r['parent_id'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   
   $cq = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order ASC");
   while($ca = mysql_fetch_array($cq)) {
	   if ($ca['id'] == $r['parent_id']) {
		  echo '<option value="'.$ca['id'].'" selected>'.$ca['name'].'</option>'; 
	   }
	   else if (($ca['id'] != $r['id']) && ($ca['parent_id'] == 0)) {
		   echo '<option value="'.$ca['id'].'">'.$ca['name'].'</option>'; 
	   }
   }?>
   </select></div>
</div>


<input name="id" type="hidden" value="<?php echo $r['id'];?>" id="id<?php echo $r['id'];?>" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit<?php echo $r['id'];?>" onclick="EditCategorySubmit('<?php echo $r['id'];?>');" /></div>
</form>
</div>