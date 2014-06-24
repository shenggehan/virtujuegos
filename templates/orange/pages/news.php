<?php include('header.php'); ?>
<div class="misc_left">
	<div class="misc_page_title">
		<?php include('includes/modules/content_title.php');
		echo ' '.$news['rss_icon']; ?>
    </div>
	<?php include('./includes/news/news_main.inc.php'); ?>
	
	<?php if ((isset($_GET['id'])) || (isset($_GET['name']))) {
			echo '<div class="news_comments_container">
			<div class="news_comments_title">'.NEWS_COMMENTS.'</div>
			<div align="center">';
			include ('./includes/forms/add_news_comment_form.php');
			echo '</div>';
			include ('./includes/news/news_comments.inc.php');
			echo '</div>';
		}
	?>
	
</div>

<div class="misc_right">
	<?php include('sidebar.php'); ?>
</div>
<br style="clear:both" />

<?php include('footer.php'); ?>