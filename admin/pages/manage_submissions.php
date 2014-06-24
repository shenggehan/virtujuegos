<?php if ($login_status != 1) exit(); ?>

<div class="manage_header"><div class="manage_header_column">Submission info</div><div class="manage_header_column3" id="load_image"></div></div>
<div id="games_container">

<?php
if (isset($_GET['id'])) {
	include('includes/manage_wallpapers_ajax.php');
}
else {
	echo '<input type="hidden" id="page" value="1">';
}

echo '</div>';

?>