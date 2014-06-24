<?php	if ($user['login_status'] == 1) { // IF USER IS LOGGED IN ?>

<div class="ua_avatar">
	<a href="<?php echo $user['url'];?>"><img src="<?php echo $user['avatar'];?>" width="40" height="40" alt="Avatar" /></a>
</div>

<div class="ua_info">
	<div class="ua_username">
		<a href="<?php echo $user['url'];?>"><?php echo $user['username'];?></a>
	</div>
	<div class="ua_points">
		<?php echo $user['points'];?>
	</div>
	<br style="clear:both"/>
	
	<a href="<?php echo $user['friends_url'];?>"><?php echo $user['friends_anchor'];?></a> 
	
	&nbsp;<a href="<?php echo $user['message_url'];?>"><?php echo UA_MESSAGES;?></a> (<?php echo $user['messages'];?>)&nbsp;
	
	<?php if ($user['facebook'] == 1) { ?>
	<fb:login-button  autologoutlink="true"><?php echo FB_LOGOUT;?></fb:login-button>
	<?php } else { ?>
	<a href="<?php echo $setting['site_url'].'/login.php?action=logout';?>"><?php echo UA_LOGOUT;?></a>
	<?php } ?>
	
	 &nbsp;<?php echo $user['admin_link'];?>
	
</div>
<?php } else { ?>

<div class="ua_avatar">
	<img src="<?php echo $setting['site_url'].'/templates/hightek/images/anon.png';?>" width="40" height="40" alt="Anon" />
</div>

<div class="ua_info">
	<div class="ua_unregistered"><?php echo UA_UNREGISTERED;?></div>
	<a href="<?php echo $user['login_link'];?>"><?php echo UA_LOGIN;?></a> &nbsp;<a href="<?php echo $setting['site_url'].'/index.php?task=register';?>"><?php echo UA_REGISTER;?></a>
	
	<?php if ($setting['facebook_on'] == 1) { ?>
	 &nbsp;<fb:login-button  autologoutlink="true" scope="email,user_birthday,user_hometown,user_about_me,user_website"><?php echo FB_LOGIN;?></fb:login-button>
	<?php } ?>
</div>

<?php } ?>