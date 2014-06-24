<?php
include '../../config.php';
include '../core.php';

$id = intval($_POST['id']);
mysql_query("UPDATE ava_links SET outbound = outbound + 1 WHERE id = $id");
?>