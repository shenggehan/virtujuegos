<?php include('header.php'); ?>

<div class="featuredBOX">
	   <p class="featured_title"><?php echo FEATURED_GAMES;?></p>
	   <div style="margin: 8px 0 0 0px;">
	   <ul class="featuredSLIDERBOX" id="slider">
	   
       <?php include (  './includes/homepage/featured_games.inc.php'  ); ?>
	   
	   </ul>
	   </div>  
	  </div>
	  <!-- end of featuredBOX -->
	  
<div class="featuredADBOX">
	  <?php advert('banner'); ?>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- virtujuegos_300x250 -->
<ins class="adsbygoogle"
    style="display:inline-block;width:300px;height:250px"
    data-ad-client="ca-pub-6225056310760113"
    data-ad-slot="3870337661"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	  </div>
	  

<div class="newgamesBOX">
	   <p class="newgamesBOX_title"><?php echo NEWEST_MODULE;?></p>
	   <ul>
	   <?php include('./templates/macaw/sections/newest.php');?>
	   </ul>
</div>


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

<span class="browse_cat">Buscar juegos por categoria</span>


<div class="BOXGAMES_BUTTONS">
	     <ul class="idTabs"> 
	<?php

$sql = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order LIMIT 8"); 
$total_cats2 = 0; 

while($row = mysql_fetch_array($sql)) { 

$total_cats2 = ($total_cats2 + 1); 
$seo_name = seoname($row['name']);

$mugcat = array('name' => $row['name']);
$mugcat['name'] = str_replace(' ', '', $mugcat['name']);

echo '<li>';

if ($row['parent_id'] != 1) { 

echo '<a href="#'.$mugcat['name']. '">'.$row['name'], '</a>'; } 

echo '</li>';

 }

?>

<li><a>Mas ></a>
<ul>
	<?php

$sql = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order ASC LIMIT 8,10"); 
$total_cats2 = 0; 

while($row = mysql_fetch_array($sql)) { 

$total_cats2 = ($total_cats2 + 1); 
$seo_name = seoname($row['name']);

$mugcat = array('name' => $row['name']);
$mugcat['name'] = str_replace(' ', '', $mugcat['name']);

echo '<li>';

if ($row['parent_id'] != 1) { 

echo '<a href="#'.$mugcat['name']. '">'.$row['name'], '</a>'; } 

echo '</li>';

 }

?>
</ul>
</li>

</ul>

</div>

	
	<?php
defined( 'AVARCADE_' ) or die( '' );
$therow = 0;
$sql = mysql_query("SELECT * FROM ava_cats WHERE parent_id = 0 ORDER BY cat_order ASC");
while($row = mysql_fetch_array($sql)) {
	$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE (category_id = $row[id] OR category_parent = $row[id]) AND published=1"),0);
	if ($cat_numb > 0) {
 		$therow = $therow + 1;
 	
 		$category = array('name' => $row['name']);
 		
		$category['url'] = CategoryUrlTabinfo($row['id'], $row['seo_url'], 1, 'newest');
	
		include('.'.$setting['template_url'].'/sections/tabs.php');
	
		if ($therow == $template['homepage_columns']) {
			$therow = 0;
		}
	}
}
?>
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



</div>

<?php include('footer.php'); ?>
