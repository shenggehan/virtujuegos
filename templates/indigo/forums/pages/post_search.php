<?php include '.'.$setting['template_url'].'/pages/header.php';?>
<h1><?php echo FORUM_SEARCH;?></h1>

<div class="search_options">
	<?php include 'avforums/core/search/search_form.php'; // The main search form?>
</div>

<div class="post_search">
	<?php include 'avforums/core/search/search.php'; // The main search results?>
</div>

<div class="topic_bottom">
	<div class="topic_pages_container">
		<?php echo PAGE;?>: <?php include 'avforums/core/search/search_pages.inc.php'; // Pagination?>
	</div>
</div>

<?php include '.'.$setting['template_url'].'/pages/footer.php';?>