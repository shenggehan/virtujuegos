<?php include('header.php'); ?>

<div class="content">
	<div class="game_header">
		<div class="game_header_image">
			<img src="<?php echo $game['image_url'];?>" width="55" height="55" alt="Game image" />
		</div>
		<div class="game_header_left">
			<div class="game_header_text">
				<span class="game_title"><?php echo $game['name'];?></span>
				
				<br />
				<div class="game_info_column1">
					<?php echo GAME_RATING;?>:
				</div> 
				<div class="game_info_column2">
					<?php echo $game['rating_image'];?>
				</div> 
				<div class="game_info_column1">
					&nbsp;<?php echo GAME_YOUR_RATING;?>: 
				</div>
				<div class="game_info_column2">
					<?php echo $game['new_rating_form'];?>
				</div> 
				<div class="game_info_column1">
					&nbsp; <?php echo GAME_TIMES_PLAYED;?>: <?php echo $game['plays'].' &nbsp;'.$game['admin_options'];?>
				</div>
			</div>
		</div>
		<div class="game_header_right">
			<div class="button2">
				<div class="button2_fav">
					<?php echo $game['fav_game'];?>
				</div>
			</div>
			<div class="button2">
				<div class="button2_fs">
					<a href="<?php echo $game['full_screen_url'];?>"><?php echo GAME_FULL_SCREEN;?></a>
				</div>
			</div>
		</div>
		<br style="clear:both;" />
	</div>

	<div class="game_container">
		<?php include (  './includes/view_game/game.inc.php'  ); // Include the flash game ?>
		
		<?php echo $game['game_message'];?>
		
		<?php if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) { 
							echo $game['report_game'];
						} ?>
		
	</div>
	<div class="game_info_left">
		<div class="game_description_head">
			<?php echo GAME_DESCRIPTION;?>
		</div>
	<div class="game_description">
		<?php echo $game['description'];
		echo '<br /><br />'.GAME_ADDED.': '.$game['date_added'];
		?>
	</div>
	<?php if ($game['instructions'] != '') { ?>
	<div class="game_description_head">
		<?php echo GAME_INSTRUCTIONS;?>
	</div>
	<div class="game_description">
		<?php echo $game['instructions'];?>
	</div>
	<?php } ?>
	<div class="game_description_head">
		<?php echo GAME_TAGS;?>
	</div>
	<div class="game_description">
		<?php echo $game['tags'];?>
	</div>
	<?php 
	if ($game['submitter'] != 0) {
		echo '<div class="game_description_head">
				'.GAME_SUBMITTER.':
			</div> 
			<div class="game_description">
				<a href="'.$game['submitter_url'].'">'.$game['submitter_name'].'</a>
			</div>';
	} 
	if ($setting['add_to_site'] == 1) {
		echo '<div class="game_description_head">'.GAME_EMBED.':</div><div class="game_description">';
		include (  './includes/view_game/embed_game.inc.php'  ); // Include comments
		echo '</div>'; 
	}
	?>
	</div>
	<div class="game_highscores">
		<?php if ($game['highscores'] == 1) { ?>
		<div class="game_highscores_header"><?php echo GAME_HIGHSCORES;?></div>
		<div id="highscores_ajax">
		<?php include (  './includes/view_game/highscores.inc.php'  ); // Include highscores ?>
		</div>
		<?php } ?>
		<div class="social_container">
		<?php include './includes/view_game/social_icons.inc.php'; ?>
	</div>
	</div>
	<br style="clear:both" />

	<div class="comment_header">
		<?php echo GAME_COMMENTS;?>
	</div>
	<div class="new_comment_container">
		<?php echo GAME_ADD_A_COMMENT;?>:
		<?php include (  './includes/forms/add_comment_form.php'  ); // Include comments ?>
	</div>
	<?php include (  './includes/view_game/game_comments.inc.php'  ); // Include comments ?>

	<div class="comment_header">
		<?php echo GAME_MORE_GAMES;?>
	</div>
	<?php include (  './includes/view_game/random_games.inc.php'  ); // Include random games ?>
	<br style="clear:both" />
</div>

<?php include('footer.php'); ?>