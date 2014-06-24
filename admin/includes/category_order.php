<?php 
include '../../config.php';
include '../../includes/core.php';
include '../secure.php';
if ($login_status != 1) exit();
	
$order = intval($_POST['order']);
mysql_query("UPDATE ava_cats SET cat_order='$order' WHERE id='$_POST[id]'") or die (mysql_error());
?>