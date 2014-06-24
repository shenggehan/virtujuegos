<?php
include '../../config.php';
include '../../includes/core.php';
include('../admin_functions.php');
include '../secure.php';
if ($login_status != 1) exit();

$forum_name = escape($_POST['forum_name']);
$forum_description = escape($_POST['forum_description']);

$parent_forums = GetForumParents($_POST['parent_forum']);

if (!isset($_POST['read_only'])) {
	$_POST['read_only'] = 0;
}

if ($_POST['id'] == 0) {
	$seo_url = create_seoname($_POST['forum_name'], 0, 'forum');
	mysql_query("INSERT INTO ava_forums (name, description, forum_order, parent_id, parents, seo_url, read_only) VALUES ('$forum_name', '$forum_description', 1, $_POST[parent_forum], '$parent_forums', '$seo_url', '$_POST[read_only]')");
}
else {
	$seo_url = create_seoname($_POST['forum_name'], $_POST['id'], 'forum');
	mysql_query("UPDATE ava_forums SET name = '$forum_name', description = '$forum_description', parent_id = '$_POST[parent_forum]', parents = '$parent_forums', seo_url = '$seo_url', read_only = '$_POST[read_only]' WHERE id = $_POST[id]") or die (mysql_error());
}

$all_forums = mysql_query("SELECT * FROM ava_forums");
while ($forum = mysql_fetch_array($all_forums)) {
	$parents = '';
	$parent_forums = GetForumParents($forum['parent_id']);
	$parents = '';
	$child_forums = GetForumParents($forum['id'], 'children');
	
	mysql_query("UPDATE ava_forums SET parents = '$parent_forums', children = '$child_forums' WHERE id = $forum[id]");
}

function GetForumParents($first, $type = 'parents') {
	global $parents;
	
	if (!isset($parents)) {
		$parents = '';
	}
	
	if ($first != 0) {
		if ($type == 'parents') {
			$col = 'id';
		}
		else {
			$col = 'parent_id';
		}
	
		$parent_forum = mysql_fetch_array(mysql_query("SELECT * FROM ava_forums WHERE $col = $first LIMIT 1"));
		
		if (isset($parent_forum['parent_id'])) {
			$parents .= ', '.$parent_forum['id'];
		}
		
		if ($parent_forum['parent_id'] != 0 && isset($parent_forum['parent_id'])) {
			if ($type == 'parents') {
				$newfirst = $parent_forum['parent_id'];
			}
			else {
				$newfirst = $parent_forum['id'];
			}
			GetForumParents($newfirst, $type);
		}
		else {
			$parents = substr($parents, 2);
		}
	}

	return $parents;
}
?>