<! Welcome to this horrible mess! !>

<div class="mochi_buttons5"><div class="mochi_button"><a href="?task=mochi#page=1&cat=All">Mochi</a></div><div class="mochi_button"><a href="?task=fgd#page=1&cat=All">FGD</a></div><div class="mochi_button"><a href="?task=kongregate#page=1&cat=All">Kongregate</a></div><div class="mochi_button"><a href="?task=fog#page=1&cat=All">FOG</a></div><div class="mochi_button"><a href="?task=spil#page=1&cat=All">Spil Games</a></div></div>
<br style="clear:both" />

<?php
if ($_POST) {
	$sql = mysql_query("SELECT * FROM ava_feed_settings");
	while ($get_setting = mysql_fetch_array($sql)) {
		$value = $_POST[$get_setting['name']];
		mysql_query("UPDATE ava_feed_settings SET value = '$value' WHERE name = '$get_setting[name]'") or die (mysql_error());
	}
	echo '<br /><br />Settings updated<br />';
}

$feed_setting = feed_setting('all');
?>
<h2>Mochi autopost URL</h2>   
<div class="mochi_form_element_container2">
	<div class="autopost_info">This url needs to be entered on the page <a href="https://www.mochimedia.com/pub/settings">https://www.mochimedia.com/pub/settings</a> if you wish to use autopost from their site (make sure to select 'Custom Script' from the drop-down menu). You don't need to add this if you are only downloading games through the admin.<br /><br />
	
	<input name="autopost_url" class="wide_text_box" type="text" value="<?php echo $setting['site_url']."/admin/includes/autopost.php";?>" readonly/>
	</div>
</div>

<h2>Free Online Games autopost URL</h2>   
<div class="mochi_form_element_container2">
	<div class="autopost_info">This URL can be entered on <a href="http://www.freegamesforyourwebsite.com/">freegamesforyourwebsite.com</a>. Register and enter the URL in the "User Panel" section on their site. You don't need to add this if you are only downloading games through the admin.<br /><br />
	
	<input name="fog_autopost_url" class="wide_text_box" type="text" value="<?php echo $setting['site_url']."/admin/feeds/fog/fog_autopost.php";?>" readonly/>
	</div>
</div>

<form id="form1" name="form1" method="post" action="index.php?task=feed_settings">

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Default category</label></div>
   <div class="mochi_form_element">
		<select name="category_autopost">
			<?php categorylist($feed_setting['category_autopost']); ?>
		</select>
   </div>
   <br style="clear:both" />
</div>

<h2>Mochi publisher settings</h2>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Publisher ID</label></div>
   <div class="mochi_form_element">
   <input name="mochi_pubid" class="category_text_box" type="text" value="<?php echo $feed_setting['mochi_pubid'];?>" />
   </div>
   <br style="clear:both" />
</div>
<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Secret key</label></div>
   <div class="mochi_form_element">
   <input name="mochi_secretkey" class="category_text_box" type="text" value="<?php echo $feed_setting['mochi_secretkey'];?>" />
   </div>
   <br style="clear:both" />
</div>

<h2>Feed settings</h2>
<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Games limit when updating feed <a href="#" onmouseover="Tip('The amount of latest games you want to check when updating the feed')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element">
   <input name="max_feed" class="category_text_box" type="text" value="<?php echo $feed_setting['max_feed'];?>" />
   </div>
   <br style="clear:both" />
</div>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Use cURL to get feed <a href="#" onmouseover="Tip('Try setting to \'No\' if you get errors. Otherwise, leave it on')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element">
   <?php if ($feed_setting['curl'] == 1) { echo '
          <input name="curl" type="radio" value="1" checked="checked" />
        Yes
        <input name="curl" type="radio" value="0" /> No';}
		else {
		echo'<input name="curl" type="radio" value="1" />
       	Yes
        <input name="curl" type="radio" value="0" checked="checked" /> No';
		} ?>
   </div>
   <br style="clear:both" />
</div>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Download games to your site <a href="#" onmouseover="Tip('Downloading the games will allow you to earn money and track impressions with mochi. Not downloading can save bandwidth and makes adding games quicker.')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element">
   <?php if ($feed_setting['download'] == 1) { echo '
          <input name="download" type="radio" value="1" checked="checked" />
        Yes
        <input name="download" type="radio" value="0" /> No';}
		else {
		echo'<input name="download" type="radio" value="1" />
       	Yes
        <input name="download" type="radio" value="0" checked="checked" /> No';
		} ?>
   </div>
   <br style="clear:both" />
</div>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Default AD <a href="#" onmouseover="Tip('Default ad before game setting')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element"><select name="default_ad">
 <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY ad_name ASC");
   if ($feed_setting['default_ad'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   		
   if ($feed_setting['default_ad'] == 1)
   		echo '<option value="1" selected>Sitewide default</option>';
   else 
   		echo '<option value="1">Sitewide default</option>';
   		
   while($ca = mysql_fetch_array($cq)) {
   		if ($ca['id'] != 1)	{
			if ($ca['id'] == $feed_setting['default_ad'])
				echo '<option value="'.$ca['id'].'" selected>'.$ca['ad_name'].'</option>'; 
			else 
		   		echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
		}
   }?>
</select>
   </div>
   <br style="clear:both" />
</div>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Get tags <a href="#" onmouseover="Tip('Download tags from mochi? This will slow down the game install and also mochi tags can get a bit spammy')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element">
   <?php if ($feed_setting['get_tags'] == 1) { echo '
          <input name="get_tags" type="radio" value="1" checked="checked" />
        Yes
        <input name="get_tags" type="radio" value="0" /> No';}
		else {
		echo'<input name="get_tags" type="radio" value="1" />
       	Yes
        <input name="get_tags" type="radio" value="0" checked="checked" /> No';
		} ?>
   </div>
   <br style="clear:both" />
</div>

<div class="mochi_form_element_container2">
   <div class="mochi_form_lable">
   <label>Additional feed parameters <a href="#" onmouseover="Tip('Extra parameters to add to the feed for example \'&offset=5000\'')" onmouseout="UnTip()">[?]</a></label></div>
   <div class="mochi_form_element">
   <input name="feed_params" class="category_text_box" type="text" value="<?php echo $feed_setting['feed_params'];?>" />
   </div>
   <br style="clear:both" />
</div>

<h2>Categories</h2>

<div class="feed_categories_container">

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Action</label>
	</div>
	<div class="cat_form_element">
		<select name="category_action">
			<?php categorylist($feed_setting['category_action']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Adventure</label>
	</div>
	<div class="cat_form_element">
		<select name="category_adventure">
			<?php categorylist($feed_setting['category_adventure']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Arcade</label>
	</div>
	<div class="cat_form_element">
		<select name="category_arcade">
			<?php categorylist($feed_setting['category_arcade']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Board Game</label>
	</div>
	<div class="cat_form_element">
		<select name="category_board_game">
			<?php categorylist($feed_setting['category_board_game']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Casino</label>
	</div>
	<div class="cat_form_element">
		<select name="category_casino">
			<?php categorylist($feed_setting['category_casino']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Customize / Girls</label>
	</div>
	<div class="cat_form_element">
		<select name="category_customize">
			<?php categorylist($feed_setting['category_customize']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Defense</label>
	</div>
	<div class="cat_form_element">
		<select name="category_defense">
			<?php categorylist($feed_setting['category_defense']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Dress-Up</label>
	</div>
	<div class="cat_form_element">
		<select name="category_dress_up">
			<?php categorylist($feed_setting['category_dress_up']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Driving / Racing</label>
	</div>
	<div class="cat_form_element">
		<select name="category_driving">
			<?php categorylist($feed_setting['category_driving']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Education</label>
	</div>
	<div class="cat_form_element">
		<select name="category_education">
			<?php categorylist($feed_setting['category_education']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Fighting</label>
	</div>
	<div class="cat_form_element">
		<select name="category_fighting">
			<?php categorylist($feed_setting['category_fighting']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Jigsaw</label>
	</div>
	<div class="cat_form_element">
		<select name="category_jigsaw">
			<?php categorylist($feed_setting['category_jigsaw']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Multiplayer</label>
	</div>
	<div class="cat_form_element">
		<select name="category_multiplayer">
			<?php categorylist($feed_setting['category_multiplayer']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Other</label>
	</div>
	<div class="cat_form_element">
		<select name="category_other">
			<?php categorylist($feed_setting['category_other']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Puzzle</label>
	</div>
	<div class="cat_form_element">
		<select name="category_puzzle">
			<?php categorylist($feed_setting['category_puzzle']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Rhythm</label>
	</div>
	<div class="cat_form_element">
		<select name="category_rhythm">
			<?php categorylist($feed_setting['category_rhythm']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>RPG</label>
	</div>
	<div class="cat_form_element">
		<select name="category_rpg">
			<?php categorylist($feed_setting['category_rpg']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Shooter</label>
	</div>
	<div class="cat_form_element">
		<select name="category_shooter">
			<?php categorylist($feed_setting['category_shooter']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Skill</label>
	</div>
	<div class="cat_form_element">
		<select name="category_skill">
			<?php categorylist($feed_setting['category_skill']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Sports</label>
	</div>
	<div class="cat_form_element">
		<select name="category_sports">
			<?php categorylist($feed_setting['category_sports']); ?>
		</select>
   </div>
</div>

<div class="cat_form_element_container_small">
	<div class="cat_form_lable">
		<label>Strategy</label>
	</div>
	<div class="cat_form_element">
		<select name="category_strategy">
			<?php categorylist($feed_setting['category_strategy']); ?>
		</select>
   </div>
</div>

</div>
   
<br style="clear:both;"/><br /><div class="mochi_button_container"><input class="button" name="Submit" type="submit" value="Submit" /></div>
</div>
</form>