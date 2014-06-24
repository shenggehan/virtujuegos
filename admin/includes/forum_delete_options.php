<?php
require_once '../../config.php';
include '../../avforums/forum_core.php';
include '../secure.php';
if ($login_status != 1) exit();
$total_subs = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_forums WHERE parent_id = $_POST[id]"),0);

if ($total_subs >= 1) {
?>

<div class="category_delete_options">

<div class="category_delete_left">
After deleting, move sub-forums to

<select name="category" id="new_forum<?php echo $_POST['id'];?>" class="cdtb">
	<option value="0">No parent</option>
	<?php ForumsDropdown(0, $_POST['id']);?>
</select>
</div>
<div class="category_delete_right">
<div class="button3" onclick="DeleteForum('<?php echo $_POST['id'];?>');return false"><a href="#">Delete</a></div>
</div>

</div>

<?php 
} else { 
?>
<input type="hidden" id="new_forum<?php echo $_POST['id'];?>" value="0" />
Are you sure you want to delete this forum? <br />
<div style="align:center;width:195px;margin: 10px auto;">
<div class="button3" onclick="CloseDelete('<?php echo $_POST['id'];?>');return false"><a href="#">Cancel</a></div> <div class="button3" onclick="DeleteForum('<?php echo $_POST['id'];?>');return false"><a href="#">Delete</a></div>
</div>

<?php } ?>