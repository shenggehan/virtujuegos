<?php 
if ($setting['facebook_on'] == 1) {
	if (isset($_GET['task']) && $_GET['task'] != 'facebook_register')
		include 'includes/ava_facebook.php';

	if ((isset($user['facebook']) && $user['facebook'] == 1) || ($user['login_status'] == 0)) {
		?>

		<div id="fb-root"></div>
		<script type="text/javascript">
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo $setting['facebook_appid'];?>', // App ID
          channelUrl : '//'+window.location.hostname+'/includes/facebook_channel.php', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

  		FB.Event.subscribe('auth.login', function() { 
			window.location = "<?php echo $setting['site_url'];?>/facebook_auth.php"
		});
		
		FB.Event.subscribe('auth.logout', function() { 
			window.location = "<?php echo $setting['site_url'];?>/login.php?action=logout"
		}); 

      } 
    </script>

<?php
	}
}
?>
<div id="current_task" style="display:none"><?php echo $_GET['task'];?></div>
<div class="notification" id="notification">
	<div class="notification_icon"></div>
	<div class="notification_message"></div>
	<div class="notification_quit" id="notification_quit">X</div>
</div>

<! AV Arcade Popup !>
<div id="ava-popup">
	<div id="ava-popup-header">
		<div id="ava-popup-title"></div>
		<div id="popup-close-button" onclick="HidePopup();"></div>
	</div>
	<div id="ava-popup-content"></div>
</div>
<div id="overlay"></div>
<div id="close_fs" class="close_fullscreen" onclick="ResetFlash()"><a href="#">
<?php 
if (defined("EXIT_FULLSCREEN")) 
	echo EXIT_FULLSCREEN;
else 
	echo 'Exit fullscreen';
?>
</a></div>