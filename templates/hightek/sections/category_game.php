<?php
echo '
<div class="homepage_game">
	<div class="home_game_image">
		<a href="'.$game['url'].'"><img src="'.$game['image_url'].'" height="60" width="60" alt="'.$game['name'].'" /></a>
	</div> 

	<div class="home_game_info">
		<div class="home_game_head">
			<a href="'.$game['url'].'">'.$game['name'].'</a> '.$game['highscore_image'].'
		</div>
		'.$game['description'].'
		<div class="home_game_options"><img class="home_game_options_icon" src="'.$setting['site_url'].'/templates/hightek/images/joystick-icon.png" />'.$game['plays'].' &nbsp;'.$game['rating'].' &nbsp;'.$game['admin_edit'].'</div>
	</div>
	<br style="clear:both" />
</div>';
?>