<?php
echo '
<div class="search_game">
	<div class="category_game_image">
		<a href="'.$game['url'].'"><img src="'.$game['image_url'].'" height="70" width="70" alt="'.$game['name'].'" /></a>
	</div> 

	<div class="category_game_info">
		<div class="category_game_head">
			<a href="'.$game['url'].'">'.$game['name'].'</a> '.$game['highscore_image'].'
		</div>
		'.$game['description'].'
		<div class="category_game_options">'.$game['plays'].' '.GAME_PLAYS.' &nbsp;'.GAME_RATING.': '.$game['rating_value'].' &nbsp;'.$game['admin_edit'].'</div>
	</div>
	<br style="clear:both" />
</div>';
?>