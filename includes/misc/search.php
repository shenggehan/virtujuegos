<?php
$therow = 0;
if ($_GET['q'] && $_GET['q'] != 'Search...') {
	if (!isset($_GET['page'])) {
		$page = 1;
	}
	else {
		$page = $_GET['page'];
	}
	$from = (($page * $template['games_per_page']) - $template['games_per_page']);

	$trimmed = mysql_secure($_GET['q']);

	$total_results_search = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE description like \"%$trimmed%\" OR name like \"%$trimmed%\" AND published=1"),0);
	if ($trimmed == "" OR $trimmed == 'Search...') {
		echo '<div id="error_message">'.NOSEARCH.'</div>';
		include 'includes/forms/search_form.php';
	}
					
	else if ($total_results_search == 0) {
  		echo '<div id="error_message">'.NORESULTS.'</div>';
  		include 'includes/forms/search_form.php';
  	}

	else {
		$sql = mysql_query("SELECT * FROM ava_games WHERE description like \"%$trimmed%\" OR name like \"%$trimmed%\" AND published=1
  			ORDER BY id DESC LIMIT $from, $template[games_per_page]");
			
		echo '<div class="BOXGAMES_HORIZON" style="margin-top: 10px; display: block;"><ul>';
		while($row = mysql_fetch_array($sql)) {
 			$therow = $therow + 1;
	
			$game = GameData($row, 'category');
		
			include('.'.$setting['template_url'].'/'.$template['search_game']);

			if ($therow == $template['category_columns']) {
				echo '<br style="clear: both"/>';
				$therow = 0;
			}
		}
		echo '</ul></div>';
	
		// Pages
		$total_pages = ceil($total_results_search / $template['games_per_page']);

		if ($total_pages > 1) {

			echo '<div class="paginationBOX">';
			$url = $setting['site_url'].'/index.php?task=search&q='.$trimmed.'&page=';
	
			if($page > 1){
				$prev = ($page - 1);
				echo '<a href="'.$url.$prev.'">&laquo; '.PREVIOUS.'</a> ';
			}

			for($i = 1; $i <= $total_pages; $i++){
				if($page == $i){
        			echo '<b><a href="#">'.$i.'</a></b>';
    			} 
    			else {
					echo '<a href="'.$url.$i.'">'.$i.'</a> ';
    			}
			}

			if($page < $total_pages){
   				$next = ($page + 1);
				echo '<a href="'.$url.$next.'">'.NEXT.' &raquo;</a> ';
			}

			echo '</div>';
		}
	}
}

else {
	include 'includes/forms/search_form.php';
}
	
?>