<?php
include('includes/forms/avatar_form.php');
echo '<div class="edit_profile_header">'.EP_TITLE.'</div>
<div class="edit_info_container">
<form id="form1" name="form1" method="post" action="index.php?task=edit_profile">
	'.EP_LOCATION.':<br />
	<input name="location" type="text" id="location" class="edit_profile_textbox" value="'.$profile_info['location'].'" size="30" /><br /><br />
	'.EP_INTERESTS.':<br />
	<textarea name="interests" cols="30" id="interests" class="edit_profile_textarea">'.$profile_info['interests'].'</textarea><br /><br />
	'.EP_ABOUT.':<br />
	<textarea name="about" cols="30" id="about" class="edit_profile_textarea">'.$profile_info['about'].'</textarea><br /><br />
	'.EP_WEBSITE.':<br />         
	<input name="website" type="text" id="website" class="edit_profile_textbox" value="'.$profile_info['website'].'" size="30" /><br /><br />
	'.LP_BUTTON2.':<br />         
	<input name="new_password" id="new_password" class="edit_profile_textbox" size="30" type="password" />';
	
	if ($setting['forums_installed'] == 1) {
		echo '<br /><br /><div class="edit_profile_header">'.SIGNATURE_SETTINGS.'</div>'; 
	?>
		<div class="sig_editor"><div id="idwrapperelem"></div></div>
		<script>
			var bbcode = MensoBBCode( {
				wrapper: "idwrapperelem", bbcodes: {
			'b': { 'label': '', 'title': BB_BOLD }
			, 'i': { 'label': '', 'title': BB_ITALICS }
			, 'u': { 'label': '', 'title': BB_UNDERLINE }
			, 'font': { 'label': '', 'title': BB_FONT }
			, 'size': { 'label': '', 'title': BB_SIZE }
			, 'color': { 'label': '', 'title': BB_COLOUR }
			, 'img': {'label': '', 'title': BB_IMAGE, 'popup': true }
			, 'url': { 'label': '', 'title': BB_LINK, 'popup': true }
			, 'align': { 'label': '', 'title': BB_ALIGN }
			, 'quote': { 'label': '', 'title': BB_QUOTE }
			, 'code': { 'label': '', 'title': BB_CODE }
			 }
		 } );
		 bbcode.insertFromOutside (<?php echo json_encode($profile_info['forum_signature']);?>); 
		</script>
	<?php }
	
	
	if ($setting['email_notifications'] == 1) {
		echo '<br /><div class="edit_profile_header">'.EMAIL_SETTINGS.'</div><br />
		'.ES_NEW_MESSAGE.':<br />';         

		if ($profile_info['email_new_message'] == 1) { 
			echo '<input name="email_new_message" type="radio" value="1" checked="checked" /> On 
			<input name="email_new_message" type="radio" value="0" /> Off';
		}
		else {
			echo'<input name="email_new_message" type="radio" value="1" /> On 
        	<input name="email_new_message" type="radio" value="0" checked="checked" /> Off';
		}
	
		echo '<br /><br />'.ES_FRIEND_REQUEST.':<br />';         
	
		if ($profile_info['email_friend_request'] == 1) { 
			echo '<input name="email_friend_request" type="radio" value="1" checked="checked" /> On 
			<input name="email_friend_request" type="radio" value="0" /> Off';
		}
		else {
			echo'<input name="email_friend_request" type="radio" value="1" /> On 
       	 	<input name="email_friend_request" type="radio" value="0" checked="checked" /> Off';
		}

		echo '<br /><br />'.ES_HIGHSCORE_CHALLENGE.':<br />';         
	
		if ($profile_info['email_highscore_challenge'] == 1) { 
			echo '<input name="email_highscore_challenge" type="radio" value="1" checked="checked" /> On 
			<input name="email_highscore_challenge" type="radio" value="0" /> Off';
		}
		else {
			echo'<input name="email_highscore_challenge" type="radio" value="1" /> On 
        	<input name="email_highscore_challenge" type="radio" value="0" checked="checked" /> Off';
		}
	}
           
     echo '<br /><br />
	<input type="submit" name="Submit" value="'.EP_BUTTON.'" class="profile_submit_button" />
</form></div>';
?>