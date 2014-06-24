<div id="thetop"></div>
<?php 
if (!isset($core_admin)) {
	require_once '../../config.php';
	include ('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
}
$id = $_GET['game'];

if(!isset($_GET['page'])){
    $page = 1;
}
else if($_GET['page'] == ''){
    $page = 1;
} else {
    $page = $_GET['page'];
}
$max_results = 30;
$from = (($page * $max_results) - $max_results);


$lb_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards WHERE game_id = $id LIMIT 1"),0);
if ($lb_count != 0) {

	if ((isset($_GET['leaderboard'])) && ($_GET['leaderboard'] != 'default')) {
		$lb_id = $_GET['leaderboard'];
		$leaderboard = mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $id AND leaderboard_id = '$lb_id'");
	}
	else {
		$leaderboard = mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $id LIMIT 1");
	}
	$get_leaderboard = mysql_fetch_array($leaderboard);
	$lb_id = $get_leaderboard['leaderboard_id'];

	$query = mysql_query("SELECT * FROM ava_highscores WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]' ORDER BY score $get_leaderboard[order_by] LIMIT $from, $max_results");

	while ($go = mysql_fetch_array($query)) {
		$hs_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id= $go[user]"));
		$date = FormatDate($go['date'], 'admin_date');
		$url = ProfileUrl($hs_user['id'], $hs_user['seo_url']);

		echo '
<div id="score-'.$go['id'].'" class="manage_item"><div class="manage_column0">'.$go['id'].'</div><div id="tgame_name'.$go['id'].'" class="manage_hs_column_username"><a href="'.$url.'" class="manage_link">'.$hs_user['username'].'</a></div><div id="tcategory_name'.$go['id'].'" class="manage_hs_column2">'.$go['score'].'</div>
<div id="tdate'.$go['id'].'" class="manage_hs_column_date">'.$date.'</div>

<div class="manage_column3"  id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteScore('.$go['id'].');"></div>';

		echo '<div id="edit-score-'.$go['id'].'" class="edit_game_container">';

		echo '</div>

		</div>';

	}

	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_highscores WHERE game = $id AND leaderboard = '$get_leaderboard[leaderboard_id]'"),0);

	$total_pages = ceil($total_results / $max_results);

	echo '<form id="form1" name="form1" method="get" action="manage_games_ajax.php">';

	if ($total_pages > 1) {
  		echo '<label>
 		<select name="page" id="page"'; echo "onchange='goTo(this.value, 1);return false'>";
		for($i = 1; $i <= $total_pages; $i++){
			if($i == $page) {
           		echo '<option value="'.$i.'" selected>'.$i.'</option> ';
        	}
        	else {
        		echo '<option value="'.$i.'">'.$i.'</option> ';
        	}
    	}
		echo "  </select>
  		</label>";
	}
	else {
		echo '<input type="hidden" id="page" value="1">';
	} 
	echo '</form>';
}
else {
	echo 'No highscores found';
}
?>