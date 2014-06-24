
<div class="bottomBOXES">
	    <div class="cubeBOX">
	     <p class="cubeBOX_title">Ultimas Noticias</p>
	       <ul>
	       <?php
$sql = mysql_query("SELECT * FROM ava_news ORDER BY id desc LIMIT 5");
while($row = mysql_fetch_array($sql)) {
			
	$url = NewsUrl($row['id'], $row['seo_url']);
		
	$title = shortenStr($row['title'], $template['module_max_chars']);
	
	if ($setting['module_thumbs'] == 1) {
		$image_url = $setting['site_url'].'/uploads/news_icons/'.$row['image'];
		$image = '<img src="'.$image_url.'" width="25" height="25" style="vertical-align: middle;" />';
	}
	else {
		$image = '';
	}
	
	echo '<li class="news">'.$image.' <a href="'.$url.'">'.$title.'</a></li>';
}
?>

	       </ul>
	    </div>
	    
	    <div class="cubeBOX">
	     <p class="cubeBOX_title">Nuevos Juegos</p>
	       <ul>
	         <?php include('./includes/modules/newest.php');?>
	       </ul>
	    </div>
	    
	    <div class="cubeBOX">
	     <p class="cubeBOX_title">Enlaces Amigos</p>
	       <ul>
	         <?php include('./includes/modules/links.php');?>
	       </ul>
	    </div>
	    
	    <div class="cubeBOX">
	     <p class="cubeBOX_title">Tags de Juegos</p>
	     <?php include('./includes/modules/tag_cloud.php');?>
	    </div>
	    
	  </div>
	 
	</div>
	<div class="seoBOX">
	  <?php include './templates/macaw/sections/SEO.php';?> 
	</div>
	<div class="footer">
	  <div class="footerlinks">
	   <ul>
	   <?php include('./includes/modules/pages_horizontal.php');?>
	   </ul><br />
	   <p>&copy; Copyright <?php $today = date("Y"); echo $today;?> <?php echo $setting['site_name'];?> Todos los derechos reservados.<br />
Todo el contenido multimedia es propiedad de sus respectivos propietarios y autores.</p>
	  </div>
	  <div class="footerSHARE">
	  <?php include './templates/macaw/sections/FOOTERSHARE.php';?> 
	  </div>
	</div>
<?php include 'includes/footer_data.php';?>
</body>
</html>
