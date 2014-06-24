<?php
if (!isset($core_admin)) {
	include '../../../config.php';
	include '../../secure.php';
	include '../../../includes/core.php';
}
if ($login_status != 1) exit();

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

if (isset($_GET['s'])) {
	$where = "(description like \"%".$_GET['s']."%\" OR name like \"%".$_GET['s']."%\" OR id like \"%".$_GET['s']."%\") ";
}
else {
	$where = "1 = 1 ";
}
if ($_GET['cat'] != 'All') {
	$where .= "AND category = '$_GET[cat]'";
}

$query = mysql_query("SELECT * FROM ava_fgd WHERE $where AND visible = 0 ORDER BY id DESC LIMIT $from, $max_results");


while ($go = mysql_fetch_array($query)) 
{

$categorya = '';

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	$class = 'manage_item_extended';
}
else {
	$class = 'mochi_item';
}

$height = $go['height'] + 100;

echo '
<div id="game-'.$go['id'].'" class="'.$class.'"><div class="manage_column0"><img src="'.$go['thumb_url'].'" width="40" height="40"></div><div id="tgame_name'.$go['id'].'" class="mochi_column">'.$go['name'].' <span class="mochi_details">&nbsp;&nbsp;Category: '.$go['category'].'</span><br /><div class="mochi_description">'.$go['description'].'</div></div>

<div class="mochi_column3" id="play-icon-'.$go['id'].'"><img src="images/go.png" width="24" height="24" onclick="PlayGame('.$go['id'].', '.$height.');" /></div>

<div class="mochi_column3" id="download-icon-'.$go['id'].'"><img src="images/dl.png" width="24" height="24" onclick="AddGame('.$go['id'].', '."'".$go['fgd_id']."'".');" /></img></div>

<div class="mochi_column3" id="reject-icon-'.$go['id'].'"><img src="images/no.png" width="24" height="24" onclick="RejectGame('.$go['id'].');" /></div>

<div id="edit-game-'.$go['id'].'" class="edit_game_container">';

echo '</div></div>';

}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_fgd WHERE $where AND visible = '0'"),0);

$total_pages = ceil($total_results / $max_results);

if ($total_pages > 1) {

	echo '<form id="form1" name="form1" method="get" action="manage_games_ajax.php">
  	<label>
  	<select name="page" id="page"'; echo "onchange='goTo(this.value, 1);return false'>";
	for($i = 1; $i <= $total_pages; $i++){
		if ($i == $page) {
    	        echo '<option value="'.$i.'" selected="selected">'.$i.'</option> ';
    	}
    	else {
    		echo '<option value="'.$i.'">'.$i.'</option> ';
    	}
	}
	echo "  </select>
  	</label>
  
	</form>";
}
else {
	echo '<input type="hidden" id="page" value="1">';
}
?>