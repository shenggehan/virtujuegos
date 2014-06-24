<div class="home_cat_title">
	<div class="home_cat_name">
		<a href="<?php echo $category['url'];?>"><?php echo $category['name'];?></a>
	</div>
	<div class="home_cat_link">
		<a href="<?php echo $category['url'];?>"><?php echo HOME_VIEW_MORE;?></a>
	</div>
</div>

<div class="home_category">
<?php include (  './includes/homepage/cat_games.inc.php'  ); // Include the category games ?> 
<br />
</div>