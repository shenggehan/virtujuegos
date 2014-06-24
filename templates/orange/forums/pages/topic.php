<?php include '.'.$setting['template_url'].'/pages/header.php';?>

<div class="forum_header">
	<div class="forum_header_left">
		<div class="breadcrumbs"><?php include 'includes/modules/breadcrumbs.inc.php';?></div>
		<h1 id="topic_title"><?php echo $topic['title'];?></h1> <! Keep the id "topic_title" so that it will update when changed by an admin !>
	</div>
	<div class="forum_header_right">
		<?php include 'avforums/core/topic/topic_search_form.inc.php'; // Topic search form ?>
	</div>
</div>

<?php include 'avforums/core/topic/topic_main.inc.php'; // The topic posts ?>
	
<div class="topic_bottom">
	<?php if ($topic['total_posts'] > $setting['posts_per_page']) { ?>
	<div class="topic_pages_container">
		<?php echo PAGE;?>: <?php include 'avforums/core/topic/topic_pages.inc.php'; // The topic pages ?>
	</div>
	<?php } ?>
</div>
<?php include 'avforums/core/topic/topic_reply_editor.inc.php'; // The default reply box/editor. Duplicate file into template to customise ?>


<?php include '.'.$setting['template_url'].'/pages/footer.php';?>