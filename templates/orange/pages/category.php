<?php include('header.php'); ?>
</div>
<div class="home_container">
	<div class="content_left">
		<div class="cat_container">
			<div class="cat_name">
				<?php echo CATEGORY;?>: <?php include (  './includes/modules/content_title.php'  ); // Include the page title ?>
            </div>
			<div class="sort_options">
				<?php 
				if ($cat_info['total_subcats'] != 0) {
					echo '<div class="category_subcats">'.CATEGORY_SUBCATS.': '; include 'includes/category/sub_categories.inc.php'; echo '</div>';
				}
				include (  './includes/category/sort_options.inc.php'  ); // Include the sort-by options ?>
            </div>
			<br style="clear:both" />
			<?php include (  './includes/category/category_main.inc.php'  ); // Include the homepage categories ?>
			<br style="clear:both" />
			<div class="category_pages">
				<?php include (  './includes/category/pages.inc.php'  ); // Include the links to other pages ?>
			</div>
		</div>
	</div>
	<div class="content_right">
		<?php include('sidebar.php'); ?>
    </div>
    <br style="clear:both" />
	<?php include('footer.php'); ?>