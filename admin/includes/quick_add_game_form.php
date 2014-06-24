<div class="add_game_form_container">
<form id="form1" name="form1" method="post" action="includes/edit_game_submit.php">
<div class="quick_form_element_container">
   <div class="quick_form_lable">
   <label>Game name</label></div>
   <div class="form_element"><input class="qa_text_box" name="game_name" type="text" id="game_name0"/></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="qa_text_area" name="game_description" id="game_description0"></textarea></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>How to play</label></div>
   <div class="form_element"><textarea class="qa_text_area" name="game_instructions" id="game_instructions0"></textarea></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable">
   <label>Tags</label></div>
   <div class="form_element"><input class="qa_text_box" name="game_tags" type="text" id="game_tags0"/></div>
</div>
  
<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>File</label></div>
   <div class="form_element">
      <a href="#" onclick="file_selector(3, 0, 0);return false" id="enter_url_link0" class="bold">Enter URL</a> | <a href="#" onclick="file_selector(2, 0, 0);return false" id="select_link0">Select from folder</a> | <a href="#" onclick="file_selector(1, 0, 0);return false" id="upload_link0">Upload file</a> | <a href="#" onclick="file_selector(4, 0, 0);return false" id="grab_link0">Grab</a> | <a href="#" onclick="file_selector(5, 0, 0);return false" id="file_html_code0">HTML</a>
      <div id="file_selection0"><input name="url" type="text" class="qa_text_box" id="url0" /></div>
   </div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Image</label></div>
   <div class="form_element">
      <a href="#" onclick="image_selector(3, 0, 0);return false" id="enter_url_link_image0" class="bold">Enter URL</a> | <a href="#" onclick="image_selector(2, 0, 0);return false" id="select_link_image0">Select from folder</a> | <a href="#" onclick="image_selector(1, 0, 0);return false" id="upload_link_image0">Upload image</a> | <a href="#" onclick="image_selector(4, 0, 0);return false" id="grab_link_image0">Grab</a>
      <div id="image_selection0"><input name="url" type="text" class="qa_text_box" id="img0" /></div>
   </div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Dimensions</label></div>
   <div class="form_element"><input name="width" type="text" class="text_box_dimensions" id="width0" size="3" /> x <input name="height" type="text" class="text_box_dimensions" id="height0" size="3" /> (<a href="#" onclick="GetDimensions(0);return false">Auto</a>)
   </div></div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Category</label></div>
   <div class="form_element"><select name="category" id="category0">
   <?php $cq = mysql_query("SELECT * FROM ava_cats ORDER BY name ASC");
   while($ca = mysql_fetch_array($cq)) {
		   echo '<option value="'.$ca['id'].'">'.$ca['name'].'</option>'; 
   }?>
   </select></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Advert</label></div>
   <div class="form_element"><select name="advert" id="advert0">
   <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY id ASC");
    echo '<option value="0">None</option><option value="1" selected>Sitewide default</option>';
	while($ca = mysql_fetch_array($cq)) {
		if ($ca['id'] != 1)	
		   echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
   }?>
   </select></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Highscores</label></div>
   <div class="form_element">
   		<input type="checkbox" name="highscores" value="1" id="highscores0">
   </div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable">
   <label>Mochi ID</label></div>
   <div class="form_element"><input class="qa_text_box" name="mochi_id" type="text" id="mochi_id0" value=""/></div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable"><label>Published</label></div>
   <div class="form_element">
   		<input type="checkbox" name="published" value="1" id="published0" checked="checked">
   </div>
</div>

<div class="quick_form_element_container">
   <div class="quick_form_lable">
   <label>Submitter ID</label></div>
   <div class="quick_form_element"><input class="text_box_id" name="submitter" type="text" id="submitter0" /></div>
</div>

<input name="id" type="hidden" value="0" id="id0" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="SubmitGame(0);" /></div>
</form>
</div>