<?php	if ($user['login_status'] == 1) { // IF USER IS LOGGED IN ?>

<div class="member_login">
	       <div class="avatarBOX">
	       <a href="<?php echo $user['url'];?>"><img class="avatarIMG" src="<?php echo $user['avatar'];?>" alt="Avatar" /></a>
	       </div>
	           <p class="member_title">Bienvenido, <?php echo $user['username'];?></p><span style="float:left; margin: 0 0 0 10px; color: #8f2800; background-color: #fff000; padding: 2px 5px; font: 11px arial;"><?php echo $user['points'];?></span>
	           <?php if ($user['admin'] == 1) { ?>
	           <p class="admin_button"><?php echo $user['admin_link'];?></p>
	           <?php } ?>
	         <div style="float:left; width: 400px; margin: 0 0 0 5px;">
	           <p class="member_log_buttons"><a href="<?php echo $user['message_url'];?>"><?php echo UA_MESSAGES;?> (<?php echo $user['messages'];?>)</a></p>
	           <p class="member_log_buttons"><a href="<?php echo $user['friends_url'];?>"><?php echo $user['friends_anchor'];?></a></p>
	           <p class="member_log_buttons"><a href="<?php echo $user['url'];?>">Perfil Usuario</a></p>
	           <?php if ($user['facebook'] == 1) { ?>
	<p class="member_log_buttons"><fb:login-button  autologoutlink="true"><?php echo FB_LOGOUT;?></fb:login-button></p>
	<?php } else { ?>
	<p class="member_log_buttons"><a href="<?php echo $setting['site_url'].'/login.php?action=logout';?>"><?php echo UA_LOGOUT;?></a></p><?php } ?>

	         </div> 
	     </div>    


<?php } else { ?>

<div class="member_guest">
	       <div class="avatarBOX">
	       <img class="avatarIMG" src="<?php echo $setting['site_url'].'/templates/macaw/images/anon.png';?>" alt="" />
	       </div>
	         <div style="float:left; width: 300px;">
	           <p class="member_title" style="width: 280px;"><?php echo UA_UNREGISTERED;?></p>
	           <p class="member_buttons"><a href="<?php echo $user['login_link'];?>"><?php echo UA_LOGIN;?></a></p>
	           <p class="member_buttons"><a href="<?php echo $setting['site_url'].'/index.php?task=register';?>"><?php echo UA_REGISTER;?></a></p>
	           <?php if ($setting['facebook_on'] == 1) { ?>
	<div style="margin-top: 11px; overflow: hidden; height:35px;" class="member_buttons"><fb:login-button  autologoutlink="true" perms="email,user_birthday,user_hometown,user_about_me,user_website,publish_stream"><?php echo FB_LOGIN;?></fb:login-button></div>
	<?php } ?>
	         </div> 
	         <a href="<?php echo $setting['site_url'].'/index.php?task=register';?>"><img class="signup" src="<?php echo $setting['site_url'].'/templates/macaw/images/signup.png';?>" alt="Signup for free!" /></a>
	     </div>


<?php } ?>