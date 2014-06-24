<?php
$parents = array();
$i = 1;

function ForumRecursive($forum) {
	global $parents, $i;
	if ($forum['parent_id'] != 0) {
		$parent_forum = mysql_fetch_array(mysql_query("SELECT * FROM ava_forums WHERE id = $forum[parent_id]"));
		$parent_forum['url'] = ForumUrl($parent_forum['id'], $parent_forum['seo_url'], 1);
		$parents[$i] = '<a href="'.$parent_forum['url'].'">'.$parent_forum['name'].'</a>';
		if ($i == 1 && $_GET['task'] == 'forum') {
			$parents[$i] .= ' &#172;';
		}
		else {
			$parents[$i] .= ' &raquo; ';
		}
		$i++;
		
		if ($parent_forum['parent_id'] != 0) {
			ForumRecursive($parent_forum);
		}
	}
	
	return $parents;
}

if ($setting['seo_on'] == 0) {
	$forums_url = '/?task=forums';
}
else {
	$forums_url = '/forums';
}

if ($_GET['task'] == 'topic') {
	$parents = ForumRecursive($forum);
	
	echo '<a href="'.$setting['site_url'].$forums_url.'">'.FORUMS.'</a> &raquo; ';

	foreach (array_reverse($parents) as $parent_forum) {
		echo $parent_forum;
	}

	echo '<a href="'.$forum['url'].'" id="forum_url">'.$forum['name'].'</a> &#172;';
}
else if ($_GET['task'] == 'forum') {
	$main_forum_link = '<a href="'.$setting['site_url'].$forums_url.'">'.FORUMS.'</a>';
	
	if ($forum['parent_id'] == 0) {
		$main_forum_link .= ' &#172; ';
	}
	else {
		$main_forum_link .= ' &raquo; ';
	}
	
	echo $main_forum_link;

	$parents = ForumRecursive($forum);

	foreach (array_reverse($parents) as $parent_forum) {
		echo $parent_forum;
	}
}
else {
	echo '<a href="'.$setting['site_url'].$forums_url.'">'.FORUMS.'</a> &#172; ';
}
?>