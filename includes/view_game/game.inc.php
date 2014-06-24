<?php
// Generates the game code to display to the user.

defined( 'AVARCADE_' ) or die( '' );
// Should the user be shown the game?
if ($show == 1) {
	if ($setting['play_limit'] == 1 && $user['login_status'] == 0) {
		$remaining_plays = $setting['plays'] - $newplay;
		echo '<script type="text/javascript">
			$(document).ready(function() {
				displayNotification(\''.N_TICKETS1.' '.$remaining_plays.' '.N_TICKETS2.'\', 5000, \'play\');
			});
		</script>';
	}
	// Does this game have an advert set?
	if ($row2['advert_id'] == 1) 
		$ad_id = $setting['default_ad'];
	else
		$ad_id = $row2['advert_id'];
		
	// Is the user supposed to see the ad?	
	if ($setting['user_ads'] == 1) {
		if ($user['login_status'] == 1) {
			$user_show_ad = 0;
		}
		else {
			$user_show_ad = 1;
		}
	}
	else if ($setting['user_ads'] == 2) {
		if ($user['admin'] == 1) {
			$user_show_ad = 0;
		}
		else {
			$user_show_ad = 1;
		}
	}
	else {
		$user_show_ad = 1;
	}
		
	// If an advert should be displayed, do so
	if ($ad_id != 0 && $user_show_ad == 1) {
		echo '<div id="ava-advert_container">';
		if (defined("PRELOAD_INFO")) {
			$plm = PRELOAD_INFO;
			$cts = CLICK_TO_SKIP;
		}
		else {
			$plm = 'Advertisement: Your game is loading';
			$cts = 'click here to skip';
		}
		echo '<div class="ad_info">'.$plm.' <b id="zzz">10</b>';
		
		// Can the user skip this ad?
		if ($setting['skip_ads'] == 1)
			echo ' (<a href="#" onclick="ShowGame(); return false">'.$cts.'</a>)';
			
		echo'</div>
		<script>countdown();</script>
		';
		
		$ad_query = mysql_query("SELECT * FROM ava_adverts WHERE id = $ad_id");
		$game_ad = mysql_fetch_array($ad_query);
		echo $game_ad['ad_content'];
		echo '</div><div id="ava-game_container" style="display: none;">';
	}
	// Else no ad, show game straight away
	else {
		echo '<div id="ava-game_container">';
		include('banner.php');
	}
	
	// Resize flash if required
	if ((isset($template['max_game_width'])) && ($row2['width'] > $template['max_game_width'])) {
		$gHeight = $row2['height'];
		$gWidth = $row2['width'];
	
		$h1 = ($template['max_game_width'] / $gWidth);
		$h2 = ($gHeight * $h1);
		
		$width = $template['max_game_width'];
		$height = $h2;
	}
	else {
		$width = $row2['width'];
		$height = $row2['height'];
	}
	
	// If filetype is .dcr
	if ($row2['filetype'] == 'dcr') {
		echo '<object classid="clsid:233C1507-6A77-46A4-9443-F871F945D258" codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=11,5,0,595" ID=dcrGame width='.$width.' height='.$height.' VIEWASTEXT>
            <param name=src value="'.$row2['url'].'">
            <param name=swRemote value="swSaveEnabled=\'true\' swVolume=\'true\' swRestart=\'true\' swPausePlay=\'true\' swFastForward=\'true\' swContextMenu=\'true\' ">
            <param name=swStretchStyle value=fill>
            <param name=PlayerVersion value=11>
            <PARAM NAME=bgColor VALUE=#000000> 
            <embed src="'.$row2['url'].'" bgColor=#000000  width='.$width.' height='.$height.' swRemote="swSaveEnabled=\'true\' swVolume=\'true\' swRestart=\'true\' swPausePlay=\'true\' swFastForward=\'true\' swContextMenu=\'true\' " swStretchStyle=fill
             type="application/x-director" PlayerVersion=11 pluginspage="http://www.macromedia.com/shockwave/download/"></embed>
</object>';
	}
	elseif (($row2['filetype'] == 'png') || ($row2['filetype'] == 'gif') || ($row2['filetype'] == 'jpg') || ($row2['filetype'] == 'jpeg')) {
		echo '<img src="'.$row2['url'].'" width="'.$width.'" height="'.$height.'" />';
	} 
	// File is flash
	elseif ($row2['filetype'] == 'swf') {
		// Game is part of the 1200 gamepack
		if ($row2['import'] == 1) {
			$flash_url = $setting['site_url'].'/games/'.$row2['url'].'.swf';
		}
		// Game is part of the 3200 gamepack
		else if ($row2['import'] == 3) {
			$flash_url = $setting['site_url'].'/games/'.$row2['url'];
		}
		// Not a gamepack game
		else {
			$flash_url = $row2['url'];
		}
		
		echo '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$width.'" height="'.$height.'" id="ieID">
        <param name="movie" value="'.$flash_url.'" />
        <!--[if !IE]>-->
        <object type="application/x-shockwave-flash" data="'.$flash_url.'" width="'.$width.'" height="'.$height.'" id="eID">
        <!--<![endif]-->
        <!--[if !IE]>-->
        </object>
        <!--<![endif]-->
      	</object>';

	}
	else if ($row2['filetype'] == 'unity' || $row2['filetype'] == 'unity3d') {
		echo '<script type="text/javascript" src="http://webplayer.unity3d.com/download_webplayer-3.x/3.0/uo/UnityObject.js"></script>
		<script type="text/javascript">
		<!--
		function GetUnity() {

			if (typeof unityObject != "undefined") {
				return unityObject.getObjectById("unityPlayer");
			}

			return null;
		}

		if (typeof unityObject != "undefined") {
			unityObject.embedUnity("unityPlayer", "'.$row2['url'].'", '.$row2['width'].', '.$row2['height'].');
		}
		-->
		</script>
		
		<div style="margin: auto;width: '.$row2['width'].'px;">
			<div id="unityPlayer">
				<div class="3dmissing">
					<a href="http://unity3d.com/webplayer/" title="Unity Web Player. Install now!">
						<img alt="Unity Web Player. Install now!" src="http://webplayer.unity3d.com/installation/getunity.png" width="193" height="63" />
					</a>
				</div>
			</div>
		</div>';
	}
	elseif ($row2['filetype'] == 'code') {
		echo $row2['html_code'];
	}
	else {
		echo '<iframe src="'.$row2['url'].'" width="'.$width.'" height="'.$height.'" frameborder=0></iframe>';
	}

	echo '</div>';

	
	
}
// If user is not logged in and had used up all plays, ask them to login
else {
	echo '<div class="game_not_found">'.GAME_LOGIN_TO_PLAY.' (<a href="'.$setting['site_url'].'/index.php?task=login">'.LOGIN.'</a>)</div>';
}

if ($user['login_status'] == 1 && $row2['highscores'] == 1) {
	include('mochi_widget.php');
	
}
?>
