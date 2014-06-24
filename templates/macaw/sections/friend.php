<?php
// Friend template for the friends page
// Must have the main container id set as friend'.$friend['id'].' and the buttons id set as friend_buttons'.$friend['id'].'

echo '
<div class="friend_container" id="friend'.$friend['id'].'">
	<div class="friend_avatar">
		<img src="'.$friend['avatar_url'].'" width="50" height="50" />
	</div>

	<div class="friend_username">
		<a href="'.$friend['url'].'">'.$friend['username'].'</a><br />
		<div class="friend_last_login">'.LAST_ACTIVITY.': '.$friend['last_activity'].'</div>
	</div>
	
	<div class="friend_buttons" id="friend_buttons'.$friend['id'].'">
		'.$friend['buttons'].'
	</div>
</div>
';

?>