<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();
$total_games = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE category_id = $_POST[id]"),0);

?>

<div class="category_delete_options">

<div class="category_delete_left">
Move <?php echo $total_games;?> games to

<select name="category" id="new_category<?php echo $_POST['id'];?>" class="cdtb">
<?php $cq = mysql_query("SELECT * FROM ava_cats ORDER BY name ASC");
	while($ca = mysql_fetch_array($cq)) {
		if ($ca['id'] != $_POST['id']) {
			echo '<option value="'.$ca['id'].'">'.$ca['name'].'</option>';
		} 
	}?>
</select>
</div>
<div class="category_delete_right">
<div class="button3" onclick="DeleteCategory('<?php echo $_POST['id'];?>');return false"><a href="#">Delete</a></div>
</div>

</div>