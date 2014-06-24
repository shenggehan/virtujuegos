<div id="thetop"></div>
<?php 
if (!isset($core_admin)) {
	require_once '../../config.php';
	include ('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
}

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


$query = mysql_query("SELECT * FROM ava_leaderboards LIMIT $from, $max_results");

while ($go = mysql_fetch_array($query)) {
	$lb_game = mysql_fetch_array(mysql_query("SELECT * FROM ava_games WHERE id= $go[game_id]"));
	$score_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_highscores WHERE game = $go[game_id] AND leaderboard = '$go[leaderboard_id]'"),0);
	
	$url = GameUrl($lb_game['id'], $lb_game['seo_url'], $lb_game['category_id']);

		echo '
<div id="leaderboard-'.$go['id'].'" class="manage_item"><div class="manage_column0">'.$go['id'].'</div><div id="tgame_name'.$go['id'].'" class="manage_lb_column_gamename"><a href="'.$url.'" class="manage_link">'.$lb_game['name'].'</a></div><div id="tcategory_name'.$go['id'].'" class="manage_lb_column2">'.$go['leaderboard_name'].'</div>
<div id="tdate'.$go['id'].'" class="manage_lb_column_date">'.$score_count.'</div>
<div class="manage_column3" id="edit-image-'.$go['id'].'"><img src="images/edit.png" width="24" height="24" onclick="gotourl(\'?task=manage_highscores&id='.$go['game_id'].'#page=1&leaderboard='.$go['leaderboard_id'].'&game='.$go['game_id'].'\')"></div>
<div class="manage_column3"  id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>';

	echo '<div id="edit-leaderboard-'.$go['id'].'" class="edit_game_container"></div>

	</div>';

}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards"),0);

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

?>