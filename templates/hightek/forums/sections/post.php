<div class="post_container" id="<?php echo $post['id'];?>">
	<a name="<?php echo $post['id'];?>"></a> 
	<div class="post_user_info">
		<a href="<?php echo $post_user['profile_url'];?>"><?php echo $post_user['username'];?></a><br />
		<div class="post_avatar">
			<img src="<?php echo $post_user['avatar_url'];?>" width="70" height="70" />
		</div>
		<div class="post_user_stats">
			<?php echo PROFILE_POINTS.': '.$post_user['points'].'<br />'.
			PROFILE_JOINED.': '.$post_user['joined'].'<br/>'.
			TOTAL_POSTS.': '.$post_user['forum_posts'];?>
		</div>
	</div>
	<div class="post_info">
		<?php echo '<a href="#'.$post['id'].'">#'.$post['id'].'</a>';?>&nbsp;
		 <abbr title="<?php echo $post['actual_date'];?>"><?php echo POSTED;?>: <?php echo $post['date'];?></abbr>
		<?php if ($post['edit_time'] != '0') {
					echo ' &nbsp; '.EDITED_BY.' '.$post['edit_username'].': '.$post['edit_time'];
			}
		?>
		<?php echo $post['icon'];?>
	</div>
	<div class="post_content">
		<?php 
			echo $post['post_content'];
		?>
		<?php if ($post_user['signature'] != '') { ?>
	<div class="post_signature">
		<?php echo $post_user['signature']; ?>
	</div>
	<?php } ?>
	</div>
	<br style="clear:both" />
	
	<div class="post_user_info_footer">
		<?php echo $post['report_button'];?>
	</div>
	<div class="post_content_footer">
		<?php echo $post['quote_button'];?>
		<?php echo $post['edit_button'];?>
		<?php echo $post['delete_button'];?>
	</div>
</div>