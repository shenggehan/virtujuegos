<?php if ($login_status != 1) exit();

if (isset($_GET['s'])) {
	$form_value = $_GET['s'];
}
else if (isset($_GET['id'])) {
	$form_value = $_GET['id'];
}
else {
	$form_value = 'Search by phrase or ID';
}
?>

<div class="tips"> <img src="images/globe.png" align="absmiddle" /> IP address info &nbsp;&nbsp;&nbsp;<img src="images/edit.png" align="absmiddle" /> Edit &nbsp;&nbsp;&nbsp;<img src="images/delete.png" align="absmiddle" /> Delete  &nbsp;&nbsp;&nbsp;
<img src="images/published.png" align="absmiddle" /><img src="images/unpublished.png" align="absmiddle" /> Toggle banned</div>
<a name="top"></a>

<div class="search_container">
<div class="user_options_float">
<a href="#page=1" id="all_users_button">All users</a><a href="#page=1&online_users=1" id="online_users_button">Online users</a>
</div>
<div class="search_float">
<form action="" method="get" onsubmit="goTo(1);return false">
<input name="search" type="text" id="search_box" class="search_box" value="<?php echo $form_value;?>" onclick="clickclear(this, 'Search by phrase or ID')" onblur="clickrecall(this,'Search by phrase or ID')" onkeyup="searchTimer();return false"/><a href="#" onclick="clearsearch(); return false"><img src="images/search_end.png" align="top" /></a>
</form>
</div>
</div>
<br style="clear:both" />


<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">Username</div>
<div class="manage_header_column_useractivity">Last active</div>
<div class="manage_header_column2">Last IP</div>
<div class="manage_header_column3" id="load_image"></div></div>
<div id="users_container"><div id="thetop"></div>

<?php 
if (isset($_GET['id'])) {
	include('includes/manage_games_ajax.php');
}
else {
	echo '<input type="hidden" id="page" value="1">';
}

echo '</div>';

?>