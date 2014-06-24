<! YOU DO NOT NEED TO MAKE CHANGES TO THIS FILE, AV ARCADE POPULATES THIS DATA. ENTER YOU SETTINGS IN THE ADMIN PANEL !>
<div id="leaderboard_bridge"></div>
<script src="http://xs.mochiads.com/static/pub/swf/leaderboard.js" type="text/javascript"></script>
<script type="text/javascript">
lastscore = '';
// Mochi Bridge
var options = {partnerID: "<?php echo $mochi['pubid'];?>", id: "leaderboard_bridge"};
options.userID = "<?php echo $user['id'];?>";
options.username = "<?php echo $user['username'];?>";
// optional
options.sessionID = "<?php echo $game['id'];?>";
// optional
options.gateway = "<?php echo $setting['site_url'];?>/includes/view_game/add_highscore.php";
// optional
options.profileURL = "<?php echo $user['url'];?>";
// optional
//options.logoURL = "http://www.example.com/images/icon_16x16.jpg";
// optional
options.siteURL = "<?php echo $setting['site_url'];?>";
// optional
options.siteName = "<?php echo $setting['site_name'];?>";
// user avatar
//options.thumbURL = "<?php echo $user['avatar'];?>"; 
// optional
options.callback = function (params) { 
	if (params['score'] != lastscore) {
		setTimeout("HighscorePage(<?php echo $game['id'];?>, 1, 'unspecified', '<?php echo $setting['site_url'];?>')", 500); 
		<?php
			echo 'updatePoints('.$setting['points_highscore'].', \''.N_POINTS_EARNED1.' <span style=\"font-weight:bold;\">'.$setting['points_highscore'].' '.N_POINTS_EARNED2.'</span> '.N_POINTS_EARNED_HIGHSCORE.' <a href="#" onclick="'."ShowPopup(\'ava-popup\', \'".$setting['site_url']."/includes/view_game/ajax/challenge_friend.php?id=".$id."\', \'".CHALLENGE_HEADING."\'); return false".'">'.N_POINTS_EARNED_HS_LINK.'</a>\', \'highscore\', 15000);';
		?>
		lastscore = params['score'];
		div('game_message').style.display = 'inherit';
	}
	else {
		displayNotification('<?php echo N_ALREADY_SUBMITTED;?>', 8000, 'highscore');
	}
}
// uncomment this to display global scores
// options.globalScores = "true";

// optional
// options.denyScores = "Login to Example to submit scores!";

// optional
// options.denyFriends = "true";
// optional
// options.denyChallenges = "true";

// uncomment this block for debug mode
/*
options.width = 320;
options.height = 240;
options.debug = "true";
*/
Mochi.addLeaderboardIntegration(options);
</script>