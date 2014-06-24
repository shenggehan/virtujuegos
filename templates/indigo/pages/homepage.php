<?php include 'header.php'; ?>
	<?php if ($setting['featured_games'] == 1) { ?>
		<div class="homepage_featured">
			<div class="homepage_featured_header">
				<div class="homepage_featured_title">
					<?php echo FEATURED_GAMES;?>
				</div>
				<div class="homepage_featured_buttons">
					<img id="featured_prev" style="opacity:0.2;" src="<?php echo $setting['site_url'];?>/templates/indigo/images/left_arrow.png" alt="right_arrow" width="20" height="20" /> 
					<img id="featured_next" src="<?php echo $setting['site_url'];?>/templates/indigo/images/right_arrow.png" alt="right_arrow" width="20" height="20" />
				</div>
			</div>
			<?php include 'includes/homepage/featured_games.inc.php';?>
		</div>
	<?php } ?>
		<div class="homepage_main">
			<div class="homepage_left">
				<div class="home_cat_row">
					<?php include 'includes/homepage/categories.inc.php';?>
				</div>
			</div>
		
			<div class="homepage_right">
				<?php include 'sidebar.php';?>
			</div>
		</div>
<?php include 'footer.php';?>