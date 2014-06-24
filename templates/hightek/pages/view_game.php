<?php include('header.php'); ?>
<div class="title">
	<?php include (  './includes/modules/content_title.php'  ); // Include the page title ?>
</div>

<div class="game_container">
	<div class="game_options">
		<div class="game_options_column1">
			<?php echo GAME_RATING;?>:
		</div> 
		<div class="game_options_column2">
			<?php echo $game['rating_image'];?>
		</div> 
		<div class="game_options_column1">
			&nbsp;<?php echo GAME_YOUR_RATING;?>: 
		</div>
		<div class="game_options_column2">
			<?php echo $game['new_rating_form'];?>
		</div> 
		
		<?php if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) { ?>
		<div class="button2">
			<?php echo $game['report_game'];?>
		</div>
		<?php } ?>
		
		<div class="button2">
			<?php echo $game['fav_game'];?>
		</div>
		<?php if ($game['full_screen'] == 1) { ?>
		<div class="button2">
			<a href="<?php echo $game['full_screen_url'];?>"><?php echo GAME_FULL_SCREEN;?></a>
		</div>
		<?php } ?>
		<?php if($user['admin'] == 1) {?>
		<div class="button3">
			<?php echo $game['admin_options'];?>
		</div>
		<?php } ?>
	</div>

	<?php include (  './includes/view_game/game.inc.php'  ); // Include the flash game ?>
	
	<?php echo $game['game_message'];?>
</div>

<div class="leaderboard">
	<?php advert('leaderboard'); ?>
</div>

<div class="game_info_container">
	
	<div class="game_info_header">
		<?php echo GAME_INFO;?>
	</div>
	
	<div class="infos">
	
		<div class="game_image">
			<img src="<?php echo $game['image_url'];?>" width="70" height="70" alt="<?php echo $game['name'];?>" /><br />
			<?php echo $game['plays'];?> <?php echo GAME_PLAYS;?>
		</div>
		
		<div class="game_desc">
			<?php 
			echo '<div class="game_info_content"><strong>'.GAME_ADDED.':</strong> '.$game['date_added'].'</div>
			<div class="game_info_content"><strong>'.GAME_DESCRIPTION.':</strong> '.$game['description'].'</div>';
			if ($game['instructions'] != '') {
				echo '<div class="game_info_content"><strong>'.GAME_INSTRUCTIONS.':</strong> '.$game['instructions'].'</div>';
			}
			echo '<div class="game_info_content"><strong>'.GAME_TAGS.':</strong> '.$game['tags'].'</div>';
			if ($game['submitter'] != 0) {
				echo '<div class="game_info_content"><strong>'.GAME_SUBMITTER.':</strong> <a href="'.$game['submitter_url'].'">'.$game['submitter_name'].'</a></div>';
			}
			
			?>
		</div>
		
		<div class="social">
			<?php
			if ($setting['add_to_site'] == 1) {
				echo '<div class="game_info_content"><strong>'.GAME_EMBED.':<br /></strong>';
				include (  './includes/view_game/embed_game.inc.php'  );
				echo '</div>'; 
			}
			echo '<div class="game_info_content">';
			include './includes/view_game/social_icons.inc.php';
			echo '</div>';
			?>
		</div>
		
	</div><!--/infos-->
	
</div>


<div class="game_bottom">

	<div class="comments">
	
		<div class="new_comment_container">
			<div class="game_info_header">
				<?php echo GAME_COMMENTS;?>
			</div>
			<div class="comments_container">
				<?php include (  './includes/forms/add_comment_form.php'  ); // Include comments ?>
				<?php include (  './includes/view_game/game_comments.inc.php'  ); // Include comments ?>
			</div>
		</div>
		
	</div><!--/comments-->
	
	<div class="game_right_container">
	
			<?php if ($game['highscores'] == 1) { ?>
				<div class="game_column2">
					<div class="game_info_header">
						<?php echo GAME_HIGHSCORES;?>
					</div>
					<div id="highscores_ajax">
						<?php include (  './includes/view_game/highscores.inc.php'  ); // Include highscores ?>
					</div>
				</div>
			<?php } ?>
		
			<div class="game_column2">
				<div class="game_info_header">
					<?php echo GAME_MORE_GAMES;?>
				</div>
				<?php include (  './includes/view_game/random_games.inc.php'  ); // Include comments ?>
			</div>
		
	</div><!--/game_right_container-->
	
</div><!--/game_bottom-->

<?php include('footer.php'); ?>