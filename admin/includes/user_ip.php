<?php
include '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

$id = intval($_POST['id']);
			
$sql = mysql_query("
(SELECT ip FROM ava_comments WHERE user = $id) UNION
(SELECT ip FROM ava_news_comments WHERE user = $id) UNION
(SELECT ip FROM ava_ratings WHERE user_id = $id) UNION
(SELECT ip FROM ava_messages WHERE sender_id = $id) UNION
(SELECT lastip FROM ava_users WHERE id = $id)");

echo 'IP addresses used by this person<br />';
while($row = mysql_fetch_array($sql)) 
{
	if ($row['ip'] != '') {
		echo '<a href="#page=1&ip='.$row['ip'].'">'.$row['ip'].'</a> &nbsp;';
	}
}
?>