<div id="<?php echo $mugcat['name']; ?>" class="BOXGAMES_HORIZON">
  <div class="homecat_titles">
<p class="homecat_titles_p"><?php echo $category['name'];?> Juegos</p>
<p class="homecat_titles_p_more"><a href="<?php echo $category['url'];?>"><?php echo HOME_VIEW_MORE;?></a></p>

</div>
<ul>


<?php include (  './includes/homepage/cat_games.inc.php'  ); // Include the category games ?> 


</ul>
</div>