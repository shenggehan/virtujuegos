<?php
include '../../config.php';
include '../../includes/core.php';
include '../../avforums/forum_core.php';
?>

<select name="parent_forum">
	<option value="0">No parent</option>
	<?php ForumsDropdown(0);?>
</select>