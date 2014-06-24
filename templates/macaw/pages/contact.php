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

<h1 class="browse_cat_title">Contacto</h1>


<div class="MISCBOX" style="float:left; width: 737px;">

<div class="links_header">Intercambio de enlaces</div><div class="link_exchange_info">Envíe su enlace abajo y generaremos una URL de referencia única para que usted pueda añadir a su sitio. Al confirmar que el enlace está establecido, añadiremos el suyo.</div><div class="add_link_form_container">
<form id="form1" name="form1" method="post" action="http://virtujuegos.net/index.php?task=links">

<div class="link_form_element_container">
   <div class="link_form_lable"><label>Título</label></div>
   <div class="link_form_element"><input class="link_text_box" name="anchor" type="text" value=""></div>
</div>
  
<div class="link_form_element_container">
   <div class="link_form_lable"><label>Descripción</label></div>
   <div class="link_form_element"><input class="link_text_box" name="description" type="text" value=""></div>
</div>

<div class="link_form_element_container">
   <div class="link_form_lable">
   <label>URL</label></div>
   <div class="link_form_element"><input class="link_text_box" name="url" type="text" value=""></div>
</div>


<input name="id" type="hidden" value="0" id="id0">
<div class="link_button_container"><input class="link_button" name="Submit" type="submit" value="Subir" id="submit0"><br></div>
</form>

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
