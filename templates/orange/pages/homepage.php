<?php include('header.php'); ?>
</div>
<div class="home_container">
	<div class="content_left">

	<div class="featured_games_heading">
		<?php echo FEATURED_GAMES;?>
	</div>

	<div class="featured_games">
		<?php include (  './includes/homepage/featured_games.inc.php'  ); // Include the category games ?> 
		<br style="clear:both" />
		<br />
	</div>

	<div class="ad_banner">
		<?php advert('banner'); ?>
	</div>

	<div class="home_categories">
		<?php include (  './includes/homepage/categories.inc.php'  ); // Include the homepage categories ?>
	</div>
</div>

<div class="content_right">
	<?php include('sidebar.php'); ?>
</div>
<br style="clear:both" />
<?php include('footer.php'); ?>