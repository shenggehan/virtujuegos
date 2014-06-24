<?php
echo '
<div class="homepage_game">
	<div class="home_game_image">
		<a href="'.$game['url'].'"><img src="'.$game['image_url'].'" height="65" width="65" alt="'.$game['name'].'" /></a>
	</div> 

	<div class="home_game_info">
		<div class="home_game_head">
			<a href="'.$game['url'].'">'.$game['name'].'</a> '.$game['highscore_image'].'
		</div>
		'.$game['description'].'
		<div class="home_game_options">'.$game['plays'].' '.GAME_PLAYS.' &nbsp;'.GAME_RATING.': '.$game['rating_value'].' &nbsp;'.$game['admin_edit'].'</div>
	</div>
	<br style="clear:both" />
</div>';
?>