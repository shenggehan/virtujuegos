<div class="fh_category_header">
	<div class="fh_category_title">
		<a href="<?php echo $forum['url'];?>"><?php echo $forum['name'];?></a>
	</div>
	<div class="fh_category_middle">
		<?php echo STATS;?>
	</div>
	<div class="fh_category_right">
		<?php echo LAST_POST_INFO;?>
	</div>
</div>

<div class="fh_category_container">
<?php
	if ($forum['has_children'] == 1) {
		printForums($forums['children']);
	}
?>
</div>