<?php

if ($login_status != 1) exit();

if (isset($_GET['s'])) {
	$form_value = $_GET['s'];
}
else if (isset($_GET['id'])) {
		$form_value = $_GET['id'];
	}
else {
	$form_value = 'Search news comments';
}
?>
<div class="info">To delete a comment double click the delete button</div><br />
<div class="search_container">
<div class="mochi_cat_float">
	<select name="mochi_category" id="mochi_category" onchange="change_location('index.php?task=manage_comments#page=1');">
<option value="game">Game comments</option>
<option value="news" selected="selected">News comments</option>
</select>
</div>
<div class="search_float">
<form action="" method="get" onsubmit="goTo(1);return false">
<input name="search" type="text" id="search_box" class="search_box" value="<?php echo $form_value;?>" onclick="clickclear(this, 'Search news comments')" onblur="clickrecall(this,'Search news comments')" onkeyup="searchTimer();return false" /><a href="#" onclick="clearsearch(); return false"><img src="images/search_end.png" align="top" /></a>
</form>
</div>
</div><br style="clear:both" />

<div id="comments_container"><div id="thetop"></div>

<?php

echo '<input type="hidden" id="page" value="1">';

echo '</div>';

?>