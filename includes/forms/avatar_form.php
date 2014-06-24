<?php defined( 'AVARCADE_' ) or die( '' ); // Security ?>

<div class="edit_profile_header"><?php echo EP_EDIT_AVATAR;?></div>
<div class="edit_avatar_container">
<div class="edit_profile_lable"><img src="<?php echo $user['avatar'];?>" width="75" height="75"></div>
<div class="edit_avatar_element">
<form enctype="multipart/form-data" id="form1" method="post" action="?task=edit_profile&done=avatar">
    <input name="new_id" type="hidden" id="new_id" value="<?php echo $new_id;?>" />
    <span class="style1"><?php echo EP_AVATAR_UP;?></span><br />
    <input name="img_file" type="file" id="img_file" size="50" /> <input type="Submit" name="Submit" value="<?php echo EP_AVATAR_BUTTON;?>"/><br />
    <?php echo EP_AVATAR_RESTRICTIONS;?>
    </p>
  </p>
</form>
</div>
</div>