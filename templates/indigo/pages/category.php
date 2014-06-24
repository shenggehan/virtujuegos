<?php include 'header.php';?>
<h1><?php include 'includes/modules/content_title.php';?></h1>

<div class="category_container">
	<div class="category_left">
		<div class="category_options"><?php include 'includes/category/sort_options.inc.php';?></div>
		<?php include 'includes/category/category_main.inc.php';?>
		<div class="category_pages">
			<div class="category_pages_inner">
				<?php include 'includes/category/pages.inc.php';?>
			</div>
		</div>
	</div>
		
	<div class="category_right">
		<?php include 'sidebar.php';?>
	</div>
</div>

<?php include 'footer.php';?>