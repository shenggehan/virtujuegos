<div class="fh_forum_container" id="<?php echo $forum['id'];?>">
<div class="fh_forum_icon">
	<img src="<?php echo $forum['icon_url'];?>" alt="forum" width="32" height="32" />
</div>

<div class="fh_forum_left">
	<div class="fh_forum_name">
		<a href="<?php echo $forum['url'];?>"><?php echo $forum['name'];?></a>
	</div>
	<div class="fh_forum_description">
		<?php echo $forum['description'];?>
	</div>
</div>

	<div class="fh_forum_stats">
		<?php echo $forum['total_posts'];?> <?php echo POSTS;?><br />
		<?php echo $forum['total_topics'];?> <?php echo TOPICS;?>
	</div>
	<div class="fh_forum_last_post">
		<a href="<?php echo $forum['last_topic_url'];?>"><?php echo $forum['last_topic'];?></a><br />
		<?php echo POSTED_BY;?> <a href="<?php echo $forum['last_poster_url'];?>"><?php echo $forum['last_poster'];?></a><br />
		<?php echo $forum['last_post_time'];?>
	</div>
	
	<br style="clear:both" />

<?php
if ($forum['has_children'] == 1) {
	echo '<div class="fh_forum_subforums">'.SUB_FORUMS.': ';
	printForums($forums['children'], 3);
	echo '</div>';
}
?>
</div>