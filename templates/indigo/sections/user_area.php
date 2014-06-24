<?php	if ($user['login_status'] == 1) { // IF USER IS LOGGED IN ?>

<div class="ua_avatar">
	<a href="<?php echo $user['url'];?>"><img src="<?php echo $user['avatar'];?>" width="25" height="25" alt="Avatar" /></a>
</div>

<div class="ua_info">
	<div class="ua_username">
		<a href="<?php echo $user['url'];?>"><?php echo $user['username'];?></a>
	</div>
	<div class="ua_points">
		<?php echo $user['points'];?>
	</div>
	<div class="ua_notifications">
		<div class="ua_notifications_left">
			<a href="<?php echo $user['message_url'];?>"><img src="<?php echo $setting['site_url'].$setting['template_url'];?>/images/ua_messages.png" valign="center" /></a>
		</div> 
		<div class="ua_notifications_right">
			<a href="<?php echo $user['message_url'];?>"><?php echo $user['messages'];?></a>
		</div>
		<br style="clear:both" />
		<div class="ua_notifications_left">
			<a href="<?php echo $user['friends_url'];?>"><img src="<?php echo $setting['site_url'].$setting['template_url'];?>/images/ua_friends.png" valign="center" /></a>
		</div> 
		<div class="ua_notifications_right">
			<a href="<?php echo $user['friends_url'];?>"><?php echo $user['friend_requests'];?></a>
		</div>
	</div>
</div>

<div class="user_area_ddc">
	<div class="user_area_dropdown" id="user_area_dropdown">
		<div class="user_area_dropdown_top"></div>
		<div class="user_area_dropdown_main">
		<a href="<?php echo $user['url'];?>"><?php echo UA_PROFILE;?></a>
		
		<a href="<?php echo $user['friends_url'];?>"><?php echo $user['friends_anchor'];?></a>
	
		<a href="<?php echo $user['message_url'];?>"><?php echo UA_MESSAGES;?> (<?php echo $user['messages'];?>)</a>
	
		<?php if ($user['facebook'] == 1) { ?>
		<fb:login-button  autologoutlink="true"><?php echo FB_LOGOUT;?></fb:login-button>
		<?php } else { ?>
		<a href="<?php echo $setting['site_url'].'/login.php?action=logout';?>"><?php echo UA_LOGOUT;?></a>
		<?php } ?>
	
		<?php echo $user['admin_link'];?>
	</div></div></div>
<?php } else { ?>

<div class="ua_avatar">
	<img src="<?php echo $setting['site_url'].'/templates/hightek/images/anon.png';?>" width="25" height="25" alt="Anon" />
</div>

<div class="ua_info">
	<div class="ua_unregistered">
	<div class="ua_unregistered_info"><?php echo UA_UNREGISTERED;?></div>
		<a href="<?php echo $user['login_link'];?>"><?php echo UA_LOGIN;?></a> &nbsp;&nbsp;<a href="<?php echo $setting['site_url'].'/index.php?task=register';?>"><?php echo UA_REGISTER;?></a>
	</div>
</div>

<?php if ($setting['facebook_on'] == 1) { ?>
<div class="user_area_ddc">
	<div class="user_area_dropdown" id="user_area_dropdown">
		<div class="user_area_dropdown_top"></div>
		<div class="user_area_dropdown_main">
			&nbsp;&nbsp;&nbsp;<?php echo OPTIONAL_LOGIN;?><br />
			&nbsp;&nbsp;&nbsp;<fb:login-button  autologoutlink="true" perms="email,user_birthday,user_hometown,user_about_me,user_website"><?php echo FB_LOGIN;?></fb:login-button>
		</div>
	</div>
</div>
<?php } } ?>