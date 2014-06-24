<form id="form1" name="form1" method="post" action="">
<div class="form_element_container">
   <div class="form_lable">
   <label>Game name</label></div>
   <div class="form_element"><input class="text_box" name="game_name" type="text" id="game_name" /></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><textarea class="text_area" name="description" id="game_description"></textarea></div>
</div>
  
<div class="form_element_container">
   <div class="form_lable"><label>File</label></div>
   <div class="form_element">
      <a href="#" onclick="file_selector(3);return false" id="enter_url_link" class="bold">Enter URL</a> | <a href="#" onclick="file_selector(2);return false" id="select_link">Select from games folder</a> | <a href="#" onclick="file_selector(1);return false" id="upload_link">Upload file</a>
      <div id="file_selection"><input name="url" type="text" class="text_box" /></div>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Image</label></div>
   <div class="form_element">
      <a href="#" onclick="image_selector(3);return false" id="enter_url_link_image" class="bold">Enter URL</a> | <a href="#" onclick="image_selector(2);return false" id="select_link_image">Select from images folder</a> | <a href="#" onclick="image_selector(1);return false" id="upload_link_image">Upload image</a>
      <div id="image_selection"><input name="url" type="text" class="text_box" /></div>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Category</label></div>
   <div class="form_element"><select name="category">
     <option>Arcade</option>
     <option>Action</option>
     <option>Adventure</option>
     <option>Racing</option>
     <option>Shooter</option>
   </select></div>
</div>
<div class="button_container"><input class="button" name="Submit" type="submit" value="Submit" /></div>
</form>