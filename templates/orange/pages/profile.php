<?php include('header.php'); ?>

<div class="profile_content">
	<div class="profile_header">
    
    	<div class="profile_header_avatar">
        	<img src="<?php echo $profile['avatar_url'];?>" alt="Avatar" width="75" height="75" class="profile-header_avatar_img"/>
        </div>
        
     	<div class="profile_header_info">
     		<div class="profile_username">
				<?php echo $profile['name'];?>
       	 	</div> 
        	<div class="profile_points">
				<?php echo $profile['points'];?>
        	</div>
        	
			<br style="clear:both" />
			<div class="profile_stats">
				<?php echo LAST_ACTIVITY;?>: <?php echo $profile['last_activity'];?> &nbsp;&nbsp;<?php echo PROFILE_PLAYS;?>: <?php echo $profile['plays'];?> &nbsp;&nbsp;<?php echo PROFILE_RATINGS;?>: <?php echo $profile['ratings'];?> &nbsp;&nbsp;<?php echo PROFILE_COMMENTS;?>: <?php echo $profile['comments'];?>
        	</div>
		</div>
    
   		<div class="profile_header_buttons">
			<div class="profile_button">
				<?php echo $profile['button1'];?>
				<?php echo $profile['button2'];?>
            </div>
		</div>
	</div>
	<br style="clear:both" />
	<div class="main_profile_left">
	<?php if ($setting['forums_installed'] == 1) { ?>
	<div class="profile_h2">
		<?php echo PROFILE_SIGNATURE_HEADER;?>
	</div>
	<?php include('includes/profile/forum_signature.inc.php'); ?>
	<br /><br />
	<?php } ?>
	
    	<div class="profile_h2">
			<?php echo $profile['name'].PROFILE_FAV_GAMES_HEADER;?>
        </div>
		<?php include('includes/profile/fav_games.inc.php'); ?>
		<br /><br />
		<div class="profile_h2">
			<?php echo $profile['name'].PROFILE_SUBMITTED_GAMES_HEADER;?>
        </div>
		<?php include('includes/profile/submitted_games.inc.php'); ?>
		<br /><br />
		<div class="profile_h2">
			<?php echo $profile['name'].PROFILE_COMMENTS_HEADER;?>
        </div>
		<?php include('includes/profile/users_comments.inc.php'); ?>
	</div>

	<div class="main_profile_right">
		<?php echo $profile['admin_edit'];?><br /><br />
		<?php
		if ($setting['forums_installed'] == 1) {
				echo '<span class="right_title">'.FORUM_POSTS.':</span><br /> <a href="'.$profile['forum_posts_link'].'" style="border:none;text-decoration:underline;">'.$profile['forum_posts'].'</a><br /><br />';
		}
		?>
		<span class="right_title"><?php echo PROFILE_LOCATION;?>:</span><br /><?php echo $profile['location'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_BIO;?>:</span><br /><?php echo $profile['about'];?><br /><br />
		<span class="right_title"><?php echo EP_INTERESTS;?>:</span><br /><?php echo $profile['interests'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_WEBSITE;?>:</span><br /><?php echo $profile['website_link'];?><br /><br />
		<span class="right_title"><?php echo PROFILE_JOINED;?>:</span><br /><?php echo $profile['join_date'];?><br /><br />
		
		<span class="right_title"><?php echo USER_HIGHSCORES;?></span>
		<div class="user_highscores_container">
			<?php include('includes/profile/user_highscores.inc.php'); ?>
		</div>
		<br style="clear:both" />
	</div>

	<br style="clear:both" />
</div>

<?php include('footer.php'); ?>