<?php include('header.php'); ?>

<div class="main_left">
	<?php if ($setting['featured_games'] == 1) { ?>
	<div class="featured_games">
		<h2 class="module_header">
			<?php echo FEATURED_GAMES;?>
		</h2>
		<?php include (  './includes/homepage/featured_games.inc.php'  ); // Include the featured games section ?>
	</div>
	<?php } ?>
	
	<h2 class="module_header"><?php echo NEWS;?></h2>
	<div class="home_news_container">
		<?php include (  './includes/homepage/news_brief.inc.php'  ); // Include the homepage categories ?>
	</div>

	
	<div class="ad_banner"><?php advert('banner'); ?></div>

    <?php include (  './includes/homepage/categories.inc.php'  ); // Include the homepage categories ?>
</div>

<div class="main_right">    	
	<?php include('sidebar.php'); ?>
</div>
<?php include('footer.php'); ?>