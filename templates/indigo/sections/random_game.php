<?php
echo '
<div class="random_game">
	<div class="random_game_image">
		<a href="'.$random_game['url'].'"><img src="'.$random_game['image_url'].'" height="80" width="80" alt="'.$random_game['name'].'" /></a>
	</div> 

	<div class="random_game_info">
		<div class="random_game_head">
			<a href="'.$random_game['url'].'">'.$random_game['name'].'</a> '.$random_game['highscore_image'].'
		</div>
		'.$random_game['description'].' '.$random_game['admin_edit'].' 
	</div>
</div>';
?>