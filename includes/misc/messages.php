<?php
defined( 'AVARCADE_' ) or die( '' );
if ($user['login_status'] == 1) {

	if (isset($_GET['pm_task']) && $_GET['pm_task'] == 'delete') {
		
		$result = mysql_query("DELETE FROM ava_messages WHERE id='".$id."' AND user_id='$user[id]'");
		
		// Update user messages counter
		$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE user_id=$user[id] AND `read`=0"),0);
		$update = mysql_query("UPDATE ava_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
		
		echo '<div id="pm_task_complete">'.PM_DELETED.'</div>';
	}
	else if (isset($_GET['pm_task']) && $_GET['pm_task'] == 'unread') {
			$sql = mysql_query("SELECT * FROM ava_messages WHERE id=".$id."");
			$row = mysql_fetch_array($sql);
			if ($row['read'] == 1) {
				mysql_query('UPDATE `ava_messages` SET `read` = \'0\' WHERE `ava_messages`.`id` = '.$id.' LIMIT 1;');
				
				// Update user messages counter
				$msg_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE user_id=$user[id] AND `read`=0"),0);
				$update = mysql_query("UPDATE ava_users SET messages=$msg_count WHERE id='$user[id]'") or die (mysql_error());
				echo '<div id="pm_task_complete">'.PM_MAU.'</div>';
			}
	}
	
	$msgs = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_messages WHERE user_id=$user[id]"),0);
	if ($msgs >= 1) { 
		$sql = mysql_query("SELECT * FROM ava_messages WHERE user_id=$user[id] ORDER BY id desc");
		echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="pm_table">
    	<tr>
        <td class="tdhead"><strong>'.PM_SUBJECT.'</strong></td>
        <td class="tdhead"><strong>'.PM_FROM.'</strong></td>
	    <td class="tdhead"><strong>'.PM_DATE.'</strong></td>
        <td class="tdhead"><strong>Action</strong></td>
        </tr>';
		while ($row = mysql_fetch_array($sql)) {
			if ($row['read'] == 0) {
				$img = '<img align="absmiddle" src="'.$setting['site_url'].$setting['template_url'].'/images/newmessage.png">';
				$link_class = 'unread_pm_link';
			}
			else {
				$img = '<img align="absmiddle" src="'.$setting['site_url'].$setting['template_url'].'/images/readmessage.png">';
				$link_class = 'read_pm_link';
			}
			echo '<tr class="trlist">
      		<td class="tdlist">
      		'.$img.' <a class="'.$link_class.'" href="'.$setting['site_url'].'/index.php?task=view_message&amp;id='.$row['id'].'">'.$row['title'].'</a>
      		</td>
     		<td class="tdlist">
     			'.$row['sender_name'].'
     		</td>
			<td class="tdlist">
				'.FormatDate($row['date'], 'time').'
			</td>
      		<td class="tdlist">
      			<div align="right">
      				<a href="'.$setting['site_url'].'/index.php?task=send_message&amp;re='.$row['id'].'&amp;id='.$row['sender_id'].'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/reply.png" title="'.PM_REPLY.'" /></a>&nbsp;';
      				$profile_url = ProfileUrl($row['sender_id'], seoname($row['sender_name']));
      				echo '<a href="'.$profile_url.'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/profile.png" title="'.PM_SENDER_PROFILE.'" /></a>&nbsp;&nbsp;&nbsp;
					<a href="'.$setting['site_url'].'/index.php?task=messages&pm_task=delete&id='.$row['id'].'"><img src="'.$setting['site_url'].$setting['template_url'].'/images/deletemessage.png" title="'.PM_DELETE_MESSAGE.'" /></a>
				</div>
			</td>
    		  </tr>';
    	 } 
    	 echo'</table>';
	}
	else {
		echo '<div class="pm_no_messages">'.PM_NO_MESSAGES.'</div>';
	}
}
else {
	echo PM_LOGIN.'<br /><br />';
}
?>