<div class="play_game_container">
<?php
include('../../config.php');
include '../secure.php';
if ($login_status != 1) exit();

$query = mysql_query("SELECT * FROM ava_submissions WHERE id='$_POST[id]'");
$row = mysql_fetch_array($query);

echo '<object type="application/x-shockwave-flash"
		data="'.$row['file'].'" 
		width="'.$row['width'].'" height="'.$row['height'].'">
		<param name="movie" 
		value="'.$row['file'].'" />
		</object>';
		
?>
</div>