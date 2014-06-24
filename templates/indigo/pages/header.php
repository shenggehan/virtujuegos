<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<?php include 'includes/header_data.inc.php' ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'].$setting['template_url'];?>/style.css" />
<?php if (isset($is_forum_page)) { ?>
<link rel="stylesheet" type="text/css" href="<?php echo $setting['site_url'].$setting['template_url'];?>/forums/forums.css" />
<?php } ?>

<script type="text/javascript">
	// The page has loaded, lets get ready
	$(document).ready(function() {
		$('#user_area').mouseenter(showUserMenu);
		$('#user_area').mouseleave(hideUserMenu);
		$('#featured_next').click(FeaturedNextPage);
		$('#featured_prev').click(FeaturedPrevPage);
		curFeaturedPage = 1;
		totalFeatured = $('.featured_game').length;
		if (totalFeatured > 3) {
			totalFeaturedPages = Math.ceil(totalFeatured / 3);
		}
		else {
			totalFeaturedPages = 1;
			$('#featured_next').css('opacity', '0.2');
			$('#featured_prev').css('opacity', '0.2');
		}
	});
	
	function showUserMenu() {
		$('#user_area_dropdown').css('display', 'inherit');
	}
	function hideUserMenu() {
		$('#user_area_dropdown').css('display', 'none');
	}
	function FeaturedNextPage() {
		if (curFeaturedPage != totalFeaturedPages) {
			curFeaturedPage++;
			$('#featured_games_container').animate({
				left: '-=970'
			}, 1000);
			if (curFeaturedPage == totalFeaturedPages) {
				$('#featured_next').css('opacity', '0.2');
			}
		}
		$('#featured_prev').css('opacity', '1');
	}
	function FeaturedPrevPage() {
		if (curFeaturedPage != 1) {
			curFeaturedPage--;
			$('#featured_games_container').animate({
				left: '+=970'
			}, 1000);
			if (curFeaturedPage == 1) {
				$('#featured_prev').css('opacity', '0.2');
			}
		}
		$('#featured_next').css('opacity', '1');
	}
</script>
</head>

<body>
<?php
if ($setting['site_offline'] == 1) {
	echo '<div style="background-color:#73000b;text-align:center;color:#fff;font-family:Arial;padding:10px;">Matinence mode active - site not accessible to non-admins</div>';
}
?>
	<div class="header_container">
		<div class="main_width">
			<div class="header_logo">
				<a href="<?php echo $setting['site_url'];?>"><img src="<?php echo $setting['site_url'];?>/templates/indigo/images/logo.png" alt="logo" /></a>
			</div>
			<div class="header_search">
				<form action="<?php echo $setting['site_url']?>/index.php?task=search" method="get" onsubmit="<?php echo $search_function;?>">
					<input name="task" type="hidden" value="search" />
					<div class="header_search_left">
						<input name="q" type="text" size="20" id="search_textbox" value="<?php echo $search_val;?>" onclick="clickclear(this, '<?php echo SEARCH_DEFAULT;?>')" onblur="clickrecall(this,'<?php echo SEARCH_DEFAULT;?>')" class="search_box"/> 
					</div>
					<div class="header_search_right">
						<input type="image" class="header_search_button" src="<?php echo $setting['site_url'];?>/templates/indigo/forums/images/topic_search_button.png" />
					</div>
				</form>
			</div>
		</div>
				</div>
	<div class="main_width">
		<div class="main_menu">
			<div class="pages_menu"><?php include('./includes/modules/pages_horizontal.php');?></div>
			<div class="user_area" onmouseover="showUserMenu();" id="user_area"><?php include './templates/indigo/sections/user_area.php';?></div>
		</div>
		<div class="categories_menu"><?php include('./includes/modules/categories_menu.php');?></div>
		
		<div class="ad_center">
			<?php advert('leaderboard'); ?>
		</div>