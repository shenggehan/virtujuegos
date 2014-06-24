<?php include 'header.php'; ?>

<h1><?php include 'includes/modules/content_title.php';?></h1>

<div class="misc_container">
	<div class="news_left">
		<div class="news_options">
			<?php 
			if ((isset($_GET['id'])) || (isset($_GET['name']))) {
				echo '<a href="'.$news['home_url'].'">&laquo; '.NEWS_HOME.'</a> ';
			}
			echo PAGES_SUBSCRIBE.': '.$news['rss_icon'];?>
		</div>
		<?php include './includes/news/news_main.inc.php'; ?>
		
	<?php if ((isset($_GET['id'])) || (isset($_GET['name']))) {
			echo '<div class="news_comments_header">'.NEWS_COMMENTS.'</div>
			<div class="news_comments_container">
			<div align="center">';
			include ('./includes/forms/add_news_comment_form.php');
			echo '</div>';
			include ('./includes/news/news_comments.inc.php');
			echo '</div>';
		}
	?>
	</div>
	<div class="misc_right">
		<?php include 'sidebar.php';?>
	</div>
</div>

<?php include 'footer.php';?>