<?php if ($login_status != 1) exit(); ?>

<div class="add_item">
	<div class="add_child" id="add_box" onclick="ShowAddGame();return false">
		<div class="add_text">Add a category</div><div class="add_icon" id="add_icon"><img src="images/add.png" /></div>
	</div>
	<div id="add_category_form" class="add_game_container"><?php include 'includes/add_category.php';?><br /></div>
</div>

<div class="search_container">

<div class="search_float">
<div class="button" onclick="RefreshCategories()">Refresh changes</div>
</div>
</div>
<br style="clear:both" />

<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">Category name</div>
<div class="manage_header_column_totalgames">Games</div>
<div class="manage_header_column_order">Order</div><div class="manage_header_column3" id="load_image"></div></div>

<div id="category_container">
	<?php include('includes/manage_categories_ajax.php'); ?>
</div>