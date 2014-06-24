<div class="post_container" id="<?php echo $post['id'];?>">
	<a name="<?php echo $post['id'];?>"></a> 
	<div class="post_user_info">
		<a href="<?php echo $post_user['profile_url'];?>"><?php echo $post_user['username'];?></a><br />
	</div>
	<div class="post_info">
		Topic: <a href="<?php echo $post['topic_url'];?>"><?php echo $post['title'];?></a>&nbsp;&nbsp;&nbsp;
		 <abbr title="<?php echo $post['actual_date'];?>"><?php echo POSTED;?>: <?php echo $post['date'];?></abbr>
		<?php if ($post['edit_time'] != '0') {
					echo ' &nbsp; '.EDITED.': '.$post['edit_time'];
			}
		?>
	</div>
	<div class="post_content">
		<?php 
			echo $post['post_content'];
		?>
	</div>
	<br style="clear:both" />
	<div class="post_user_info_footer">
		<?php //echo '<a href="#'.$post['id'].'">#'.$post['id'].'</a>';?>
	</div>
	<div class="post_content_footer">
		<?php //echo $post['edit_button'];?>
		<?php //echo $post['delete_button'];?>
	</div>
</div>