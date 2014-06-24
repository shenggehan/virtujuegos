<?php include('header.php'); ?>
<div class="title">
	<?php include (  './includes/modules/content_title.php'  ); // Include the page title ?>
</div>

<div class="main_left">
	<div class="sort_options">
		<?php if ($cat_info['total_subcats'] != 0) {
						echo '<div class="category_subcats">'.CATEGORY_SUBCATS.': '; include 'includes/category/sub_categories.inc.php'; echo '</div>';
					}
			 include (  './includes/category/sort_options.inc.php'  ); // Include the sort-by options ?>
	</div>
    <div class="category_container">
    	<?php include (  './includes/category/category_main.inc.php'  ); // Include the homepage categories ?>
    	<br style="clear:both" />
    	<div class="category_pages">
    		<?php include (  './includes/category/pages.inc.php'  ); // Include the links to other pages ?>
    	</div>
    </div>
</div>

<div class="main_right">    	
	<?php include('sidebar.php'); ?>
</div>
<?php include('footer.php'); ?>