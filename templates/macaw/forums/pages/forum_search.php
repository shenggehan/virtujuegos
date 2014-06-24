<?php include '.'.$setting['template_url'].'/pages/header.php';?>
<div class="forum_header">
<h1 style="color: #127aca; padding:0px 0 5px 0px; margin:0;"><?php echo FORUM_SEARCH;?></h1>
<div class="breadcrumbs"><?php include 'includes/modules/breadcrumbs.inc.php'; // Breadcrumb navigation ?></div>
</div>

<div class="search_options">
	<?php include 'avforums/core/search/search_form.php'; // The main search form ?>
</div>

<?php if (isset($_GET['q'])) { ?>
<div class="forum_container">
<div class="forum_options">
	<?php if ($user['admin'] == 1) { ?>
	<div class="select_all_checkbox">
		<input type="checkbox" name="select_all" />
	</div>	
	<?php } ?>
</div>
	<div id="forum_main">
		<?php include 'avforums/core/search/search.php'; // The main search results ?>
	</div>
	<?php include 'avforums/core/forum/new_topic_editor.inc.php'; // The editor for managing topics ?>
</div>
<?php } ?>

<div class="topic_bottom">
	<div class="topic_pages_container">
		<?php echo PAGE;?>: <?php include 'avforums/core/search/search_pages.inc.php'; // Pagination ?>
	</div>
</div>

<?php include '.'.$setting['template_url'].'/pages/footer.php';?>