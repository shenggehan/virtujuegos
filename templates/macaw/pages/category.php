<?php include('header.php'); ?>

<div class="randomBOX">
       <p class="randomBOX_title">Juegos al Azar</p>
	    <?php include './templates/macaw/sections/randomSLIDE.php';?> 
	  </div>
	  <div style="float:left; width: 973px;">
	  <div class="yellowBOX">
	    <form action="<?php echo $setting['site_url']?>/index.php?task=search" method="get" onsubmit="<?php echo $search_function;?>">
	    <div><input name="task" type="hidden" value="search" /></div>
	    <div class="searchBOX">
	      <input name="q" type="text" size="20" id="search_textbox" value="<?php echo $search_val;?>" onclick="clickclear(this, '<?php echo SEARCH_DEFAULT;?>')" onblur="clickrecall(this,'<?php echo SEARCH_DEFAULT;?>')" class="searchINPUT"/>
	      <input id="box" type="image" name="submit" class="searchBUTTON" src="<?php echo $setting['site_url'];?>/templates/macaw/images/search.png" />
  		</div>
  		</form>
  		<div class="shareBOX">
          <?php include './templates/macaw/sections/SHARE.php';?> 
     	</div>
	  </div>
	  </div>
	  
<?php include('sidebar.php'); ?>

<div class="BOXRIGHT">

<div class="advertisement_leader">
	    <?php advert('leaderboard'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- virtujuegos_728x90 -->
<ins class="adsbygoogle"
    style="display:inline-block;width:728px;height:90px"
    data-ad-client="ca-pub-6225056310760113"
    data-ad-slot="9916871263"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>

<h1 class="browse_cat_title"><?php include (  './includes/modules/content_title.php'  ); // Include the page title ?> Games</h1>


<div class="BOXGAMES_BUTTONS">

</div>

	<div class="BOXGAMES_HORIZON" id="Action" style="display: block;">
  <div class="homecat_titles">
<?php if ($cat_info['total_subcats'] != 0) {
						echo '<div class="category_subcats"><p class="category_subcats_nonlink">'.CATEGORY_SUBCATS.': </p> '; include 'includes/category/sub_categories.inc.php'; echo '</div>';
					}
			 include (  './includes/category/sort_options.inc.php'  ); // Include the sort-by options ?>
</div>
<ul>

<?php include (  './includes/category/category_main.inc.php'  ); // Include the homepage categories ?>

</ul>
</div>

<div class="advertisement_leader">
	    <?php advert('leaderboard'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- virtujuegos_728x90 -->
<ins class="adsbygoogle"
    style="display:inline-block;width:728px;height:90px"
    data-ad-client="ca-pub-6225056310760113"
    data-ad-slot="9916871263"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
<div class="paginationBOX"><?php include (  './includes/category/pages.inc.php'  ); // Include the links to other pages ?></div>


<!-- Google analytics code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46804456-1', 'virtujuegos.net');
  ga('send', 'pageview');

</script>

</div>
<?php include('footer.php'); ?>