<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();

if (isset($_GET['done']) && $_GET['done'] == 1) {
	mysql_query("UPDATE ava_featured SET game='".$_GET['id']."' WHERE id='".$_GET['slot']."'") or die (mysql_error());
} 
else {  
	echo '<div class="form_container"><br><label>Make this game featured in: <select name="slot" id="slot'.$_POST['id'].'">';
	$no = 1;
	$sql = mysql_query("SELECT * FROM ava_featured");
	while($row = mysql_fetch_array($sql)) {
		$game = $row['game'];
		$sql2 = mysql_query("SELECT * FROM ava_games WHERE id='$game'");
		$total = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE id='$game'"),0);
		if ($total <= 0) {
			$name = '???';
		}
		else {
			while($row2 = mysql_fetch_array($sql2)) {
				$name = $row2['name'];
			}
		}

		echo '<option value="'.$no.'">Slot '.$no.' ('.$name.')</option>';
		$no = $no + 1;
	}
echo '</select>
  </label>
  <input type="submit" name="Submit" value="Go" onclick="FeatureGameSubmit('.$_POST['id'].');return false" />
</div>';
}
?>