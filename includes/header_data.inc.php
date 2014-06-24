<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php include 'meta_data.php'; ?>

<script type="text/javascript">
<?php 

echo "
SITE_URL = '$setting[site_url]';
TEMPLATE_URL = '$setting[template_url]';
AD_COUNTDOWN = '$setting[abg_countdown]';
SEO_ON = '$setting[seo_on]';
USER_IS_ADMIN = '$user[admin]';
COMMENT_POINTS = $setting[points_comment];
POST_POINTS = $setting[points_forum_post];";

if (isset($user['new_pms']) && $user['new_pms'] == 1) {
	echo "NEW_PMS = 1; TOTAL_PMS = $user[messages]; NEW_FRS = 0;";
}
else if (isset($user['new_frs']) && $user['new_frs'] == 1) {
	echo "NEW_FRS = 1; TOTAL_FRS = $user[friend_requests]; NEW_PMS = 0; N_NEW_TOPIC = 0;";
}
else if (isset($user['new_topic']) && $user['new_topic'] == 1) {
	echo "NEW_PMS = 0; NEW_FRS = 0; N_NEW_TOPIC = $user[new_topic];";
}
else {
	echo "NEW_PMS = 0; NEW_FRS = 0; N_NEW_TOPIC = 0;";
}

if (isset($_GET['task']) && $_GET['task'] == 'view') {
	echo "ID = '".$game['id']."';";
}
elseif (isset($_GET['task']) && $_GET['task'] == 'news' && (isset($_GET['id']) || isset($_GET['name']))) {
	echo "ID = '".$news['id']."';";
}

$lang_defs = array('DELETE_FRIEND_CONFIRM', 'UNFRIENDED', 'REQUEST_SENT', 'CHALLENGE_A_FRIEND', 'CHALLENGE_SUBMITTED', 'CHALLENGE_ANOTHER', 'GAME_FAVOURITE', 'GAME_UNFAVOURITE', 'FILL_IN_FORM', 'N_COMMENT_FAST', 'N_POINTS_EARNED1', 'N_POINTS_EARNED2', 'N_POINTS_EARNED_COMMENT', 'N_ONE_NEW_PM', 'N_MULTIPLE_NEW_PMS1', 'N_MULTIPLE_NEW_PMS2', 'N_ONE_NEW_FR', 'N_MULTIPLE_NEW_FRS1', 'N_MULTIPLE_NEW_FRS2', 'N_VIEW');

if ($setting['forums_installed'] == 1) {
	array_push($lang_defs, 'QUOTE', 'CANCEL', 'ADD_REPLY', 'NEW_TOPIC', 'EDITING_POST', 'NP_LAST_PAGE', 'BB_BOLD', 'BB_ITALICS', 'BB_UNDERLINE', 'BB_FONT', 'BB_SIZE', 'BB_COLOUR', 'BB_IMAGE', 'BB_LINK', 'BB_LIST', 'BB_ALIGN', 'BB_QUOTE', 'BB_CODE', 'BB_EMOTICONS', 'BB_REMOVE_LINK', 'BB_IMAGE_URL', 'BB_TITLE', 'BB_INSERT', 'BB_CANCEL', 'BB_DISC', 'BB_CIRCLE', 'BB_SQUARE', 'BB_DECIMAL', 'BB_LEFT', 'BB_CENTER', 'BB_RIGHT', 'N_POINTS_EARNED_POST', 'N_POINTS_EARNED_TOPIC', 'N_MARKED_READ');
}

foreach($lang_defs as $string) {
	echo $string." = '".addslashes(constant($string))."';";
}
?>

<?php if(isset($_GET['task']) && $_GET['task'] == 'view') { ?>

window.setTimeout('GameAddPlay(<?php echo $id; ?>)', 10000);
window.setTimeout('UserAddPlay()', 120000);
<?php } ?>
</script>
<script type="text/javascript" src="<?php echo $setting['site_url'].'/includes/';?>jquery-1.8.2.js"></script>
<script type="text/javascript" src="<?php echo $setting['site_url'].'/includes/';?>avarcade.js"></script>

<?php if ($user['admin'] == 1) { ?>
	<script type="text/javascript" src="<?php echo $setting['site_url'].'/includes/';?>jquery.tipsy.js"></script>
<?php }

if ($setting['forums_installed'] == 1 && isset($_GET['task']) && ($_GET['task'] == 'forum' || $_GET['task'] == 'topic' || $_GET['task'] == 'forums' || $_GET['task'] == 'forum_search' || $_GET['task'] == 'edit_profile')) {
	echo '<script type="text/javascript" src="'.$setting['site_url'].'/avforums/bbeditor/menso.js"></script>
		<script type="text/javascript" src="'.$setting['site_url'].'/avforums/avforums.js"></script>
		<link rel="stylesheet" type="text/css" href="'.$setting['site_url'].'/avforums/bbeditor/mensobbcode.css" />';
	$is_forum_page = 1;
}
?>
<link rel="alternate" type="application/rss+xml" title="<?php echo $setting['site_url'];?>" href="<?php echo $setting['site_url'];?>/rss.php" />
<link rel="shortcut icon" href="<?php echo $setting['site_url'].'/favicon.ico';?>" type="image/x-icon" />
<link rel="icon" href="<?php echo $setting['site_url'].'/favicon.ico';?>" type="image/x-icon" />

<style type="text/css">
/* Game fullscreen */
.flash_popup {
	position: fixed;
	z-index: 3;
	top: 0%;
    left: 50%;
    margin: 0 auto;
}
.close_fullscreen {
	z-index: 4;
	position: fixed;
	display: none;
	top: 0px;
	right: 0px;
	background-color: #000;
	color: #fff;
	font-family: Arial;
	font-size: 18px;
	padding: 5px;
}
.close_fullscreen a {
	text-decoration: none;
	color: #fff;
}
.3dmissing {
	margin: auto;
	position: relative;
	top: 50%;
	width: 193px;
}
		
#unityPlayer {
	cursor: default;
	height: 450px;
	width: 600px;
}
</style>