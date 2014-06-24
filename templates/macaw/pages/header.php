<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<?php include 'includes/header_data.inc.php' ?>
<link rel="stylesheet" href="<?php echo $setting['site_url'];?>/templates/macaw/style.css" type="text/css" />
<script type="text/javascript" src="<?php echo $setting['site_url'];?>/templates/macaw/js/macaw.js"></script>
<link rel="stylesheet" href="<?php echo $setting['site_url'];?>/templates/macaw/css/anythingslider.css">
<script src="<?php echo $setting['site_url'];?>/templates/macaw/js/jquery.anythingslider.js"></script>
<script src="<?php echo $setting['site_url'];?>/templates/macaw/js/jquery.idTabs.js"></script>
<script src="<?php echo $setting['site_url'];?>/templates/macaw/js/spin.js"></script>
<script src="<?php echo $setting['site_url'];?>/templates/macaw/js/tip.js"></script>
<?php if (isset($is_forum_page)) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'].$setting['template_url'];?>/forums/forums.css" />
<?php } ?>
</head>
<body>
<!-- Google analytics code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46804456-1', 'virtujuegos.net');
  ga('send', 'pageview');

</script>
<?php
if ($setting['site_offline'] == 1) {
	echo '<div style="background-color:#73000b;text-align:center;color:#fff;font-family:Arial;padding:10px;">Matinence mode active - site not accessible to non-admins</div>';
}
?>
<div class="header">
	<div class="header-left">
	  <div class="logoBOX">
	   <a href="<?php echo $setting['site_url'];?>"><img class="logoIMG" src="<?php echo $setting['site_url'];?>/templates/macaw/images/logo.png" alt="<?php echo $setting['site_name'];?>" /></a>
	  </div>
	</div>
	<div class="header-right">
	   <ul class="siteMENU">
	   <?php if ($setting['seo_on'] == 0) {
	echo '
	<li class="sm_home"><a href="'.$setting['site_url'].'">'.HOME.'</a></li>
    <li class="sm_news"><a href="'.$setting['site_url'].'/index.php?task=news">'.NEWS.'</a></li>
    <li class="sm_sub"><a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a></li>
    <li class="sm_member"><a href="'.$setting['site_url'].'/index.php?task=member_list">'.MEMBER_LIST.'</a></li>';
    
    if ($setting['forums_installed'] == 1) {
    echo '<li class="sm_forum"><a href="'.$setting['site_url'].'/forums">'.FORUMS.'</a></li>';
    } else {
    echo '<li class="sm_links"><a href="'.$setting['site_url'].'/index.php?task=links">'.LINKS.'</a></li>';
    }
	if ($setting['allow_submissions'] == 1) {
		echo '<li class="sm_game"><a href="'.$setting['site_url'].'/index.php?task=submit">'.SUBMIT_GAME.'</a></li>';
	}
}
else {
	echo '
	<li class="sm_home"><a href="'.$setting['site_url'].'">'.HOME.'</a></li>
	<li class="sm_news"><a href="'.$setting['site_url'].'/news'.$setting['seo_extension'].'">'.NEWS.'</a></li>
	<li class="sm_sub"><a href="'.$setting['site_url'].'/rss.php">'.PAGES_SUBSCRIBE.'</a></li>
	<li class="sm_member"><a href="'.$setting['site_url'].'/members'.$setting['seo_extension'].'">'.MEMBER_LIST.'</a></li>';
	
	if ($setting['forums_installed'] == 1) {
	 echo '<li class="sm_forum"><a href="'.$setting['site_url'].'/forums">'.FORUMS.'</a></li>';
	 } else {
	  echo '<li class="sm_links"><a href="'.$setting['site_url'].'/links'.$setting['seo_extension'].'">'.LINKS.'</a></li>';
	 }
	 
	if ($setting['allow_submissions'] == 1) {
		echo '<li class="sm_game"><a href="'.$setting['site_url'].'/submit-game'.$setting['seo_extension'].'">'.SUBMIT_GAME.'</a></li>';
	}
} 

?>
	   </ul>
	   
	   <div class="memberBOX">
	     <?php include './templates/macaw/sections/user_area.php';?>
	     
	   </div>
	</div>
</div>
	<div class="categoryBOX">
	 <ul>
	 <?php include('./includes/modules/categories_menu.php');?>
	 </ul>
	</div>
	<div class="mainBOX">
	  <div class="advertisement_bar">
	  <?php include('./templates/macaw/sections/LINKAD.php');?>
</div>
