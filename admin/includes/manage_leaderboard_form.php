<?php
require_once '../../config.php';
include ('../../includes/core.php');
include '../secure.php';
if ($login_status != 1) exit();

if ($_GET['leaderboard'] != 'default') {
	$leaderboard = mysql_fetch_array(mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $_GET[game] AND leaderboard_id = '$_GET[leaderboard]'"));
}
else {
	$leaderboard = mysql_fetch_array(mysql_query("SELECT * FROM ava_leaderboards WHERE game_id = $_GET[game] LIMIT 1"));
}

?>

<br />
<div class="add_game_form_container">
<form id="form1" name="form1" method="post" action="includes/edit_game_submit.php">
<div class="form_element_container">
   <div class="form_lable">
   <label>Leaderboard name</label></div>
   <div class="form_element"><input class="text_box" name="name" type="text" id="lb_name" value="<?php echo $leaderboard['leaderboard_name'];?>"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Score units</label></div>
   <div class="form_element"><input class="text_box" name="units" type="text" id="lb_units" value="<?php echo $leaderboard['label'];?>"/></div>
</div>

<div class="form_element_container">
   <div class="form_lable"><label>Order</label></div>
   <div class="form_element"><select name="sort" id="lb_sort">
   <?php if ($leaderboard['order_by'] == 'desc') {
   			echo '<option value="desc" selected>Descending</option>  
   			<option value="asc">Ascending</option>';
   		} 
   		else {
   			echo '<option value="desc">Descending</option>  
   			<option value="asc" selected>Ascending</option>';
   		}
   ?>
   </select></div>
</div>
<div class="button_container"><input class="button" name="Submit" type="button" value="Submit" id="submit0" onclick="SubmitLeaderboard(<?php echo $leaderboard['id'];?>);" /></div>
</form>
</div>