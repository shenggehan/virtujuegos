<?php
$ct = 0;
$sql = mysql_query("SELECT * FROM ava_users WHERE id != '1' ORDER BY 0+points desc LIMIT 5");
while($row = mysql_fetch_array($sql)) {
	$ct = $ct + 1;
	$seo_name = seoname($row['username']);
	
	if (strlen($row['username']) > $template['player_module_max_chars']) {
		$name = substr($row['username'], 0, $template['player_module_max_chars']); //."...";
	}
	else {
		$name = $row['username']; 
	}
	
	
	
	$username = htmlspecialchars($name);

        $avatar = ('uploads/avatars/'.$row['avatar'].'');
        
        if ($setting['module_thumbs'] == 1) {
		$avatar = '<img class="sidebar_memberIMG" src="'.AvatarUrl($row['avatar'], $row['facebook'], $row['facebook_id']).'"  />';
	}
	else {
		$avatar = '';
	}

			
	if ($setting['seo_on'] == 0) {
		$url = 'index.php?task=profile&amp;id='.$row['id'];
	}
	else {
		$url = $setting['site_url'].'/profile/'.$row['id'].'/'.$seo_name.$setting['seo_extension'];
	}

	
	//show trophy for the top 3 players of the site and numbers for the 4th to the 10th. 
	if($ct == 1){ 			//first position
             echo '<li class="top_medals"><a href="'.$url.'">'.$avatar.'</a>';
             echo '<div class="medalbox"><img class="medal_gold" src="'.$setting['site_url'].'/templates/macaw/images/medal_gold.png" alt="" /></div>';
             echo '<a href="'.$url.'">'.$username.'</a><br />';
	} else if ($ct == 2){ 		//second position
             echo '<li class="top_medals"><a href="'.$url.'">'.$avatar.'</a>';
             echo '<div class="medalbox"><img class="medal_gold" src="'.$setting['site_url'].'/templates/macaw/images/medal_silver.png" alt="" /></div>';
             echo '<a href="'.$url.'">'.$username.'</a><br />';
	} else if($ct == 3){		//third position
             echo '<li class="top_medals"><a href="'.$url.'">'.$avatar.'</a>';
             echo '<div class="medalbox"><img class="medal_gold" src="'.$setting['site_url'].'/templates/macaw/images/medal_bronze.png" alt="" /></div>';
             echo '<a href="'.$url.'">'.$username.'</a><br />';
	} else if($ct == 10){		//tenth position
	     echo '<li class="other_medals"><a href="'.$url.'">'.$avatar.'</a>';
             echo $ct.'<div class="medalbox">&ordm;th</div> <a href="'.$url.'">'.$username.'</a><br />';
	} else { 			//positions from 4th to 9th
	     echo '<li class="other_medals"><a href="'.$url.'">'.$avatar.'</a>';
             echo '<div class="medalbox">'.$ct.'th</div> <a href="'.$url.'">'.$username.'</a><br />';
	}
	//end of trophy images

	if ($row['points'] != '') {
		echo ' ('.$row['points'].' '.POINTS.')';
	}
	else {
		echo ' (0 '.POINTS.')';
	}
	echo '</li>';
}
?>








