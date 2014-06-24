<?php include('header.php'); ?>
<div class="title">
	<?php 
		include (  './includes/modules/content_title.php'  ); // Include the page title 
		echo ' '.$news['rss_icon'];
	?>
</div>
<div class="main_left">
	<?php include './includes/news/news_main.inc.php'; ?>
	
		
		<?php if ((isset($_GET['id'])) || (isset($_GET['name']))) {
			echo '<div class="news_comments_container">
			<div class="game_info_header">'.NEWS_COMMENTS.'</div>
			<div align="center">';
			include ('./includes/forms/add_news_comment_form.php');
			echo '</div>';
			include ('./includes/news/news_comments.inc.php');
			echo '</div>';
		}
	?>
</div>
<div class="main_right">    	
	<?php include('sidebar.php'); ?>
</div>
<?php include('footer.php'); ?>