<?php if ($login_status != 1) exit(); ?>

<div class="add_item" id="add_item">
	<div class="add_child" onclick="ShowAddGame();return false" id="add_box">
		<div class="add_text">Add a game</div>
		<div class="add_icon" id="add_icon"><img src="images/add.png" /></div>
	</div>
	<div id="add_game_form" class="add_game_container"><br /><?php include ('includes/add_game_form.php');?></div>
</div>

<?php
if (isset($_GET['s']) && $_GET['s']) {
	$form_value = $_GET['s'];
}
else {
	$form_value = 'Search All Games';
}
?>
<div class="tips"> <img src="images/highscores.png" align="absmiddle" /> Highscores &nbsp;&nbsp;&nbsp;<img src="images/comments.gif" align="absmiddle" /> Comments &nbsp;&nbsp;&nbsp;<img src="images/feature.png" align="absmiddle" /> Feature &nbsp;&nbsp;&nbsp;<img src="images/published.png" align="absmiddle" /><img src="images/unpublished.png" align="absmiddle" /> Publish/Unpublish &nbsp;&nbsp;&nbsp;<img src="images/edit.png" align="absmiddle" /> Edit &nbsp;&nbsp;&nbsp;<img src="images/delete.png" align="absmiddle" /> Delete </div><a name="top"></a>

<div style="display:none" id="push_options">HAHA</div>

<div class="search_container">
<div class="mochi_cat_float">
<select name="category_filter" id="category_filter" onchange="goTo(1);return false">
<option value="All">All games</option>
<option value="Featured">Featured games</option>
<option value="Highscores">Highscore games</option>
<option disabled="disabled">---------------</option>
   <?php categorylist(0); ?>
</select>
</div>
<div class="search_float">
<form action="" method="get" onsubmit="goTo(1);return false">
<input name="search" type="text" id="search_box" class="search_box" value="<?php echo $form_value;?>" onclick="clickclear(this)" onblur="clickrecall(this)" onkeyup="searchTimer();return false" autocomplete="off" /><a href="#" onclick="clearsearch(); return false"><img src="images/search_end.png" align="top" /></a>
</form>
</div>
</div>
<br style="clear:both" />

<div class="manage_header"><div class="manage_header_column0">ID</div><div class="manage_header_column">Game name</div><div class="manage_header_column2">Category</div><div class="manage_header_column3" id="load_image"></div></div>
<div id="games_container">

<?php
if (isset($_GET['id'])) {
	include('includes/manage_games_ajax.php');
}
else {
	echo '<input type="hidden" id="page" value="1">';
}

echo '</div>';

?>