<?php include '.'.$setting['template_url'].'/pages/header.php';?>

<div class="forum_header">
<h1 style="color: #127aca; padding:0px 0 5px 0px; margin:0;"><?php echo $forum['name'];?></h1>
<div class="breadcrumbs" style="padding: 0 0 10px 0"><?php include 'includes/modules/breadcrumbs.inc.php'; // Breadcrumb navigation ?></div>
</div>

<?php if ($forum['children'] != 0) { ?>
<div class="fh_category_header">
	<div class="fh_category_title">
		<?php echo SUB_FORUMS;?>
	</div>
	<div class="fh_category_middle">
		<?php echo STATS;?>
	</div>
	<div class="fh_category_right">
		<?php echo LAST_POST_INFO;?>
	</div>
</div>

<div class="fh_category_container">
	<?php include 'avforums/core/forum/sub_forums.inc.php'; // The sub-forums ?>
</div>
<?php } ?>

<div class="forum_container">
<div class="forum_options">
	<div class="forum_search">
		<?php include 'avforums/core/forum/forum_search_form.inc.php'; // Form for search ?>
	</div>
	<?php if ($user['admin'] == 1) { ?>
	<div class="select_all_checkbox">
		<input type="checkbox" name="select_all" />
	</div>	
	<?php } ?>
</div>
	<div id="forum_main">
		<?php include 'avforums/core/forum/forum_main.inc.php'; // The forum's topics ?>
	</div>
	<?php include 'avforums/core/forum/new_topic_editor.inc.php'; //// The default new topic editor. Duplicate file into template to customise ?>
</div>

<div class="forum_pages_container">
	<?php include 'avforums/core/forum/forum_pages.inc.php'; // Forum pagination ?>
</div>
<br style="clear:both" />

<?php include '.'.$setting['template_url'].'/pages/footer.php';?>