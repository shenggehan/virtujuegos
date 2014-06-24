<?php
require_once 'config.php';
if ($setting['play_limit'] == 1) {
	if(!isset($_COOKIE["ava_username"])) { 
		$newplay = ($_COOKIE["ava_plays"] + 1);
		setcookie("ava_plays", $newplay, time()+60*60*24*100);
			
		if ($setting['plays'] <= $_COOKIE["ava_plays"]) {
			$show = 0;
		}
		else {
			// User has not used all plays
			$show = 1;
		}
	}
	else {
		// AVA Username is set
		$show = 1;
	}
}
else {
	// No play limit
	$show = 1;
}
if ($show == 1) {
	$id = intval($_GET['id']);
	$result = mysql_query("SELECT * FROM ava_games WHERE id='".$id."'") or die (mysql_error());
	$x = mysql_fetch_assoc($result);

	if ($x['import'] == 1) {
		$url = $setting['site_url'].'/games/'.$x['url'].'.swf';
	}
	else if ($x['import'] == 3) {
		$url = $setting['site_url'].'/games/'.$x['url'];		
	}
	else {
		$url = $x['url'];
	}

	echo '<title>'.$setting['site_name'].' - '.$x['name'].'</title>';

	echo '<frameset rows="40,*" frameborder="no" border="0" framespacing="0">
  	<frame src="'.$setting['site_url'].'/includes/misc/top.php?id='.$_GET['id'].'" name="topFrame" scrolling="No" noresize="noresize" 
	id="topFrame" title="topFrame" />' ;
    echo '<frame src="'.$url.'" name="mainFrame" id="mainFrame" title="mainFrame" />' ;
	echo '</frameset>' ; ?>
	<noframes>  <body>
	</body>
	</noframes></html>
<?php } else echo 'Please login to continue playing games';?>