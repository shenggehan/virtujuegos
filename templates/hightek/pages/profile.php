<?php include('header.php'); ?>
<div class="profile_container">
		<div class="profile_header_avatar">
			<img src="<?php echo $profile['avatar_url'];?>" alt="Avatar" width="75" height="75" class="profile-header_avatar_img"/>
		</div>
		<div class="profile_header_info">
			<div class="profile_username">
				<?php echo $profile['name'];?>
			</div> 
			<div class="profile_points">
				<?php echo $profile['points'];?> <span class="small_points"><?php echo PROFILE_POINTS;?></span>
			</div>
			<br style="clear:both" />
			<div class="profile_stats">
				<?php echo LAST_ACTIVITY;?>: <?php echo $profile['last_activity'];?> &nbsp;&nbsp;<?php echo PROFILE_PLAYS;?>: <?php echo $profile['plays'];?> &nbsp;&nbsp;<?php echo PROFILE_RATINGS;?>: <?php echo $profile['ratings'];?> &nbsp;&nbsp;<?php echo PROFILE_COMMENTS;?>: <?php echo $profile['comments'];
				if ($setting['forums_installed'] == 1) {
					echo ' &nbsp;&nbsp;'.FORUM_POSTS.': <a href="'.$profile['forum_posts_link'].'" style="border:none;text-decoration:underline;">'.$profile['forum_posts'].'</a>';
				}
				?>
			</div>
		</div>
		
		<div class="profile_header_buttons">
			<div class="profile_button">
				<?php echo $profile['button1'];?>
				<?php echo $profile['button2'];?>
			</div>
		</div>
</div>

<div class="profile_column1">
	<?php if ($setting['forums_installed'] == 1) { ?>
	<div class="profile_left_header">
			<?php echo PROFILE_SIGNATURE_HEADER;?>
		</div>
	<div class="profile_content_item">
		<div class="fav_container">
			<?php include('includes/profile/forum_signature.inc.php'); ?>
		</div>
	</div>
	<?php } ?>

	<div class="profile_left_header">
			<?php echo $profile['name'].PROFILE_FAV_GAMES_HEADER;?>
		</div>
	<div class="profile_content_item">
		<div class="fav_container">
			<?php include('includes/profile/fav_games.inc.php'); ?>
		</div>
	</div>
	
	<div class="profile_left_header">
			<?php echo $profile['name'].PROFILE_SUBMITTED_GAMES_HEADER;?>
		</div>
	<div class="profile_content_item">
		<div class="fav_container">
			<?php include('includes/profile/submitted_games.inc.php'); ?>
		</div>
	</div>
	
	<div class="profile_content_item">
		<div class="profile_left_header">
			<?php echo $profile['name'].PROFILE_COMMENTS_HEADER;?>
		</div>
		<div class="fav_container">
			<?php include('includes/profile/users_comments.inc.php'); ?>
		</div>
	</div>
</div>

<div class="profile_right_container">
<div class="profile_column2">
	<div class="module_header">
		<?php echo PROFILE;?>
	</div>
	<div class="user_info">
		<?php echo $profile['admin_edit'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_LOCATION;?>:</span><br /><?php echo $profile['location'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_BIO;?>:</span><br /><?php echo $profile['about'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_WEBSITE;?>:</span><br /><?php echo $profile['website_link'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_JOINED;?>:</span><br /><?php echo $profile['join_date'];?><br /><br />
	</div>
</div>

<div class="ad_small_square">
		<?php advert('small_square'); ?>
	</div>

<div class="profile_column2">
	<div class="module_header">
		<?php echo USER_HIGHSCORES;?>
	</div>
	<div class="user_info">
		<?php include('includes/profile/user_highscores.inc.php'); ?>
	</div>
</div> 
</div>
<?php include('footer.php'); ?>