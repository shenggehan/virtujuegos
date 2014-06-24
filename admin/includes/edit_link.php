<?php
require_once '../../config.php';
require_once '../../includes/core.php';
include '../secure.php';
if ($login_status != 1) exit();
$row = mysql_query("SELECT * FROM ava_links WHERE id='".$_POST['id']."'");	
$values = mysql_fetch_array($row);
?>
<div class="form_container"><br />
<form id="form1" name="form1" method="post" action="includes/edit_link_submit.php">

<div class="form_element_container">
   <div class="form_lable"><label>Anchor</label></div>
   <div class="form_element"><input class="text_box" name="1" type="text" id="link_name<?php echo $_POST['id'];?>" value="<?php echo htmlspecialchars($values['name']);?>"/></div>
</div>
  
<div class="form_element_container">
   <div class="form_lable"><label>Description</label></div>
   <div class="form_element"><input class="text_box" name="2" type="text" id="link_description<?php echo $_POST['id'];?>" value="<?php echo htmlspecialchars($values['description']);?>"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>URL</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="link_url<?php echo $_POST['id'];?>" value="<?php echo $values['url'];?>"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Sitewide</label></div>
   <div class="form_element">
     <label>
     <?php if ($values['sitewide'] == 1) { ?>
       <input type="checkbox" name="sitewide" id="sitewide<?php echo $_POST['id'];?>" checked="checked" />
     <?php } else { ?>
     	<input type="checkbox" name="sitewide" id="sitewide<?php echo $_POST['id'];?>" />
     <?php } ?>	
     </label>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Published</label></div>
   <div class="form_element">
     <label>
     <?php if ($values['published'] == 1) { ?>
       <input type="checkbox" name="published" id="published<?php echo $_POST['id'];?>" checked="checked" />
     <?php } else { ?>
     	<input type="checkbox" name="published" id="published<?php echo $_POST['id'];?>" />
     <?php } ?>	
     </label>
   </div>
</div>

<div class="form_element_container">
   <div class="form_lable">
   <label>Submitter ID</label></div>
   <div class="form_element"><input class="text_box_id" name="submitter" type="text" id="submitter<?php echo $_POST['id'];?>" value="<?php echo $values['submitter'];?>"/>
   <?php
		if ($values['submitter'] != 0) {
			$link_submitter = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id = $values[submitter] LIMIT 1"));
			echo ' &nbsp;Registered user: <a href="'.ProfileUrl($link_submitter['id'], $link_submitter['seo_url']).'">'.$link_submitter['username'].'</a>';
			
		}
		else if ($values['submitter'] == 0 && $values['submitter_email'] != '') {
			echo ' &nbsp;Unregistered user email: <a href="mailto:'. $values['submitter_email'].'">'. $values['submitter_email'].'</a>';
			
		}
   ?>   
   </div>
</div>

<input name="id" type="hidden" value="0" id="id<?php echo $_POST['id'];?>" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit<?php echo $_POST['id'];?>" onclick="SubmitLink(<?php echo $_POST['id'];?>);" /><br /></div>
</form>
</div>