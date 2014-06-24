<?php
echo'<li>
	        <a href="'.$game['url'].'">
	         <img class="BOXGAMES_IMG" src="'.$game['image_url'].'" alt="play '.$game['name'].'" /><br />'.$game['name'].' '.$game['highscore_image'].'</a>
	        <span style="width: 100px; height: 22px; float:left; padding: 5px 30px 0 30px;">'.$game['rating'].'</span>
	        <p class="BOXGAMES_PLAYS">'.$game['plays'].' Partidas </p>
	        </li>';
	     ?>