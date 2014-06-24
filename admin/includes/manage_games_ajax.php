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
$limit = "$from, $max_results";

if (isset($_GET['s'])) {
	$where = "(description like \"%".$_GET['s']."%\" OR name like \"%".$_GET['s']."%\" OR id like \"%".$_GET['s']."%\") ";
}
else if (isset($_GET['id'])) {
	$where = "id <= $_GET[id] ";
	$limit = '30';
}
else {
	$where = "1 = 1 ";
}
if (isset($_GET['cat']) && $_GET['cat'] == 'Featured') {
	$where .= "AND featured = 1";
}
else if (isset($_GET['cat']) && $_GET['cat'] == 'Highscores') {
	$where .= "AND highscores = 1";
}
else if (isset($_GET['cat']) && $_GET['cat'] != 'All') {
	$where .= "AND category_id = '$_GET[cat]'";
}

$query = mysql_query("SELECT * FROM ava_games WHERE $where ORDER BY id DESC LIMIT $limit");

while ($go = mysql_fetch_array($query)) 
{

$category = mysql_query("SELECT * FROM ava_cats WHERE id=".$go['category_id']."");
$categorya = mysql_fetch_array($category);

$url = GameUrl($go['id'], $go['seo_url'], $go['category_id']);

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	$class = 'manage_item_extended';
}
else {
	$class = 'manage_item';
}

echo '
<div id="game-'.$go['id'].'" class="'.$class.'"><div class="manage_column0">'.$go['id'].'</div><div id="tgame_name'.$go['id'].'" class="manage_column"><a href="'.$url.'" class="manage_link">'.$go['name'].'</a></div><div id="tcategory_name'.$go['id'].'" class="manage_column2"><a href="#page=1&cat='.$categorya['id'].'">'.$categorya['name'].'</a></div>

<div class="manage_column3" id="edit-image-'.$go['id'].'">';

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	echo '<img src="images/close.png" width="24" height="24" onclick="close_edit('.$go['id'].');">';
}
else {
	echo '<img src="images/edit.png" width="24" height="24" onclick="edit_game('.$go['id'].');">';
}

echo '</div>
<div class="manage_column3"  id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>
<div class="manage_column3" id="feature_icon'.$go['id'].'">';

if ($go['featured'] == 0) { 
	echo '<img src="images/feature.png" width="24" height="24" onclick="FeatureGame('.$go['id'].', 1);"></div>';
}
else {
	echo '<img src="images/feature_on.png" width="24" height="24" onclick="FeatureGame('.$go['id'].', 0);"></div>';
}

if ($go['published'] == 1) {
	echo '<div class="manage_column3" id="published-image-'.$go['id'].'"><img src="images/published.png" width="24" height="24" onclick="TogglePublished('.$go['id'].', 0);"></div>';
}
else {
	echo '<div class="manage_column3" id="published-image-'.$go['id'].'"><img src="images/unpublished.png" width="24" height="24" onclick="TogglePublished('.$go['id'].', 1);"></div>';
}

echo '<div class="manage_column4"  id="comments-image-'.$go['id'].'"><img src="images/comments.gif" width="24" height="24" onclick="gotourl(\'index.php?task=manage_comments#page=1&id='.$go['id'].'\')"></div>';

if ($go['highscores'] == 1) {
	echo '<div class="manage_column3"  id="delete-image-'.$go['id'].'"><img src="images/highscores.png" width="22" height="23" onclick="gotourl(\'?task=manage_highscores&id='.$go['id'].'#page=1&leaderboard=default&game='.$go['id'].'\')"></div>';
}

echo '<div id="edit-game-'.$go['id'].'" class="edit_game_container">';

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	$noajax = 1;
	include('edit_game.php');
}

echo '</div>

</div>';

}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE $where"),0);

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