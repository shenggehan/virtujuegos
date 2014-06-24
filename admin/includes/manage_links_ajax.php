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
$max_results = 40;
$from = (($page * $max_results) - $max_results);

if (isset($_GET['s'])) {
	$query = mysql_query("SELECT * FROM ava_links WHERE description like \"%".$_GET['s']."%\" OR name like \"%".$_GET['s']."%\" OR id like \"%".$_GET['s']."%\" ORDER BY id DESC LIMIT $from, $max_results"); 
}
else {
	$query = mysql_query("SELECT * FROM ava_links ORDER BY id DESC LIMIT $from, $max_results");
}


while ($go = mysql_fetch_array($query)) 
{

if ($go['submitter'] != 0) {
	$link_submitter = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id = $go[submitter] LIMIT 1"));
	$submitter_link = '<a href="'.ProfileUrl($link_submitter['id'], $link_submitter['seo_url']).'">'.$link_submitter['username'].'</a>';
}
else if ($go['submitter_email'] != '') {
	$submitter_link = '<a href="mailto:'.$go['submitter_email'].'">'.$go['submitter_email'].'</a>';
}
else {
	$submitter_link = '';
}

echo '
<div id="link-'.$go['id'].'" class="manage_item"><div class="manage_column0">'.$go['id'].'</div><div id="tlink_name'.$go['id'].'" class="manage_column"><a href="'.$go['url'].'" class="manage_link">'.$go['name'].'</a></div><div id="tcategory_name'.$go['id'].'" class="manage_column2"></div>

<div class="manage_column2fixed">'.$go['inbound'].'</div>
<div class="manage_column2fixed">'.$go['outbound'].'</div>

<div class="manage_column_linksubmitter">'.$submitter_link.'</div>

<div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>
<div class="manage_column3" id="edit-image-'.$go['id'].'"><img src="images/edit.png" width="24" height="24" onclick="edit_link('.$go['id'].');"></div>';

if ($go['published'] == 1) {
	echo '<div class="manage_column3" id="published-image-'.$go['id'].'"><img src="images/published.png" width="24" height="24" onclick="TogglePublished('.$go['id'].', 0);"></div>';
}
else {
	echo '<div class="manage_column3" id="published-image-'.$go['id'].'"><img src="images/unpublished.png" width="24" height="24" onclick="TogglePublished('.$go['id'].', 1);"></div>';
}

echo '<div id="edit-link-'.$go['id'].'" class="edit_game_container"></div>

</div>';

}

$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_links"),0);

$total_pages = ceil($total_results / $max_results);

if ($total_pages > 1) {

echo '<form id="form1" name="form1" method="get" action="manage_links_ajax.php">
  <label>
  <select name="page" id="page"'; echo "onchange='Loadlinks(1);return false'>";
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
?>