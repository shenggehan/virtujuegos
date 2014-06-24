<div id="thetop"></div>
<?php
if (!isset($core_admin)) {
	require_once '../../config.php';
	include ('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
	if ($setting['forums_installed'] == 1)
		include '../../avforums/forum_core.php';
}

if (!isset($_GET['page'])) {
	$page = 1;
}
else if ($_GET['page'] == '') {
	$page = 1;
} else {
	$page = $_GET['page'];
}

$max_results = 20;
$from = (($page * $max_results) - $max_results);

if ($_GET['type'] == 'comments') {
	$type = 'WHERE (type = 2 OR type = 3)';
}
else if ($_GET['type'] == 'games') {
	$type = 'WHERE type = 1';
}
else if ($_GET['type'] == 'posts') {
	$type = 'WHERE type = 4';
}
else if ($_GET['type'] == 'users') {
	$type = 'WHERE type = 5';
}
else if ($_GET['type'] == 'pms') {
	$type = 'WHERE type = 6';
}
else if ($_GET['type'] == 'all') {
	$type = '';
}

$query = mysql_query("SELECT * FROM ava_reported $type ORDER BY id DESC LIMIT $from, $max_results");

while ($report = mysql_fetch_array($query)) {
	if ($report['user'] == 0) {
		$report_user = 'Anonymous';
		$user_id = 0;
	}
	else {
		$get_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$report['user']));
		$report_user = '<a href="'.ProfileUrl($get_user['id'], $get_user['seo_url']).'">'.$get_user['username'].'</a>';
		$user_id = $get_user['id'];
	}

	if ($report['type'] == 4) {
		$get_post = mysql_fetch_array(mysql_query("SELECT * FROM ava_posts WHERE id=".$report['link_id']));
		$get_topic = mysql_fetch_array(mysql_query("SELECT * FROM ava_topics WHERE id=".$get_post['topic']));
		$name = '<a href="'.TopicUrl($get_topic['id'], $get_topic['seo_url'], $get_topic['forum_id'], 1).'#'.$get_post['id'].'"/>'.$get_topic['title'].'</a>';
		$get_post_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$get_post['user_id']));
	}
	elseif ($report['type'] == 1) {
		$get_game = mysql_fetch_array(mysql_query("SELECT * FROM ava_games WHERE id=".$report['link_id']));
		$game_url = GameUrl($get_game['id'], $get_game['seo_url'], $get_game['category_id']);
	}
	elseif ($report['type'] == 2 || $report['type'] == 3) {
		if ($report['type'] == 2) {
			$get_comment = mysql_fetch_array(mysql_query("SELECT * FROM ava_comments WHERE id=".$report['link_id']));
			$get_game = mysql_fetch_array(mysql_query("SELECT * FROM ava_games WHERE id=".$get_comment['link_id']));
			$name = '<a href="'.GameUrl($get_game['id'], $get_game['seo_url'], $get_game['category_id']).'#comment'.$get_comment['id'].'"/>'.$get_game['name'].'</a>';
		}
		else {
			$get_comment = mysql_fetch_array(mysql_query("SELECT * FROM ava_news_comments WHERE id=".$report['link_id']));
			$get_news = mysql_fetch_array(mysql_query("SELECT * FROM ava_news WHERE id=".$get_comment['link_id']));
			$name = '<a href="'.NewsUrl($get_news['id'], $get_news['seo_url']).'#comment'.$get_comment['id'].'"/>'.$get_news['title'].'</a>';
		}
		$get_comment_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$get_comment['user']));
	}
	elseif ($report['type'] == 5) {
		$get_reported_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$report['link_id']));
		$reported_user_url = ProfileUrl($get_reported_user['id'], $get_reported_user['seo_url']);
	}
	elseif ($report['type'] == 6) {
		$get_pm = mysql_fetch_array(mysql_query("SELECT * FROM ava_messages WHERE id=".$report['link_id']));
		$get_pm_user = mysql_fetch_array(mysql_query("SELECT * FROM ava_users WHERE id=".$get_pm['sender_id']));
	}
	
	include 'report_item.php';
	
}

if (isset($_GET['id'])) {
	$total_results = mysql_num_rows(mysql_query("SELECT * FROM ava_reported $type AND id <= $_GET[id]"));
}
else {
	$total_results = mysql_num_rows(mysql_query("SELECT * FROM ava_reported $type"));
}

$total_pages = ceil($total_results / $max_results);

if ($total_pages > 1) {

	echo '<form id="form1" name="form1" method="get" action="manage_reported_ajax.php">
  <label>
  <select name="page" id="page"'; echo "onchange='ChangePage()'>";
	for ($i = 1; $i <= $total_pages; $i++) {
		if ($i == $page)
			echo '<option value="'.$i.'" selected>'.$i.'</option> ';
		else 
			echo '<option value="'.$i.'">'.$i.'</option> ';
	}
	echo "  </select>
  </label>

</form>";
}
else {
	echo '<input type="hidden" id="page" value="1">';
}
?>