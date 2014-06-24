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
		'.$game['description'].' '.$game['admin_edit'].'
	</div>
	<br style="clear:both" />
</div>';
?>