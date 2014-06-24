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

$query = mysql_query("
	SELECT ava_submissions.*, ava_users.username, ava_users.seo_url FROM ava_submissions 
	INNER JOIN ava_users
	ON ava_submissions.user=ava_users.id
	ORDER BY ava_submissions.id DESC
	LIMIT $limit;");

while ($go = mysql_fetch_array($query)) 
{

$category = mysql_query("SELECT * FROM ava_cats WHERE id=".$go['category']."");
$categorya = mysql_fetch_array($category);

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	$class = 'manage_item_extended';
}
else {
	$class = 'mochi_item';
}

$user_url = ProfileUrl($go['user'], $go['seo_url']);

$height = $go['height'] + 100;

echo '
<div id="game-'.$go['id'].'" class="'.$class.'">
	<div class="manage_column0"><a href="'.$go['thumbnail'].'"><img src="'.$go['thumbnail'].'" width="40" height="40" /></a></div>
	<div id="tgame_name'.$go['id'].'" class="submission_info">
		'.$go['name'].' <span class="submittedby">submitted by</span> <a href="'.$user_url.'" class="manage_link">'.$go['username'].'</a><br />
		'.$go['description'].'
	</div>
	
	<div class="mochi_column3" id="edit-image-'.$go['id'].'"><img src="images/dl.png" width="24" height="24" onclick="Reviewgame('.$go['id'].');"></div>
	<div class="mochi_column3"  id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>';
	
	if ($go['file'] != '') {
		echo '<div class="mochi_column3" id="play-icon-'.$go['id'].'"><img src="images/go.png" width="24" height="24" onclick="PlayGame('.$go['id'].', '.$height.');" /></div>';
	}
	else {
		echo '<div class="mochi_column3" id="play-icon-'.$go['id'].'"><img src="images/no_go.png" width="24" height="24" title="No game file uploaded" /></div>';
	}
	
	echo '<div id="edit-game-'.$go['id'].'" class="edit_game_container"></div>

</div>';

}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_submissions"),0);

$total_pages = ceil($total_results / $max_results);

echo '<form id="form1" name="form1" method="get" action="manages_ajax.php">';

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
else if ($total_pages < 1) {
	echo 'No new submissions';
}
else {
	echo '<input type="hidden" id="page" value="1">';
} 
echo '</form>';
?>