<?php include('header.php'); ?>

<div class="main_left">
	<?php if ($setting['featured_games'] == 1) { ?>
	<div class="featured_games">
		<div class="module_header">
			<?php echo FEATURED_GAMES;?>
		</div>
		<?php include (  './includes/homepage/featured_games.inc.php'  ); // Include the featured games section ?>
	</div>
	<?php } ?>
	
	<div class="ad_banner"><?php advert('banner'); ?></div>

    <?php include (  './includes/homepage/categories.inc.php'  ); // Include the homepage categories ?>
</div>

<div class="main_right">    	
	<?php include('sidebar.php'); ?>
</div>
<?php include('footer.php'); ?>