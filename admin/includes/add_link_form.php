
<div class="add_game_form_container">
<form id="form1" name="form1" method="post" action="includes/edit_link_submit.php">

<div class="form_element_container">
   <div class="form_lable"><label>Anchor</label></div>
   <div class="form_element"><input class="text_box" name="1" type="text" id="link_name0"/></div>
</div>
  
<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><input class="text_box" name="2" type="text" id="link_description0"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>URL</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="link_url0"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Sitewide</label></div>
   <div class="form_element">
     <label>
       <input type="checkbox" name="sitewide" id="sitewide0" checked="checked" />
     </label>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Published</label></div>
   <div class="form_element">
     <label>
       <input type="checkbox" name="published" id="published0" checked="checked" />
     </label>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>Submitter ID</label></div>
   <div class="form_element"><input class="text_box_id" name="submitter" type="text" id="submitter0"/></div>
</div>

<input name="id" type="hidden" value="0" id="id0" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="SubmitLink(0);" /><br /></div>
</form>
</div>