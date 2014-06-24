<div class="play_game_container">
<?php
include('../../../config.php');
include '../../secure.php';
if ($login_status != 1) exit();

$query = mysql_query("SELECT * FROM ava_spil WHERE id='$_POST[id]'");
$row = mysql_fetch_array($query);

echo '<object type="application/x-shockwave-flash"
		data="'.$row['file_url'].'" 
		width="'.$row['width'].'" height="'.$row['height'].'">
		<param name="movie" 
		value="'.$row['file_url'].'" />
		</object>';
		
?>
</div>