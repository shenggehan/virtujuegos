<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<?php include 'includes/header_data.inc.php' ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'];?>/templates/hightek/style.css" />
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
<div class="header_container">
	<div class="wrapper">
		<div class="pages_menu">
			<?php include('./includes/modules/pages_horizontal.php');?>
		</div>
		<div class="header">
			<div class="header_left">
				<a href="<?php echo $setting['site_url'];?>">
					<img src="<?php echo $setting['site_url'];?>/templates/hightek/images/logo.png" />
				</a>
			</div>
			<div class="header_right">
				<div class="user_area">
					<?php include './templates/hightek/sections/user_area.php';?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="wrapper">
    <div class="main_menu_container">
    	<div class="main_menu">
    		<?php include('./includes/modules/categories_menu.php');?>
    	</div>
    </div>
	
	
    <div class="content">
  		
		
		<div class="leaderboard">
			<?php advert('leaderboard'); ?>
		</div>
