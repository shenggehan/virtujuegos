<?php
if ($login_status != 1) exit();

if ($_POST) {
	$message = 'Settings updated';
	if ($setting['forums_installed'] == 0 && $_POST['forums_installed'] == 1) {
		if (!is_dir('../avforums')) {
			$_POST['forums_installed'] = 0;
			$message = 'Forums were not found to be installed, make sure you have uploaded the avforums folder to your root AV Arcade directory if you have purchased them. <br /><br />Other settings have been updated';
		}
	}

	$sql = mysql_query("SELECT * FROM ava_settings");
	while ($get_setting = mysql_fetch_array($sql)) {
		if (isset($_POST[$get_setting['name']])) {
			$value = $_POST[$get_setting['name']];
			mysql_query("UPDATE ava_settings SET value = '$value' WHERE name = '$get_setting[name]'") or die (mysql_error());
		}
	}
	$sql = mysql_query("SELECT * FROM ava_settings");
	while ($get_setting = mysql_fetch_array($sql)) {
		$setting[$get_setting['name']] = $get_setting['value'];
	}
	
	echo '<div class="settings_message">'.$message.'</div>';
	
}
?>

<form id="form1" name="form1" method="post" action="?task=settings">

<div class="page_button_container"><input class="button2" name="Submit" type="submit" value="Save settings" id="submit0" /></div>
<a name="site_info"></a>
<div class="settings">
<div class="settings_h">Site info</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Site name</div><div class="settings_element"><input name="site_name" type="text" class="settings_text_box" value="<?php echo $setting['site_name']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Site URL</div><div class="settings_element"><input name="site_url" type="text" class="settings_text_box" value="<?php echo $setting['site_url']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Template</div><div class="settings_element">
<select name="template_url">
				<?php
	 	$dir = opendir('../templates');
 		while(false !== ($file = readdir($dir)))
		{
 			if($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store" && $file != "email_templates")
			{ 
				$template_short = str_replace("/templates/", "", $setting['template_url']);
				
				if ($template_short == $file) {
		 			echo '<option value="/templates/'.$file.'" selected>'.$file.'</option>'; }
				else {
					echo '<option value="/templates/'.$file.'">'.$file.'</option>'; }
 			}
 		}
 		closedir($dir);
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Site status <a href="#" target="_blank" onmouseover="Tip('Take your site offline for maintenance')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['site_offline'] == 1) { echo '
        <input name="site_offline" type="radio" value="0" /> Online
        <input name="site_offline" type="radio" value="1" checked="checked" /> Offline ';
        }
		else {
		echo'<input name="site_offline" type="radio" value="0" checked="checked" /> Online
        <input name="site_offline" type="radio" value="1" /> Offline';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Site description</div><div class="settings_element"><input name="site_description" type="text" class="settings_text_box" value="<?php echo $setting['site_description']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Site keywords</div><div class="settings_element"><input name="site_keywords" type="text" class="settings_text_box" value="<?php echo $setting['site_keywords']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Site offline message</div><div class="settings_element"><input name="offline_message" type="text" class="settings_text_box" value="<?php echo $setting['offline_message']; ?>" size="32" /></div></div><br style="clear:both" />

</div>
<br style="clear:both" />
</div>


<br /><br />
<a name="general"></a>
<div class="settings">
<div class="settings_h">General Settings</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Language</div><div class="settings_element">
<select name="language">
				<?php
	 	$dir = opendir('../language');
 		while(false !== ($file = readdir($dir)))
		{
 			if($file != "." && $file != ".." && $file != "Thumbs.db"  && $file != ".DS_Store")
			{ 				
				$ext = substr(strrchr($file, "."), 0);
  				$filename = str_replace($ext,'',$file);

				
				if ($setting['language'] == $filename) {
		 			echo '<option value="'.$filename.'" selected>'.$filename.'</option>'; }
				else {
					echo '<option value="'.$filename.'">'.$filename.'</option>'; }
 			}
 		}
 		closedir($dir);
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">SEO URLs <a href="#" onmouseover="Tip('SEO urls format the urls for better search engine optimisation. Name based are the neatest but ever so slightly more resource intensive')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<select name="seo_on">
				<?php				
				if ($setting['seo_on'] == 3) {
		 			echo '<option value="3" selected>Name based (No ID\'s reqired)</option>
		 			<option value="2">ID Based (ID\'s required in URL\'s)</option>
		 			<option value="1">Legacy (AV Arcade Free style)</option>
		 			<option value="0">None (normal PHP urls)</option>';
		 		}
		 		else if ($setting['seo_on'] == 2) {
		 			echo '<option value="3">Name based (No ID\'s reqired)</option>
		 			<option value="2" selected>ID Based (ID\'s required in URL\'s)</option>
		 			<option value="1">Legacy (AV Arcade Free style)</option>
		 			<option value="0">None (normal PHP urls)</option>';
		 		}
		 		else if ($setting['seo_on'] == 1) {
		 			echo '<option value="3">Name based (No ID\'s reqired)</option>
		 			<option value="2">ID Based (ID\'s required in URL\'s)</option>
		 			<option value="1" selected>Legacy (AV Arcade Free style)</option>
		 			<option value="0">None (normal PHP urls)</option>';
		 		}
		 		else {
		 			echo '<option value="3">Name based (No ID\'s reqired)</option>
		 			<option value="2">ID Based (ID\'s required in URL\'s)</option>
		 			<option value="1">Legacy (AV Arcade Free style)</option>
		 			<option value="0" selected>None (normal PHP urls)</option>';
		 		}
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Limit user plays <a href="#" onmouseover="Tip('Force people to sign up after playing a certain amount of games')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['play_limit'] == 1) { echo '
          <input name="play_limit" type="radio" value="1" checked="checked" />
        On 
        <input name="play_limit" type="radio" value="0" /> Off';}
		else {
		echo'<input name="play_limit" type="radio" value="1" />
        On 
        <input name="play_limit" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Unregistered play limit  <a href="#" onmouseover="Tip('The amount of games a person can play before they are forced to sign up if limit user plays is on')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<input name="plays" type="text" id="plays" value="<?php echo $setting['plays']; ?>" class="settings_text_box_small" size="32" />
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Fullscreen mode <a href="#" onmouseover="Tip('Javascript overlay allows the game to continue being played from the current point and highscore tracking. Windowed is for compatibility issues.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['fullscreen_mode'] == 1) { echo '
          <input name="fullscreen_mode" type="radio" value="1" checked="checked" />
        Javascript overlay 
        <input name="fullscreen_mode" type="radio" value="0" /> Window';}
		else {
		echo'<input name="fullscreen_mode" type="radio" value="1" />
        Javascript overlay
        <input name="fullscreen_mode" type="radio" value="0" checked="checked" /> Window';
		} ?>
</div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Homepage display <a href="#" onmouseover="Tip('Order to display games within categories on the homepage')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<select name="homepage_order">
				<?php
				if ($setting['homepage_order'] == 'random') {
		 			echo '<option value="random" selected>Random</option>
		 			<option value="newest">Newest</option>
		 			<option value="toprated">Top Rated</option>';
		 		}
		 		else if ($setting['homepage_order'] == 'newest') {
		 			echo '<option value="random">Random</option>
		 			<option value="newest" selected>Newest</option>
		 			<option value="toprated">Top Rated</option>';
		 		}
		 		else if ($setting['homepage_order'] == 'toprated') {
		 			echo '<option value="random">Random</option>
		 			<option value="newest">Newest</option>
		 			<option value="toprated" selected>Top Rated</option>';
		 		}
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Link exchange</div><div class="settings_element">
 <?php if ($setting['link_exchange'] == 1) { echo '
          <input name="link_exchange" type="radio" value="1" checked="checked" />
        On 
        <input name="link_exchange" type="radio" value="0" /> Off';}
		else {
		echo'<input name="link_exchange" type="radio" value="1" />
        On 
        <input name="link_exchange" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Show all games category</div><div class="settings_element">
 <?php if ($setting['all_games'] == 1) { echo '
          <input name="all_games" type="radio" value="1" checked="checked" />
        On 
        <input name="all_games" type="radio" value="0" /> Off';}
		else {
		echo'<input name="all_games" type="radio" value="1" />
        On 
        <input name="all_games" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Date format <a href="http://php.net/manual/en/function.date.php" target="_blank" onmouseover="Tip('Click for more info')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="date_format" type="text" class="settings_text_box_small" value="<?php echo $setting['date_format']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Featured games</div><div class="settings_element">
 <?php if ($setting['featured_games'] == 1) { echo '
          <input name="featured_games" type="radio" value="1" checked="checked" />
        On 
        <input name="featured_games" type="radio" value="0" /> Off';}
		else {
		echo'<input name="featured_games" type="radio" value="1" />
        On 
        <input name="featured_games" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Seo extension <a href="#" onmouseover="Tip('The extension on the urls to make it appears as if they are a certain file type. Leave blank to display as folders.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="seo_extension" type="text" class="settings_text_box_small" value="<?php echo $setting['seo_extension']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Games per category <a href="#" onmouseover="Tip('If on will display the number of games in each category on the main menu')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<?php if ($setting['cat_numbers'] == 1) { echo '
          <input name="cat_numbers" type="radio" value="1" checked="checked" />
        On 
        <input name="cat_numbers" type="radio" value="0" /> Off';}
		else {
		echo'<input name="cat_numbers" type="radio" value="1" />
        On 
        <input name="cat_numbers" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Allow embedding <a href="#" onmouseover="Tip('Display the code for users to embed games on their website')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['add_to_site'] == 1) { echo '
          <input name="add_to_site" type="radio" value="1" checked="checked" />
        On 
        <input name="add_to_site" type="radio" value="0" /> Off';}
		else {
		echo'<input name="add_to_site" type="radio" value="1" />
        On 
        <input name="add_to_site" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Module thumbnails <a href="#" onmouseover="Tip('Show thumbnails in the modules (like top 10 games). Will use extra bandwidth due to a number of images having to be downloaded.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['module_thumbs'] == 1) { echo '
          <input name="module_thumbs" type="radio" value="1" checked="checked" />
        On 
        <input name="module_thumbs" type="radio" value="0" /> Off';}
		else {
		echo'<input name="module_thumbs" type="radio" value="1" />
        On 
        <input name="module_thumbs" type="radio" value="0" checked="checked" /> Off';
		} ?>
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Report permissions <a href="#" onmouseover="Tip('Select who can report comments & games')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<select name="report_permissions">
				<?php				
				if ($setting['report_permissions'] == 1) {
		 			echo '<option value="1" selected>All users</option>
		 			<option value="2">Registered users only</option>
		 			<option value="3">None (turn off)</option>';
		 		}
		 		else if ($setting['report_permissions'] == 2) {
		 			echo '<option value="1">All users</option>
		 			<option value="2" selected>Registered users only</option>
		 			<option value="3">None (turn off)</option>';
		 		}
		 		else {
		 			echo '<option value="1">All users</option>
		 			<option value="2">Registered users only</option>
		 			<option value="3" selected>None (turn off)</option>';
		 		}
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Use mb_strlen <a href="#" onmouseover="Tip('If in game descriptions you see strange characters enable this')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['use_mb_strlen'] == 1) { echo '
          <input name="use_mb_strlen" type="radio" value="1" checked="checked" />
        On 
        <input name="use_mb_strlen" type="radio" value="0" /> Off';}
		else {
		echo'<input name="use_mb_strlen" type="radio" value="1" />
        On 
        <input name="use_mb_strlen" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>


<br style="clear:both" /><br /><br />
<a name="game_submissions"></a>
<div class="settings">
<div class="settings_h">Game submissions</div>
<div class="settings_left">
<div class="settings_container"><div class="settings_lable">Allow submissions <a href="#" onmouseover="Tip('Allow users to submit games to your site')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['allow_submissions'] == 1) { echo '
          <input name="allow_submissions" type="radio" value="1" checked="checked" />
        On 
        <input name="allow_submissions" type="radio" value="0" /> Off';}
		else {
		echo'<input name="allow_submissions" type="radio" value="1" />
        On 
        <input name="allow_submissions" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Submissions directory <a href="#" onmouseover="Tip('The directory where newly uploaded submissions will be stored')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="submissions_folder" type="text" class="settings_text_box" value="<?php echo $setting['submissions_folder']; ?>" size="32" /></div></div><br style="clear:both" />

</div>


</div>

<br style="clear:both" /><br /><br />
<a name="email"></a>
<div class="settings">
<div class="settings_h">Email settings</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Email Template</div><div class="settings_element">
<select name="email_template">
				<?php
	 	$dir = opendir('../templates/email_templates');
 		while(false !== ($file = readdir($dir)))
		{
 			if($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store")
			{ 
				if ($setting['email_template'] == $file) {
		 			echo '<option value="'.$file.'" selected>'.$file.'</option>'; }
				else {
					echo '<option value="'.$file.'">'.$file.'</option>'; }
 			}
 		}
 		closedir($dir);
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Email verification <a href="#" onmouseover="Tip('If on, users will need to validate their email addresses after registering')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<?php if ($setting['email_on'] == 1) { echo '
          <input name="email_on" type="radio" value="1" checked="checked" />
        On 
        <input name="email_on" type="radio" value="0" /> Off';}
		else {
		echo'<input name="email_on" type="radio" value="1" />
        On 
        <input name="email_on" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Site email address <a href="#" onmouseover="Tip('The address emails will appear sent from. Should be an email address at this<br /> domain otherwise the emails may be flagged as spam by service providers')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="admin_email" type="text" class="settings_text_box" value="<?php echo $setting['admin_email']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Email notifications <a href="#" onmouseover="Tip('If off, email notifications for friend requests, personal messages etc will be disabled. Password reset and user validation are not affected.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<?php if ($setting['email_notifications'] == 1) { echo '
          <input name="email_notifications" type="radio" value="1" checked="checked" />
        On 
        <input name="email_notifications" type="radio" value="0" /> Off';}
		else {
		echo'<input name="email_notifications" type="radio" value="1" />
        On 
        <input name="email_notifications" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

</div>


<br style="clear:both" /><br /><br />
<a name="adverts"></a>
<div class="settings">
<div class="settings_h">Adverts</div>
<div class="settings_left">
<div class="settings_container"><div class="settings_lable">Show ads <a href="#" onmouseover="Tip('Display the embedded ads on your site')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['adsense'] == 1) { echo '
          <input name="adsense" type="radio" value="1" checked="checked" />
        On 
        <input name="adsense" type="radio" value="0" /> Off';}
		else {
		echo'<input name="adsense" type="radio" value="1" />
        On 
        <input name="adsense" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Default game ad <a href="#" onmouseover="Tip('Default when a game has no set advert to display')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><select name="default_ad">
 <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY ad_name ASC");
   if ($setting['default_ad'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   		
   while($ca = mysql_fetch_array($cq)) {
   		if ($ca['id'] != 1)	{
			if ($ca['id'] == $setting['default_ad'])
				echo '<option value="'.$ca['id'].'" selected>'.$ca['ad_name'].'</option>'; 
			else 
		   		echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
		}
   }?>
</select></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Show ABG games to <a href="#" onmouseover="Tip('Show ads before games to')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<select name="user_ads">
				<?php				
				if ($setting['user_ads'] == 1) {
		 			echo '<option value="1" selected>Unregistered users only</option>
		 			<option value="2">Unregistered & Registered users</option>
		 			<option value="3">All users (including admins)</option>';
		 		}
		 		else if ($setting['user_ads'] == 2) {
		 			echo '<option value="1">Unregistered users only</option>
		 			<option value="2" selected>Unregistered & Registered users</option>
		 			<option value="3">All users (including admins)</option>';
		 		}
		 		else {
		 			echo '<option value="1">Unregistered users only</option>
		 			<option value="2">Unregistered & Registered users</option>
		 			<option value="3" selected>All users (including admins)</option>';
		 		}
 	?> 
       </select>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Users can skip ads <a href="#" onmouseover="Tip('Display a \'skip this ad\' link on ads before games')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['skip_ads'] == 1) { echo '
          <input name="skip_ads" type="radio" value="1" checked="checked" />
        On 
        <input name="skip_ads" type="radio" value="0" /> Off';}
		else {
		echo'<input name="skip_ads" type="radio" value="1" />
        On 
        <input name="skip_ads" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />
</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Leaderboard Ad <a href="#" onmouseover="Tip('Default leaderboard-position ad. Normally a 728x90 advert')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><select name="default_leaderboard">
 <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY ad_name ASC");
   if ($setting['default_leaderboard'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   		
   while($ca = mysql_fetch_array($cq)) {
   		if ($ca['id'] != 1)	{
			if ($ca['id'] == $setting['default_leaderboard'])
				echo '<option value="'.$ca['id'].'" selected>'.$ca['ad_name'].'</option>'; 
			else 
		   		echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
		}
   }?>
</select></div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Banner Ad <a href="#" onmouseover="Tip('Default banner-position ad. Normally a 468x60 advert')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><select name="default_banner">
 <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY ad_name ASC");
   if ($setting['default_banner'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   		
   while($ca = mysql_fetch_array($cq)) {
   		if ($ca['id'] != 1)	{
			if ($ca['id'] == $setting['default_banner'])
				echo '<option value="'.$ca['id'].'" selected>'.$ca['ad_name'].'</option>'; 
			else 
		   		echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
		}
   }?>
</select></div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Small square Ad <a href="#" onmouseover="Tip('Default module-position ad. Normally a 200x200 advert')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><select name="default_square">
 <?php $cq = mysql_query("SELECT * FROM ava_adverts ORDER BY ad_name ASC");
   if ($setting['default_square'] == 0)
   	    echo '<option value="0" selected>None</option>';
   else
   		echo '<option value="0">None</option>';
   		
   while($ca = mysql_fetch_array($cq)) {
   		if ($ca['id'] != 1)	{
			if ($ca['id'] == $setting['default_square'])
				echo '<option value="'.$ca['id'].'" selected>'.$ca['ad_name'].'</option>'; 
			else 
		   		echo '<option value="'.$ca['id'].'">'.$ca['ad_name'].'</option>'; 
		}
   }?>
</select></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">ABG countdown  <a href="#" onmouseover="Tip('Time (in seconds) that ads show before games')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<input name="abg_countdown" type="text" value="<?php echo $setting['abg_countdown']; ?>" class="settings_text_box_small" size="32" />
</div></div><br style="clear:both" />

</div>

<br style="clear:both" /><br /><br />
<a name="points"></a>
<div class="settings">
<div class="settings_h">Points setup</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Playing a game <a href="#" onmouseover="Tip('The points a user get when they play a game for at least 2 minutes')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_play" type="text" class="settings_text_box_small" value="<?php echo $setting['points_play']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Posting a comment <a href="#" onmouseover="Tip('The points a user get when they post a comment on a game or news article')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_comment" type="text" class="settings_text_box_small" value="<?php echo $setting['points_comment']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Sending a report <a href="#" onmouseover="Tip('The points a user get when they report a comment or game')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_report" type="text" class="settings_text_box_small" value="<?php echo $setting['points_report']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Submitting a highscore <a href="#" onmouseover="Tip('The points a user get when they submit a highscore')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_highscore" type="text" class="settings_text_box_small" value="<?php echo $setting['points_highscore']; ?>" size="32" /></div></div><br style="clear:both" />

<?php if ($setting['forums_installed'] == 1) { ?>
	<div class="settings_container"><div class="settings_lable">Forum post <a href="#" onmouseover="Tip('The points a user get when they make a post on the forums')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_forum_post" type="text" class="settings_text_box_small" value="<?php echo $setting['points_forum_post']; ?>" size="32" /></div></div><br style="clear:both" />
<?php } ?>

<div class="settings_container"><div class="settings_lable">Point earning timeout <a href="#" onmouseover="Tip('The amount of time that must pass before a user can earn points from playing/rating another game (in seconds)')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="point_spam_time" type="text" class="settings_text_box_small" value="<?php echo $setting['point_spam_time']; ?>" size="32" /></div></div><br style="clear:both" />
</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Rating a game <a href="#" onmouseover="Tip('The points a user get when they rate a game')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_rate" type="text" class="settings_text_box_small" value="<?php echo $setting['points_rate']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Referring a user <a href="#" onmouseover="Tip('The points a user get when they refer a user using their sign-up link')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_refer" type="text" class="settings_text_box_small" value="<?php echo $setting['points_refer']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Submitting a game <a href="#" onmouseover="Tip('The points a user get when they submit a game')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_submission" type="text" class="settings_text_box_small" value="<?php echo $setting['points_submission']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Challenging a friend <a href="#" onmouseover="Tip('The points a user get when they challenge a friend')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_challenge" type="text" class="settings_text_box_small" value="<?php echo $setting['points_challenge']; ?>" size="32" /></div></div><br style="clear:both" />

<?php if ($setting['forums_installed'] == 1) { ?>
	<div class="settings_container"><div class="settings_lable">Forum topic <a href="#" onmouseover="Tip('The points a user get when they post a topic on the forums')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="points_forum_topic" type="text" class="settings_text_box_small" value="<?php echo $setting['points_forum_topic']; ?>" size="32" /></div></div><br style="clear:both" />
<?php } ?>

</div></div>

<br style="clear:both" /><br /><br />
<a name="forums"></a>
<div class="settings">
<div class="settings_h">
	Forums
	<?php if ($setting['forums_installed'] == 0) echo '(Paid Add-on)';?>
</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Forums installed <a href="#" onmouseover="Tip('If you have purchased the forums add-on and uploaded its files you can enable them here. Enabling the forums without having the files uploaded will break things.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['forums_installed'] == 1) { echo '
          <input name="forums_installed" type="radio" value="1" checked="checked" />
        On 
        <input name="forums_installed" type="radio" value="0" /> Off';}
		else {
		echo'<input name="forums_installed" type="radio" value="1" />
        On 
        <input name="forums_installed" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<?php if ($setting['forums_installed'] == 1) { ?>

<div class="settings_container"><div class="settings_lable">Topics per page <a href="#" onmouseover="Tip('The number of topics shown in forums and search')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="topics_per_page" type="text" class="settings_text_box_small" value="<?php echo $setting['topics_per_page']; ?>" size="32" /></div></div><br style="clear:both" />


<div class="settings_container"><div class="settings_lable">Limit double posts <a href="#" onmouseover="Tip('If set to on, a user will only be able to double post after the time you set on the right. If off, a user can double post at any time.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['allow_double_posts'] == 0) { echo '
          <input name="allow_double_posts" type="radio" value="0" checked="checked" />
        On 
        <input name="allow_double_posts" type="radio" value="1" /> Off';}
		else {
		echo'<input name="allow_double_posts" type="radio" value="0" />
        On 
        <input name="allow_double_posts" type="radio" value="1" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Override template <a href="#" onmouseover="Tip('Set if you want to use a different template for the forums')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
<select name="forum_template">
		<option value="default">Don't override</option>
				<?php
	 	$dir = opendir('../templates');
 		while(false !== ($file = readdir($dir)))
		{
 			if($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store" && $file != "email_templates")
			{ 
				$template_short = str_replace("/templates/", "", $setting['forum_template']);
				
				if ($template_short == $file) {
		 			echo '<option value="/templates/'.$file.'" selected>'.$file.'</option>'; }
				else {
					echo '<option value="/templates/'.$file.'">'.$file.'</option>'; }
 			}
 		}
 		closedir($dir);
 	?> 
       </select>
</div></div><br style="clear:both" />
<?php } ?>
</div>

<?php if ($setting['forums_installed'] == 1) { ?>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Flood control time <a href="#" onmouseover="Tip('The amount of time (in seconds) that must pass before a user can make another post')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="flood_control_time" type="text" class="settings_text_box_small" value="<?php echo $setting['flood_control_time']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Posts per page <a href="#" onmouseover="Tip('The number of posts shown in topics and search')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="posts_per_page" type="text" class="settings_text_box_small" value="<?php echo $setting['posts_per_page']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Double post time <a href="#" onmouseover="Tip('The amount of time (in seconds) that must pass before a user can double post in the same topic. Only applicable if limit double posts is set to on.')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="flood_control_time" type="text" class="settings_text_box_small" value="<?php echo $setting['flood_control_time']; ?>" size="32" /></div></div><br style="clear:both" />

</div>
</div>
<?php } ?>

<br style="clear:both" /><br /><br />
<a name="facebook"></a>
<div class="settings">
<div class="settings_h">Facebook connect</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Use Facebook connect <a href="#" onmouseover="Tip('Allow users to login with their Facebook account')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['facebook_on'] == 1) { echo '
          <input name="facebook_on" type="radio" value="1" checked="checked" />
        On 
        <input name="facebook_on" type="radio" value="0" /> Off';}
		else {
		echo'<input name="facebook_on" type="radio" value="1" />
        On 
        <input name="facebook_on" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Application ID <a href="#" onmouseover="Tip('Go to http://www.facebook.com/apps/application.php?id=2345053339 to get this key')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="facebook_appid" type="text" class="settings_text_box_captcha" value="<?php echo $setting['facebook_appid']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Secret key <a href="#" onmouseover="Tip('Go to http://www.facebook.com/apps/application.php?id=2345053339 to get this key')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="facebook_secret" type="text" class="settings_text_box_captcha" value="<?php echo $setting['facebook_secret']; ?>" size="32" /></div></div><br style="clear:both" />

</div>
</div>



<br style="clear:both" /><br /><br />
<a name="captcha"></a>
<div class="settings">
<div class="settings_h">reCaptcha</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Use reCaptcha <a href="#" onmouseover="Tip('Display reCaptcha on the register form')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['use_captcha'] == 1) { echo '
          <input name="use_captcha" type="radio" value="1" checked="checked" />
        On 
        <input name="use_captcha" type="radio" value="0" /> Off';}
		else {
		echo'<input name="use_captcha" type="radio" value="1" />
        On 
        <input name="use_captcha" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Public key <a href="#" onmouseover="Tip('Go to recaptcha.net to get this key')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="captcha_pubkey" type="text" class="settings_text_box_captcha" value="<?php echo $setting['captcha_pubkey']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Private key <a href="#" onmouseover="Tip('Go to recaptcha.net to get this key')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="captcha_privkey" type="text" class="settings_text_box_captcha" value="<?php echo $setting['captcha_privkey']; ?>" size="32" /></div></div><br style="clear:both" />

</div>
</div>

<br style="clear:both" /><br /><br />
<div class="settings">
<div class="settings_h">Question & Answer Captcha</div>
<div class="settings_left">

<div class="settings_container"><div class="settings_lable">Use Q&A Captcha <a href="#" onmouseover="Tip('Force users to answer a question of your choosing when they register to test if they are a bot')" onmouseout="UnTip()">[?]</a></div><div class="settings_element">
 <?php if ($setting['use_qa_captcha'] == 1) { echo '
          <input name="use_qa_captcha" type="radio" value="1" checked="checked" />
        On 
        <input name="use_qa_captcha" type="radio" value="0" /> Off';}
		else {
		echo'<input name="use_qa_captcha" type="radio" value="1" />
        On 
        <input name="use_qa_captcha" type="radio" value="0" checked="checked" /> Off';
		} ?>
</div></div><br style="clear:both" />

</div>

<div class="settings_right">

<div class="settings_container"><div class="settings_lable">Question <a href="#" onmouseover="Tip('The question you want users to answer when registering')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="qa_captcha_question" type="text" class="settings_text_box_captcha" value="<?php echo $setting['qa_captcha_question']; ?>" size="32" /></div></div><br style="clear:both" />

<div class="settings_container"><div class="settings_lable">Answers <a href="#" onmouseover="Tip('The correct answers to the question, each seperated by a comma')" onmouseout="UnTip()">[?]</a></div><div class="settings_element"><input name="qa_captcha_answers" type="text" class="settings_text_box_captcha" value="<?php echo $setting['qa_captcha_answers']; ?>" size="32" /></div></div><br style="clear:both" />

</div>
</div>


<br style="clear:both" /><br />
<br /><br />
<a name="other"></a>
<div class="settings_h">Other options</div><br />
These only need to be run if you notice a problem<br/>
<div class="other_options"><a href="index.php?task=recalc_urls">Recalculate URL's</a><a href="index.php?task=calc_ratings">Recalculate game ratings</a>
<?php if ($setting['forums_installed'] == 1) {
	echo '<a href="index.php?task=refresh_forums">Refresh forums counters</a>';
}?>
</div>

<div class="settings_jumplist">
	<div class="settings_jl_left">
	Jump to: <a href="#site_info">Site info</a> | <a href="#general">General</a> | <a href="#game_submissions">Game Submissions</a> | <a href="#email">Email</a> | <a href="#adverts">Adverts</a> | <a href="#points">Points</a> | <a href="#forums">Forums</a>	| <a href="#facebook">Facebook</a>	| <a href="#captcha">Captcha</a> | <a href="#other">Other options</a>
	</div>
	<div class="settings_jl_right">
		<input class="button2" name="Submit" type="submit" value="Save settings" id="submit0" />
	</div>
</div>
</form>