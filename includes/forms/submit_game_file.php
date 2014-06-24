<div class="submit_form">
<form id="form1" name="form1" method="post" action="<?php echo $setting['site_url'];?>/index.php?task=submit&id=<?php echo $submission_id;?>" enctype="multipart/form-data">
  
<div class="submit_form_element_container">
   <div class="submit_form_lable"><label><?php echo SUBMIT_FILE;?> *</label></div>
   <div class="submit_form_element">
      <input type="file" name="file" id="file" /> 
      <br /><?php echo SUBMIT_FILE_MESSAGE;?>
   </div>
</div>

<input name="id" type="hidden" value="0" id="id0" />
<div class="submit_button_container"><input class="submit_button" name="Submit" type="submit" value="<?php echo SUBMIT;?>" id="submit0" /></div>
</form>
</div>