<div class="module">
		<div class="searchform">
			<form action="<?php echo $setting['site_url']?>/index.php?task=search" method="get" onsubmit="<?php echo $search_function;?>">
			<input name="task" type="hidden" value="search" /> 
				<input name="q" type="text" size="20" id="search_textbox" value="<?php echo $search_val;?>" onclick="clickclear(this, '<?php echo SEARCH_DEFAULT;?>')" onblur="clickrecall(this,'<?php echo SEARCH_DEFAULT;?>')" class="search_box"/> 
				<input id="box" type="image" name="submit" src="<?php echo $setting['site_url'];?>/templates/hightek/images/search.png" class="search_button" /> 
			</form>
		</div><!--/searchform-->
</div>

<div class="module">
	<div class="module_header">
		<?php echo NEWEST_MODULE;?>
	</div>
	<?php include('./includes/modules/newest.php');?>
</div>

<div class="ad_small_square">
	<?php advert('small_square'); ?>
</div>

<div class="module">
	<div class="module_header">
		<?php echo POPULAR_MODULE;?>
	</div>
	<?php include('./includes/modules/popular.php');?>
</div>

<div class="module">
	<div class="module_header">
		<?php echo FAVOURITE_MODULE;?>
	</div>
	<?php include('./includes/modules/favourites.php');?>
</div>

<div class="module">
	<div class="module_header">
		<?php echo TOP_PLAYERS_MODULE;?>
	</div>
	<?php include('./includes/modules/top_players.php');?>
</div>



