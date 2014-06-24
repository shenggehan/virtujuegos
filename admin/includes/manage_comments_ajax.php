<div id="thetop"></div>
<?php 
if (!isset($core_admin)) {
	require_once '../../config.php';
	include '../../includes/core.php';
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

if (isset($_GET['s'])) {
	$where = "comment like \"%".$_GET['s']."%\" "; 
}
else {
	$where = "1 = 1 ";
}

if (isset($_GET['id']) && ($_GET['id'] != 0)) {
	$where .= "AND link_id = $_GET[id]";
}

$query = mysql_query("SELECT * FROM ava_comments WHERE $where ORDER BY id DESC LIMIT $from, $max_results");

while ($go = mysql_fetch_array($query)) 
{

$get_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$go['user']));
$get_game = mysql_fetch_array(mysql_query("SELECT * FROM ava_games WHERE id=".$go['link_id']));
$game_url = GameUrl($get_game['id'], $get_game['seo_url'], $get_game['category_id']);

if (!isset($first_comment) && isset($_GET['id'])) {
	echo 'Showing comments for: '.$get_game['name'].' (<a href="#page=1">Show all games</a>)';
	$first_comment = 1;
}

echo '
<div id="comment-'.$go['id'].'" class="manage_user_item"><div id="tcomment_name'.$go['id'].'" class="username_column"><a href="?task=manage_users#id='.$go['user'].'">'.$get_user['username'].'</a> - <a href="'.$game_url.'">'.$get_game['name'].'</a></div><div id="tcategory_name'.$go['id'].'" class="manage_column2"></div><div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" ondblclick="DeleteComment('.$go['id'].');"></div><div class="manage_column3" id="edit-image-'.$go['id'].'"></div>

<div class="clear"></div>

<div align="left"><div id="tcomment_name'.$go['id'].'" class="manage_user_column">'.htmlspecialchars($go['comment']).'</div></div>

</div>';

}


$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_comments WHERE $where"),0);

$total_pages = ceil($total_results / $max_results);

if ($total_pages > 1) {

echo '<form id="form1" name="form1" method="get" action="manage_comments_ajax.php">
  <label>
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
  </label>
  
</form>";
}
else {
	echo '<input type="hidden" id="page" value="1">';
}
if ($total_results == 0) {
	if (isset($_GET['id'])) {
		echo 'No comments found for this game (<a href="#page=1">Show all game comments</a>)';
	}
	else {
		echo 'No comments found';
	}
}
?>