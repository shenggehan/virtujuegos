<?php
if ($setting['forums_installed'] == 1)
	include '../avforums/forum_core.php';
	
if ($login_status != 1) exit();

$game_report_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_reported WHERE type = 1"), 0);
$comment_report_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_reported WHERE type = 2 OR type = 3"), 0);
$post_report_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_reported WHERE type = 4"), 0);
$user_report_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_reported WHERE type = 5"), 0);
$pm_report_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_reported WHERE type = 6"), 0);

$total_report_count = ($game_report_count + $comment_report_count + $post_report_count + $user_report_count + $pm_report_count)
?>

<div class="tips"><img src="images/yes.png" align="absmiddle" /> Good report (award points) &nbsp;&nbsp;&nbsp;<img src="images/no.png" align="absmiddle" /> Bad report (no points) </div><a name="top"></a>

<div class="search_container">
<div class="mochi_cat_float">

<select name="report_type" id="report_type" onchange="change_location('#page=1&type='+this.value);">
	<option value="all">All reports (<?php echo $total_report_count;?>)</option>
	<option value="comments">Comment reports (<?php echo $comment_report_count;?>)</option>
	<option value="games">Game reports (<?php echo $game_report_count;?>)</option>
	<option value="users">User reports (<?php echo $user_report_count;?>)</option>
	<option value="pms">PM reports (<?php echo $pm_report_count;?>)</option>
	<?php if ($setting['forums_installed'] == 1) {?>
	<option value="posts">Post reports (<?php echo $post_report_count;?>)</option>
	<?php } ?>
</select>

</div>
<div class="search_float">
</div></div><br style="clear:both" />

<div id="reported_container">
	<input type="hidden" id="page" value="1">
</div>