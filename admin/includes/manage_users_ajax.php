<div id="thetop"></div>
<?php 
require_once '../../config.php';
require_once '../../includes/core.php';
include '../secure.php';
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
	$query = mysql_query("SELECT * FROM ava_users WHERE username like \"%".$_GET['s']."%\" OR id like \"%".$_GET['s']."%\" OR lastip like \"%".$_GET['s']."%\" ORDER BY id DESC LIMIT $from, $max_results"); 
}
else if (isset($_GET['ip'])) {
	$ipid = mysql_query("
	(SELECT user FROM ava_comments WHERE ip = '$_GET[ip]') UNION
	(SELECT user FROM ava_news_comments WHERE ip = '$_GET[ip]') UNION
	(SELECT user_id AS user FROM ava_ratings WHERE ip = '$_GET[ip]') UNION
	(SELECT sender_id AS user FROM ava_messages WHERE ip = '$_GET[ip]') UNION
	(SELECT user FROM ava_reported WHERE ip = '$_GET[ip]') UNION
	(SELECT id AS user FROM ava_users WHERE lastip = '$_GET[ip]') ");
	$i = 1;
	while ($get_ipid = mysql_fetch_array($ipid)) {
		if ($get_ipid['user'] != '') {
			if ($i == 1) {
				$user_ids = $get_ipid['user'];
				$i = 2;
			}
			else {
				$user_ids .= ', '.$get_ipid['user'];
			}
		}
	}
	if ($user_ids == '') {
		$user_ids = 0;
	}
	$query = mysql_query("SELECT * FROM ava_users WHERE id IN ($user_ids) ORDER BY id DESC LIMIT $from, $max_results");
}
else if (isset($_GET['online_users'])) {
	$query = mysql_query("
	SELECT ava_users.*
	FROM ava_users
	INNER JOIN ava_usersonline
	ON ava_users.id=ava_usersonline.user_id
	ORDER BY ava_users.id");
}
else if (isset($_GET['id'])) {
	$query = mysql_query("SELECT * FROM ava_users WHERE id <= ".$_GET['id']." ORDER BY id DESC LIMIT 30");
}
else {
	$query = mysql_query("SELECT * FROM ava_users ORDER BY id DESC LIMIT $from, $max_results");
}


while ($go = mysql_fetch_array($query)) {

if (isset($_GET['id']) && ($_GET['id'] == $go['id'])) {
	$class = 'manage_user_extended';
}
else {
	$class = 'manage_item';
}

$profile_url = ProfileUrl($go['id'], $go['seo_url']);

$user_online = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_usersonline WHERE user_id = $go[id]"),0);
if ($user_online == 1) {
	$user_online_icon = '<img src="images/online.png" style="vertical-align: middle;" title="Online now" />';
}
else {
	$user_online_icon = '<img src="images/offline.png" style="vertical-align: middle;" title="Offline" />';
}

echo '
<div id="user-'.$go['id'].'" class="'.$class.'"><div class="manage_column0">'.$go['id'].'</div><div class="manage_column">'.$user_online_icon.' <span id="tuser_name'.$go['id'].'">&nbsp;<a href="'.$profile_url.'" class="manage_user">'.$go['username'].'</a></span></div>
<div class="manage_column_useractivity">'.FormatDate($go['last_activity'], 'admin_datetime').'</div>
<div class="manage_column2"><a href="#page=1&ip='.$go['lastip'].'">'.$go['lastip'].'</a></div>';

if ($go['admin'] != 1) {
if ($go['banned'] == 0) {
	echo '<div class="manage_column3" id="banned-image-'.$go['id'].'"><img src="images/published.png" width="24" height="24" onclick="ToggleBanned('.$go['id'].', 1);"></div>';
}
else {
	echo '<div class="manage_column3" id="banned-image-'.$go['id'].'"><img src="images/unpublished.png" width="24" height="24" onclick="ToggleBanned('.$go['id'].', 0);"></div>';
}
}
echo '<div class="manage_column3" id="delete-image-'.$go['id'].'"><img src="images/delete.png" width="24" height="24" onclick="DeleteAsk('.$go['id'].');"></div>

<div class="manage_column3" id="edit-image-'.$go['id'].'"><img src="images/edit.png" width="24" height="24" onclick="edit_user('.$go['id'].');"></div><div class="manage_column3" id="ip-image-'.$go['id'].'"><img src="images/globe.png" width="24" height="24" onclick="show_ips('.$go['id'].');"></div>';

echo '<div id="edit-user-'.$go['id'].'" class="edit_game_container">';

if (isset($_GET['id']) && $_GET['id'] == $go['id']) {
	include('edit_user_noajax.php');
}

echo '</div></div>';

}

if (isset($_GET['s'])) {
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_users WHERE username like \"%".$_GET['s']."%\" OR id like \"%".$_GET['s']."%\""),0);
	$search_limit = ', "'.$_GET['s'].'"';
}
else if (isset($_GET['ip'])) {
	$total_results = 1;
}
else {
	$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_users"),0);
	$search_limit = '';
}

$total_pages = ceil($total_results / $max_results);

if ($total_pages > 1) {

echo '<form id="form1" name="form1" method="get" action="manage_users_ajax.php">
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
?>