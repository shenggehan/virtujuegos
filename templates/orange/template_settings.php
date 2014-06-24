<?php
$template = array();

// Template Page Definitions
$template['homepage'] = 'pages/homepage.php';
$template['view_game'] = 'pages/view_game.php';
$template['category'] = 'pages/category.php';
$template['profile'] = 'pages/profile.php';
$template['misc'] = 'pages/misc.php';
$template['news'] = 'pages/news.php';

// Sections
$template['category_game'] = 'sections/category_game.php';
$template['search_game'] = 'sections/category_game.php';
$template['news_item'] = 'sections/news_item.php';
$template['home_cat'] = 'sections/homepage_category.php';
$template['featured_game'] = 'sections/featured_game.php';
$template['home_game'] = 'sections/homepage_game.php';
$template['users_comments'] = 'sections/users_comments.php';
$template['game_comment'] = 'sections/game_comment.php';
$template['random_game'] = 'sections/random_game.php';
$template['favourite_game'] = 'sections/favourite_game.php';
$template['news_comment'] = 'sections/news_comment.php';
$template['submitted_game'] = 'sections/favourite_game.php'; // 5.5
$template['friend'] = 'sections/friend.php'; // 5.5

// Optional forms. Allows you to create your own forms rather than using the defaults
//$template['edit_profile_form'] = 'edit_profile_form.php';
//$template['register_form'] = 'register_form.php';
//$template['login_form'] = 'login_form.php';
//$template['pm_form'] = 'pm_form.php';
//$template['lost_password_form'] = 'lost_password_form.php';

// Rating stars
$template['view_game_star'] = 'star.png';
$template['view_game_half_star'] = 'half_star.png';
$template['view_game_empty_star'] = 'empty_star.png';

$template['category_star'] = 'star.png';
$template['category_half_star'] = 'half_star.png';
$template['category_empty_star'] = 'empty_star.png';

$template['homepage_star'] = 'star.png';
$template['homepage_half_star'] = 'half_star.png';
$template['homepage_empty_star'] = 'empty_star.png';

$template['featured_star'] = 'star.png';
$template['featured_half_star'] = 'half_star.png';
$template['featured_empty_star'] = 'empty_star.png';

// Highscore image
$template['highscore_image'] = '<img src="'.$setting['site_url'].'/images/trophy_smaller.png" />';

// Display settings
$template['category_columns'] = 2; // Number of game columns on the category page
$template['homepage_columns'] = 2; // Number of category columns on the homepage
$template['homepage_game_limit'] = 4; // Number of games to show per caregory on the homepage
$template['random_game_limit'] = 6; // Number of games to show in the random games section
$template['games_per_page'] = 30; // Number of games to show per page in categories
$template['comments_per_page'] = 8; // Number of comments to show per page on game pages (5.5)

$template['category_game_chars'] = 25; // The character limit for game names in categories
$template['category_game_desc_chars'] = 55; // The character limit for game descriptions in categories
$template['homepage_game_chars'] = 25; // The character limit for game names in categories
$template['homepage_game_desc_chars'] = 55; // The character limit for game descriptions on the homepage
$template['featured_game_chars'] = 25; // The character limit for featured game names (5.5)
$template['featured_game_desc_chars'] = 55; // The character limit for featured game descriptions (5.5)
$template['random_game_chars'] = 25; // The character limit for the random game names
$template['random_game_desc_chars'] = 110; // The character limit for the random game descriptions
$template['module_max_chars'] = 30; // The character limit modules (game names, news)
$template['player_module_max_chars'] = 25; // The character limit modules (game names, news)

// Module Settings
$template['categories_menu_seperator'] = ' | ';
$template['user_menu_seperator'] = '&nbsp;&nbsp;&nbsp;';
$template['pages_menu_seperator'] = ' | ';

// Forum display settings
$template['forum_last_post_chars'] = 30; // The character limit for the forum's last topic name
$template['forum_topic_title_chars'] = 60; // The character limit for the topic titles in a forum
?>