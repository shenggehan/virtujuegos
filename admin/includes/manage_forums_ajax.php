<?php
if (!isset($core_admin)) {
	require_once '../../config.php';
	include ('../../includes/core.php');
	include ('../../avforums/forum_core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
	$sub_level = 1;
}

$sql = mysql_query("SELECT * FROM ava_forums ORDER BY forum_order");
while($data = @mysql_fetch_assoc($sql)) {
	$thisref = &$refs[ $data['id'] ];

	$thisref['id'] = $data['id'];
	$thisref['data'] = $data;

	if ($data['parent_id'] == 0) {
		$list[ $data['id'] ] = &$thisref;
	} else {
		$refs[ $data['parent_id'] ]['children'][ $data['id'] ] = &$thisref;
	}
}

printForums($list);
?>