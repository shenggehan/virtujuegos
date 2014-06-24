<ul id="comment_list">
<?php
if (!defined( 'AVARCADE_' )) {
	include '../../../config.php';
	include '../../core.php';
	include '../../../language/'.$setting['language'].'.php';
	include '../../../'.$setting['template_url'].'/template_settings.php';
	$id = intval($_POST['id']);
	$location = '../../..';
	$user = getUser();
}
else {
	$location = '.';
}

$comments_per_page = $template['comments_per_page'];

if (!isset($_POST['page'])) {
	$page = 1;
}
else {
	$page = $_POST['page'];
}

$total_comments = mysql_num_rows(mysql_query("SELECT * FROM ava_comments WHERE link_id = $id"));
$from = (($page * $comments_per_page) - $comments_per_page);

$sql = mysql_query("SELECT * FROM ava_comments WHERE link_id=".$id." ORDER BY id desc LIMIT $from,$comments_per_page");
while ($row = mysql_fetch_array($sql)) {
	$the_user = mysql_query("SELECT * FROM ava_users WHERE id=".$row['user']." LIMIT 1");
	$user2 = mysql_fetch_array($the_user);
	$comment = array('username' => $user2['username'], 'content' => nl2br(htmlspecialchars($row['comment'])), 'user_points' => $user2['points']);

	$comment['user_url'] = ProfileUrl($user2['id'], $user2['seo_url']);

	if ($user['admin'] == 1) {
		$comment['delete'] = '<a href="#" onclick="DeleteComment('.$row['id'].'); return false">Delete</a>';
		$comment['report_button'] = '<a href="'.$setting['site_url'].'/admin/?task=manage_users#page=1&ip='.$row['ip'].'"><img src="'.$setting['site_url'].'/images/report.png" title="'.$row['ip'].'" style="vertical-align:middle;"/></a>';
	}
	else {
		$comment['delete'] = '';
		if ($setting['report_permissions'] == "1" || $setting['report_permissions'] == "2" && $user['login_status'] == 1) {
			$comment['report_button'] = '<a href="#" onclick="ShowPopup(\'ava-popup\', \''.$setting['site_url'].'/includes/forms/comment_report_form.php?id='.$row['id'].'&type=2\', \'Report comment\'); return false"><img src="'.$setting['site_url'].'/images/report.png" title="'.REPORT.'" style="vertical-align:middle;"/></a>';
		}
		else {
			$comment['report_button'] = '';
		}
	}

	if ($user2['avatar'] == '') {
		if ($user2['facebook'] == 1) {
			$comment['avatar_url'] = 'http://graph.facebook.com/'.$user2['facebook_id'].'/picture';
		}
		else {
			$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/default.png';
		}
	}
	else {
		$comment['avatar_url'] = $setting['site_url'].'/uploads/avatars/'.$user2['avatar'];
	}

	if ($row['date'] != '0000-00-00 00:00:00') {
		$comment['date'] = FormatDate($row['date'], 'time');
	}
	else {
		$comment['date'] = '';
	}

	echo '<a name="comment'.$row['id'].'"></a> <li id="comment-'.$row['id'].'">';
	include $location.$setting['template_url'].'/'.$template['game_comment'];
	echo '</li>';
}
?>
</ul>
<?php
$total_pages = ceil($total_comments / $comments_per_page);

if ($total_pages > 1) {

	echo '<div class="comment_pages" id="comment_pages">';

	function CommentPage($page_no, $anchor) {
		global $id, $page;
		if ($page == $page_no)
			$anchor = '<span style="text-decoration: underline;"><strong>'.$anchor.'</strong></span>';

		$return = '<p class="cmt_page_link"><a href="#" onclick="CommentPage('.$id.', '.$page_no.'); return false">'.$anchor.'</a></p> ';
		return $return;
	}

	if($page > 1){
		$prev = ($page - 1);
		echo CommentPage($prev, '&laquo; '.PREVIOUS);
	}

	if ($page > 4) {
		echo CommentPage(1,1);
	}
	if ($page > 5) {
		echo CommentPage(2,2);
	}

	$low = $page - 4;
	$high = $page + 8;

	for($i = 1; $i <= $total_pages; $i++){
		if (($i > $low) && ($i < $high)) {
			echo CommentPage($i,$i);
		}
	}

	if (($page < $total_pages - 8)) {
		$penultimate = $total_pages - 1;
		echo CommentPage($penultimate,$penultimate);
	}
	if (($page < $total_pages - 7)) {
		echo CommentPage($total_pages,$total_pages);
	}

	if($page < $total_pages){
		$next = ($page + 1);
		echo CommentPage($next,NEXT.' &raquo;');
	}
	echo '</div>';
}
?>