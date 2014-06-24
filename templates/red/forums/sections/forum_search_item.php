<div class="forum_topic_container" id="<?php echo $topic['id'];?>" data-locked="<?php echo $topic['locked'];?>">
	<div class="topic_icon">
		<img src="<?php echo $topic['icon'];?>" />
	</div>
	<?php if ($user['admin'] == 1) { ?>
	<div class="topic_checkbox">
		<input type="checkbox" name="<?php echo $topic['id'];?>" value="1" />
	</div>
	<?php } ?>
	<div class="topic_info">
		<?php echo LAST_POST_BY;?>: <a href="<?php echo $topic['last_post_user_profile_url'];?>"><?php echo $topic['last_post_user'];?></a><br />
		<?php echo $topic['last_post_time'];?>
	</div>
	<div class="topic_stats">
		<?php echo REPLIES.': '.$topic['total_replies'];?><br />
		<?php echo VIEWS.': '.$topic['views'];?>
	</div>
	<div class="topic_forum">
		<a href="<?php echo $topic['forum_url']; ?>"><?php echo $topic['forum_name']; ?></a>
	</div>
	<div class="topic_buttons">
		<img src="avforums/images/expand.png" alt="expand_arrow" width="16" height="16" />
	</div>
	<div class="topic_main">
		<div class="topic_title_container">
			<div class="topic_title <?php echo $unread_class;?>">
				<?php if ($topic['has_new_posts'] == 1) { ?> 
				<a href="<?php echo $topic['new_post_url'];?>">
					<img src="<?php echo $setting['site_url'];?>/templates/indigo/forums/images/newest_post_button.png" alt="newest_post_button" width="12" height="12" />
				</a> 
				<?php } ?>
				<a href="<?php echo $topic['url'];?>"><?php echo $topic['title'];?></a> 
			</div>
			<?php if ($topic['pages'] != '') { ?>
			<div class="topic_pages">(<?php echo PAGE.': '.$topic['pages'];?>)</div>
			<?php } ?>
		</div>

		<div class="topic_author">
			<?php echo TOPIC_CREATED_BY;?> <a href="<?php echo $topic['topic_starter_profile_url'];?>"><?php echo $topic['topic_starter'];?></a>, <?php echo $topic['start_date'];?>
		</div>
	</div>
	
	<div class="expanded_post"></div>
</div>