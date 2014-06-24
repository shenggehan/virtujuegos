<?php
echo '
<div class="homepage_game">
	<div class="home_game_image">
		<a href="'.$featured_game['url'].'"><img src="'.$featured_game['image_url'].'" height="60" width="60" alt="'.$featured_game['name'].'" /></a>
	</div> 

	<div class="home_game_info">
		<div class="home_game_head">
			<a href="'.$featured_game['url'].'">'.$featured_game['name'].'</a> '.$featured_game['highscore_image'].'
		</div>
		'.$featured_game['description'].'
		<div class="home_game_options"><img class="home_game_options_icon" src="'.$setting['site_url'].'/templates/hightek/images/joystick-icon.png" />'.$featured_game['plays'].' &nbsp;'.$featured_game['rating'].' &nbsp;'.$featured_game['admin_edit'].'</div>
	</div>
	<br style="clear:both" />
</div>';
?>