<?php

if ($report['type'] == 4) {
echo '
<div id="reported-'.$report['id'].'" class="manage_user_item">
	<div id="treported_name'.$report['id'].'" class="username_column">
	</div>
	<div id="tcategory_name'.$report['id'].'" class="manage_column2">
	</div>
	<div class="manage_column3" id="bad-report-'.$report['id'].'">
		<img src="images/no.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 0, '.$user_id.');">
	</div>
	<div class="manage_column3" id="good-report-'.$report['id'].'">
		<img src="images/yes.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 1, '.$user_id.');">
	</div>

	<div align="left">
		<div id="treported_name'.$report['id'].'" class="manage_user_column">
			<div class="the_report">
				<span class="report_title">Report by '.$report_user.' (<a href="?task=manage_users#page=1&ip='.$report['ip'].'">'.$report['ip'].'</a>):</span> '.$report['report'].'
			</div>
			<div class="the_report_comment">
				<span class="report_title">Post by <a href="'.ProfileUrl($get_post_user['id'], $get_post_user['seo_url']).'">'.$get_post_user['username'].'</a> ('.$name.'):</span> '.htmlspecialchars($get_post['post_content']).'
			</div>
		</div>
	</div>
</div>';
}
elseif ($report['type'] == 1) {
echo '
<div id="reported-'.$report['id'].'" class="manage_user_item">
	<div id="treported_name'.$report['id'].'" class="username_column">
		'.$report_user.' (<a href="?task=manage_users#page=1&ip='.$report['ip'].'">'.$report['ip'].'</a>) reported <a href="'.$game_url.'">'.$get_game['name'].'</a> (<a href="?task=manage_games#id='.$get_game['id'].'">Edit</a>)
	</div>
	<div id="tcategory_name'.$report['id'].'" class="manage_column2">
	</div>
	<div class="manage_column3" id="bad-report-'.$report['id'].'">
		<img src="images/no.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 0, '.$user_id.');">
	</div>
	<div class="manage_column3" id="good-report-'.$report['id'].'">
		<img src="images/yes.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 1, '.$user_id.');">
	</div>

	<div class="clear"></div>

	<div align="left">
		<div id="treported_name'.$report['id'].'" class="manage_user_column">
			'.$report['report'].'
		</div>
	</div>
</div>';
}
elseif ($report['type'] == 2 || $report['type'] == 3) {
echo '
<div id="reported-'.$report['id'].'" class="manage_user_item">
	<div id="treported_name'.$report['id'].'" class="username_column"></div>
	<div id="tcategory_name'.$report['id'].'" class="manage_column2"></div>
	<div class="manage_column3" id="bad-report-'.$report['id'].'">
		<img src="images/no.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 0, '.$user_id.');">
	</div>
	<div class="manage_column3" id="good-report-'.$report['id'].'">
		<img src="images/yes.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 1, '.$user_id.');">
	</div>

	<div align="left">
		<div id="treported_name'.$report['id'].'" class="manage_user_column">
			<div class="the_report">
				<span class="report_title">Report by '.$report_user.' (<a href="?task=manage_users#page=1&ip='.$report['ip'].'">'.$report['ip'].'</a>):</span> '.$report['report'].'
			</div>
			<div class="the_report_comment">
				<span class="report_title">Comment by <a href="'.ProfileUrl($get_comment_user['id'], $get_comment_user['seo_url']).'">'.$get_comment_user['username'].'</a> ('.$name.'):</span> '.htmlspecialchars($get_comment['comment']).'
			</div>
		</div>
	</div>
</div>';
}
elseif ($report['type'] == 5) {
echo '
<div id="reported-'.$report['id'].'" class="manage_user_item">
	<div id="treported_name'.$report['id'].'" class="username_column">
		'.$report_user.' (<a href="?task=manage_users#page=1&ip='.$report['ip'].'">'.$report['ip'].'</a>) reported <a href="'.$reported_user_url.'">'.$get_reported_user['username'].'</a> (<a href="?task=manage_users#id='.$get_reported_user['id'].'">Edit</a>)
	</div>
	<div id="tcategory_name'.$report['id'].'" class="manage_column2">
	</div>
	<div class="manage_column3" id="bad-report-'.$report['id'].'">
		<img src="images/no.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 0, '.$user_id.');">
	</div>
	<div class="manage_column3" id="good-report-'.$report['id'].'">
		<img src="images/yes.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 1, '.$user_id.');">
	</div>

	<div class="clear"></div>

	<div align="left">
		<div id="treported_name'.$report['id'].'" class="manage_user_column">
			'.$report['report'].'
		</div>
	</div>
</div>';
}
elseif ($report['type'] == 6) {
echo '
<div id="reported-'.$report['id'].'" class="manage_user_item">
	<div id="treported_name'.$report['id'].'" class="username_column"></div>
	<div id="tcategory_name'.$report['id'].'" class="manage_column2"></div>
	<div class="manage_column3" id="bad-report-'.$report['id'].'">
		<img src="images/no.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 0, '.$user_id.');">
	</div>
	<div class="manage_column3" id="good-report-'.$report['id'].'">
		<img src="images/yes.png" width="24" height="24" onclick="DeleteReported('.$report['id'].', 1, '.$user_id.');">
	</div>

	<div align="left">
		<div id="treported_name'.$report['id'].'" class="manage_user_column">
			<div class="the_report">
				<span class="report_title">Report by '.$report_user.' (<a href="?task=manage_users#page=1&ip='.$report['ip'].'">'.$report['ip'].'</a>):</span> '.$report['report'].'
			</div>
			<div class="the_report_comment">
				<span class="report_title">Message from <a href="'.ProfileUrl($get_pm_user['id'], $get_pm_user['seo_url']).'">'.$get_pm_user['username'].'</a>:</span> '.htmlspecialchars($get_pm['message']).'
			</div>
		</div>
	</div>
</div>';
}
?>