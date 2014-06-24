<div class="module">
	<div class="module_header">
		<div class="module_title"><?php echo FAVOURITE_MODULE;?></div>
		<div class="module_icon"><img src="<?php echo $setting['site_url']?>/templates/indigo/images/module_heart.png" alt="<?php echo FAVOURITE_MODULE;?>" /></div>
	</div>
	<?php include('./includes/modules/favourites.php');?>
</div>

<div class="module">
	<div class="module_header">
		<div class="module_title"><?php echo NEWEST_MODULE;?></div>
		<div class="module_icon"><img src="<?php echo $setting['site_url']?>/templates/indigo/images/module_star.png" alt="<?php echo NEWEST_MODULE;?>" /></div>
	</div>
	<?php include('./includes/modules/newest.php');?>
</div>

<div class="ad_small_square">
	<?php advert('small_square'); ?>
</div>

<div class="module">
	<div class="module_header">
		<div class="module_title"><?php echo POPULAR_MODULE;?></div>
		<div class="module_icon"><img src="<?php echo $setting['site_url']?>/templates/indigo/images/module_popular.png" alt="<?php echo POPULAR_MODULE;?>" /></div>
	</div>
	<?php include('./includes/modules/popular.php');?>
</div>

<div class="module">
	<div class="module_header">
		<div class="module_title"><?php echo TOP_PLAYERS_MODULE;?></div>
		<div class="module_icon"><img src="<?php echo $setting['site_url']?>/templates/indigo/images/module_user.png" alt="<?php echo TOP_PLAYERS_MODULE;?>" /></div>
	</div>
	<?php include('./includes/modules/top_players.php');?>
</div>

<?php $sidebar_page = 1;?>