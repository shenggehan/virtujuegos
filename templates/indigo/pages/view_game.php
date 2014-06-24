<?php include 'header.php'; ?>
		
		<div class="view_game_header">
			<div class="view_game_header_left">
				<div class="view_game_thumbnail"><img width="60" height="60" src="<?php echo $game['image_url'];?>" /></div>
				<div class="view_game_title_ratings">
					<div class="view_game_title"><h1><?php echo $game['name'];?></h1>
					</div>
					<div class="view_game_ratings">
						<div class="ratings_left">
							<?php if ($user['admin'] == 1) { ?>
						<span class="view_game_admin_options"><a href="<?php echo $game['edit_game_link'];?>"><img src="<?php echo $setting['site_url'];?>/templates/indigo/images/edit.png" alt="edit" width="16" height="16" /></a></span>
					<?php } ?>	
							<?php echo GAME_RATING;?>:</div> <div class="ratings_right"><?php echo $game['rating_image'];?>
						</div> 
						<div class="ratings_left"><?php echo GAME_YOUR_RATING;?>:</div><div class="ratings_right"> <?php echo $game['new_rating_form'];?></div>
					</div>
				</div>
			</div>
			<div class="view_game_header_right">
				<div class="fav_button">
					<?php echo $game['fav_game'];?>
				</div>
				<?php if ($game['full_screen'] == 1) { ?>
				<div class="game_button">
					<a href="<?php echo $game['full_screen_url'];?>"><?php echo GAME_FULL_SCREEN;?></a>
				</div>
				<?php } ?>
				<?php if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) { ?>
				<div class="game_button">
					<?php echo $game['report_game'];?>
				</div>
				<?php } ?>
			</div>
		</div>
		
		<div class="view_game_embed_container">
			<?php include (  './includes/view_game/game.inc.php'  ); // Include the flash game ?>
			
			<?php echo $game['game_message'];?>
		</div>
		<div class="view_game_details">
			<div class="view_game_details_left">
				<span class="view_game_stats"><?php echo GAME_ADDED.': '.$game['date_added'].' &nbsp;&nbsp;'.GAME_TIMES_PLAYED.': '.$game['plays'];?></span>
				<br /><?php echo $game['description'];
				
				if ($game['instructions'] != '') {
					echo '<h2>'.GAME_INSTRUCTIONS.'</h2> '.$game['instructions'];
				}
				
				if ($game['submitter'] != 0) {
					echo '<h2>'.GAME_SUBMITTER.':</h2> <a href="'.$game['submitter_url'].'">'.$game['submitter_name'].'</a>';
				}
				
				?>
				<h2><?php echo GAME_TAGS;?></h2>
				<?php echo $game['tags']; 
					
					if ($setting['add_to_site'] == 1) {
						echo '<div class="game_embed_container"><h2>'.GAME_EMBED.':</h2>';
						include (  './includes/view_game/embed_game.inc.php'  );
						echo '</div>'; 
					}
				?>
			</div>
			<div class="view_game_details_right">
				<div class="share_options">
					<?php include './includes/view_game/social_icons.inc.php'; ?>
				</div>
				<?php if ($game['highscores'] == 1) { ?>
				<div class="view_game_highscores_header">
					<div class="gfl"><?php echo GAME_HIGHSCORES;?></div>
					<div class="gfr">
						<div class="medal_icon"><img src="<?php echo $setting['site_url'];?>/templates/indigo/images/trophy1.png" alt="medal" width="16" height="16" /></div>
					</div>
				</div>
				<div class="view_game_highscores" id="highscores_ajax">
					<?php include (  './includes/view_game/highscores.inc.php'  ); // Include highscores ?>
				</div>
				<?php } ?>
			</div>
			<br style="clear:both" />
			<div class="ad_center">
				<?php advert('banner'); ?>
			</div>
		</div>
		<div class="random_games">
			<div class="random_games_title">
				<?php echo GAME_MORE_GAMES;?>
			</div>
			<?php include (  './includes/view_game/random_games.inc.php'  ); // Include random games ?>
		</div>
		<div class="view_game_comments">
			<div class="view_game_comments_title">
				<?php echo GAME_COMMENTS;?>
			</div>
			<div class="view_game_comment_form_container">
				<?php include (  './includes/forms/add_comment_form.php'  ); // Include comments ?>
			</div>
			<?php include (  './includes/view_game/game_comments.inc.php'  ); // Include comments ?>
		</div>
<?php include 'footer.php';?>