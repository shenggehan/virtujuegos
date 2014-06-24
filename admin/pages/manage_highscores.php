<?php if ($login_status != 1) exit(); ?>

<div class="add_item" id="add_item">
	<div class="add_child" id="manage_leaderboard_box">
		<div class="lb_text">
		Leaderboard: 
		<?php
		$lb_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_leaderboards WHERE game_id = $_GET[id]"),0);
		if ($lb_count != 0) {
			$leaderboards = mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $_GET[id]");
			echo '<select name="leaderboard" id="leaderboard_select" onchange="goTo(1);">';
			while ($leaderboards_q = mysql_fetch_array($leaderboards)) {
				if ($leaderboards_q['leaderboard_id'] == $lb_id) {
					echo '<option value="'.$leaderboards_q['leaderboard_id'].'" selected>'.$leaderboards_q['leaderboard_name'].'</option>';
				} else {
					echo '<option value="'.$leaderboards_q['leaderboard_id'].'">'.$leaderboards_q['leaderboard_name'].'</option>';
				}
			}
			echo '</select>';
		}
		else {
			echo 'No leaderboards yet';
		}
		?>
		
		</div>
		
	</div>
	<div id="manage_leaderboard_form" class="manage_leaderboard_container"></div>
</div>

<br style="clear:both" />

<div class="manage_header"><div class="manage_hs_header_column0">ID</div><div class="manage_hs_header_column">Username</div><div class="manage_hs_header_column2">Score</div><div class="manage_hs_header_column4">Date</div><div class="manage_hs_header_column3" id="load_image"></div></div>
<div id="games_container">

<?php

//include('includes/manage_highscores_ajax.php');
echo '<input type="hidden" id="page" value="1">';

echo '</div>';

?>