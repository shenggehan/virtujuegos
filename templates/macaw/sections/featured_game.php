<?php


echo '<li>
         <div class="slideBOX">
	       <div style="float:left; width:135px;">
	         <div class="IMGBG"><a href="'.$featured_game['url'].'"><img class="slideIMG" src="'.$featured_game['image_url'].'" alt="" /></a></div>
	         <a href="'.$featured_game['url'].'"><img class="playnow" src="'.$setting['site_url'].'/templates/macaw/images/playnow.png" alt="Play Now!" /></a>
	       </div>
	       <div style="float:right; width: 200px;">
	         <p class="slider_title"><a href="'.$featured_game['url'].'">'.$featured_game['name'].'</a>'.$featured_game['highscore_image'].'</p>
	         <p class="slider_info">'.$featured_game['description'].'</p>
	         <span style="width: 100px; float:left; margin: 10px 0 0 0;">'.$featured_game['rating_image'].'</span>
	         <p style="float:left; margin: 5px 0 0 10px;" class="slider_info">| '.$featured_game['plays'].' Partidas</p>
	       </div>
	     </div>
	   </li>';
?>