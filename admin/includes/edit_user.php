<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();
$sql = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=$_POST[id]"));
?>
<div class="add_game_form_container">
<form id="form1" name="form1" method="post" action="includes/edit_link_submit.php">

<div class="user_form_element_container">
   <div class="user_form_lable">
     <label>Username</label></div>
   <div class="form_element"><input class="text_box" name="1" type="text" id="username<?php echo $_POST['id'];?>" value="<?php echo $sql['username'];?>"/></div>
</div>
  
<div class="user_form_element_container">
   <div class="user_form_lable"><label>E-mail</label></div>
   <div class="form_element"><input class="text_box" name="2" type="text" id="email<?php echo $_POST['id'];?>" value="<?php echo $sql['email'];?>"/></div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable">
   <label>Location</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="location<?php echo $_POST['id'];?>" value="<?php echo $sql['location'];?>"/></div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable"><label>About</label></div>
   <div class="form_element"><textarea name="game_description" rows="2" class="text_area" id="about<?php echo $_POST['id'];?>" ><?php echo $sql['about'];?></textarea></div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable">
   <label>Website</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="website<?php echo $_POST['id'];?>" value="<?php echo $sql['website'];?>"/></div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable">
   <label>Points</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="points<?php echo $_POST['id'];?>" value="<?php echo $sql['points'];?>"/></div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable">
   <label>Avatar image</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="avatar<?php echo $_POST['id'];?>" value="<?php echo $sql['avatar'];?>"/></div>
</div>

<?php if ($setting['forums_installed'] == 1) { ?>
<div class="user_form_element_container">
   <div class="user_form_lable"><label>Forum signature</label></div>
   <div class="form_element"><textarea name="forum_sig" rows="2" class="text_area" id="forum_signature<?php echo $_POST['id'];?>" ><?php echo $sql['forum_signature'];?></textarea></div>
</div>
<?php } ?>

<div class="user_form_element_container">
   <div class="user_form_lable">
   <label>New Password</label></div>
   <div class="form_element"><input class="text_box" name="3" type="text" id="password<?php echo $_POST['id'];?>" value=""/></div>
</div>

<?php 
if ($sql['admin'] == 1) {
	$admin_checked = 'checked';
}
else {
	$admin_checked = '';
}
if ($sql['activate'] == 1) {
	$active_checked = 'checked';
}
else {
	$active_checked = '';
}
?>
<div class="user_form_element_container">
   <div class="user_form_lable"><label>Active</label></div>
   <div class="form_element">
     <label>
       <input type="checkbox" name="active" id="active<?php echo $_POST['id'];?>" <?php echo $active_checked;?> />
     </label>
   </div>
</div>

<div class="user_form_element_container">
   <div class="user_form_lable"><label>Admin</label></div>
   <div class="form_element">
     <label>
       <input type="checkbox" name="admin" id="admin<?php echo $_POST['id'];?>" <?php echo $admin_checked;?> />
     </label>
   </div>
</div>

<input name="id" type="hidden" value="<?php echo $_POST['id'];?>" id="id<?php echo $_POST['id'];?>" />
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit<?php echo $_POST['id'];?>" onclick="SubmitUser(<?php echo $_POST['id'];?>);" /><br /></div>
</form>
</div>