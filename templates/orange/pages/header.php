<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<?php include 'includes/header_data.inc.php' ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'];?>/templates/orange/style.css" />
<?php if (isset($is_forum_page)) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'].$setting['template_url'];?>/forums/forums.css" />
<?php } ?>
</head>

<body>
<?php
if ($setting['site_offline'] == 1) {
	echo '<div style="background-color:#73000b;text-align:center;color:#fff;font-family:Arial;padding:10px;">Matinence mode active - site not accessible to non-admins</div>';
}
?>
<div class="main_container">
	<div class="header">
		<div class="logo">
			<a href="<?php echo $setting['site_url'];?>"><img src="<?php echo $setting['site_url'];?>/templates/orange/images/logo.png" width="236" height="77" alt="<?php echo $setting['site_name'];?>" /></a>
		</div>
		<div class="user_area">
			<?php include('./templates/orange/sections/user_area.php');?>
		</div>
		<br style="clear:both" />
	</div>

	<div class="menu_container">
    	<div class="categories_menu">
			<?php include('./includes/modules/categories_menu.php');?>
        </div>
		<div class="search">
			<form action="<?php echo $setting['site_url']?>/index.php?task=search" method="get" onsubmit="<?php echo $search_function;?>">
			<div class="search_contain"> 
            	<input name="q" type="text" size="20" id="search_textbox" value="<?php echo $search_val;?>" onclick="clickclear(this, '<?php echo SEARCH_DEFAULT;?>')" onblur="clickrecall(this,'<?php echo SEARCH_DEFAULT;?>')" class="search_box"/>  
            </div>

			<div id="search_button_contain"> 
            	<input id="box" type="image" name="submit" src="<?php echo $setting['site_url'];?>/templates/orange/images/search.png" /> 
            </div>

			<div>
            	<input name="task" type="hidden" value="search" />
            </div>
			</form>
		</div>
	</div>

	<div class="pages_menu">
		<?php include('./includes/modules/pages_horizontal.php'); ?>
    </div>

	<div class="leaderboard">
		<?php advert('leaderboard'); ?>
	</div>