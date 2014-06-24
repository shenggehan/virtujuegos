<?php if ($login_status != 1) exit(); ?>

<div class="add_item"><div class="add_child"><div class="add_text"><a href="#" onclick="ShowAddlink();return false">Add a link</a></div><div class="add_icon" id="add_icon"><img src="images/add.png" onclick="ShowAddlink();return false" /></div></div><div id="add_link_form" class="add_game_container"><br /><?php include ('includes/add_link_form.php');?></div></div>

<?php
if (isset($_GET['s']) && $_GET['s']) {
	$form_value = $_GET['s'];
}
else if (isset($_GET['id']) && $_GET['id']) {
	$form_value = $_GET['id'];
}
else {
	$form_value = 'Search by phrase or ID';
}
?>

<div class="search_container">
<form action="" method="get" onsubmit="Loadlinks(2);return false">
<input name="search" type="text" id="search_box" class="search_box" value="<?php echo $form_value;?>" onclick="clickclear(this, 'Search by phrase or ID')" onblur="clickrecall(this,'Search by phrase or ID')" /><a href="#" onclick="Loadlinks(3); return false"><img src="images/search_end.png" align="top" /></a>
</form>
</div>

<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">Link name</div>
<div class="manage_header_column2fixed">Inbound</div><div class="manage_header_column2fixed">Outbound</div><div class="manage_header_column2fixed">Submitter</div>
<div class="manage_header_column3" id="load_image"></div></div>
<div id="links_container">

<?php include 'includes/manage_links_ajax.php';?>

</div>