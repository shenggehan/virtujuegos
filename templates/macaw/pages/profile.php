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
	  
<div class="sidebar">

	    <div class="sidebar_BOX">
	       
	       <div class="sidebar_profile">
	          <img src="<?php echo $profile['avatar_url'];?>" alt="Avatar" width="155" height="155" class="profile-header_avatar_img"/>
	       </div>
	       <p class="sb_profilename"><?php echo $profile['name'];?> <span class="sb_points"><?php echo $profile['points'];?> Puntos</span></p>	       
	       <ul class="sidebar_profile_links">
	       <li><strong><?php echo LAST_ACTIVITY;?>:</strong> <?php echo $profile['last_activity'];?></li>
	       <li><strong><?php echo PROFILE_PLAYS;?>:</strong> <?php echo $profile['plays'];?></li>
	       <li><strong><?php echo PROFILE_RATINGS;?>:</strong> <?php echo $profile['ratings'];?></li>
	       <li><strong><?php echo PROFILE_COMMENTS;?>:</strong> <?php echo $profile['comments'];?></li>	       
	       </ul>
	       <p class="sub_button_profile"><?php echo $profile['button1'];?></p>
	       <div style="float:right;" class="sub_button_profile"><?php echo $profile['button2'];?></div><br />
           
           <p class="sub_button_profile"><?php echo $profile['admin_edit'];?></p>
           
           <p class="sb_profile_title">Perfil de Jugador:</p>
             
             <ul class="sidebar_profile_links">
               <?php
		if ($setting['forums_installed'] == 1) {
				echo '<li><strong>'.FORUM_POSTS.':</strong><br /> <a href="'.$profile['forum_posts_link'].'" style="border:none;text-decoration:underline;">'.$profile['forum_posts'].'</a></li>';
		}
		?>     <li><strong><?php echo PROFILE_LOCATION;?>:</strong><br /><?php echo $profile['location'];?></li>
               <li><strong><?php echo PROFILE_BIO;?>:</strong><br /><?php echo $profile['about'];?></li>
               <li><strong><?php echo EP_INTERESTS;?>:</strong><br /><?php echo $profile['interests'];?></li>
               <li><strong><?php echo PROFILE_WEBSITE;?>:</strong><br /><?php echo $profile['website_link'];?></li>
               <li><strong><?php echo PROFILE_JOINED;?>:</strong><br /><?php echo $profile['join_date'];?></li>
             </ul>
	      
	    </div>
</div>



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


<h1 class="browse_cat_title"><?php include (  './includes/modules/content_title.php'  ); // Include the page title ?> Perfil</h1>

<div class="MISCBOX" style="float:left; width: 737px;">

<p class="profile_box_title"><?php echo $profile['name'].PROFILE_FAV_GAMES_HEADER;?></p>


<ul class="profile_games">
<?php include('includes/profile/fav_games.inc.php'); ?>
</ul><p class="profile_box_title"><?php echo $profile['name'].PROFILE_SUBMITTED_GAMES_HEADER;?></p>

<ul class="profile_games">
<?php include('includes/profile/submitted_games.inc.php'); ?>
</ul>


<?php if ($setting['forums_installed'] == 1) { ?>
<p class="profile_box_title"><?php echo PROFILE_SIGNATURE_HEADER;?></p>

<div class="profile_games">
<?php include('includes/profile/forum_signature.inc.php'); ?>
</div>
<?php } ?>


<div style="float:left; width: 427px;">
<p class="profile_box_title" style="width: 417px;"><?php echo $profile['name'].PROFILE_COMMENTS_HEADER;?></p>

<div id="profile_comments" style="float:left;">
 <ul>
<?php include('includes/profile/users_comments.inc.php'); ?>
 </ul>
</div>

</div>

<div style="float:right; width: 277px;">
<p class="profile_box_title" style="width: 267px;"><?php echo USER_HIGHSCORES;?></p>

<?php include('includes/profile/user_highscores.inc.php'); ?>

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
