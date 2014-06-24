<?php 
include 'header.php';
$message .= '
	'.EMAIL_GREETING.' '.$data['to_username'].', '.$data['from_username'].' '.EMAIL_FR_INTRO.'
	<table width="450" align="center" style="margin-top:15px;background:#ececec;padding:20px;border:1px solid #b2b4c4;">
		<tr>
			<td width="86">
				<img src="'.$data['from_avatar'].'" width="80" height="80" />
			</td>
			<td width="363">
				<span style="font-family:Helvetica;color:00599e;font-size:20px;">'.$data['from_username'].'</span><br />
				<span style="font-family:Helvetica;color:#414141;">'.$data['from_location'].'</span><br />
				<span style="font-family:Helvetica;color:#414141;">'.EMAIL_USER_JOINED.': '.$data['from_join_date'].'</span>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td style="text-align:right;">
				<div align="right">
					<div style="background:#d6d5d5;padding:5px;width:150px;text-align:center;border:1px solid #b1b1b1;font-size:14px;margin-top:5px;">
						<a href="'.$data['accept_link'].'" style="color:#000;">'.EMAIL_ACCEPT_FRIEND_REQUEST.'</a>
					</div>
				</div>
			</td>
		</tr>
	</table>
'; 
include 'footer.php';
?>