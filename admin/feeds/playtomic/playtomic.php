<?php if ($login_status != 1) exit();

if (isset($_GET['s']) && $_GET['s']) {
	$form_value = $_GET['s'];
}
else if (isset($_GET['id']) && $_GET['id']) {
	$form_value = $_GET['id'];
}
else {
	$form_value = 'Search feed';
}
?>

<div class="mochi_buttons2"><div class="mochi_button"><a href="?task=download_playtomic_feed">Update feed</a></div><div class="mochi_button"><a href="?task=feed_settings">Feed Settings</a></div></div>
<br style="clear:both" />

<div class="tips"><img src="images/no.png" align="absmiddle" /> Reject game &nbsp;&nbsp;&nbsp;<img src="images/dl.png" align="absmiddle" /> Install game &nbsp;&nbsp;&nbsp;<img src="images/go.png" align="absmiddle" /> Preview game

<br /><br />Playtomic's feed is broken at their end and has been for months. It will be removed in the future if it doesn't come back. <br /><br /><a href="http://playtomic.com/community/thread/448-feed-still-broken">My thread on their forums</a></div><a name="top"></a>

<div class="search_container">
<div class="mochi_cat_float">
<?php include 'includes/mochi_cat_dropdown.php'; ?>
</div>
<div class="search_float">
<form action="" method="get" onsubmit="goTo(1);return false">
<input name="search" type="text" id="search_box" class="search_box" value="<?php echo $form_value;?>" onclick="clickclear(this, 'Search feed')" onblur="clickrecall(this,'Search feed')" onkeyup="searchTimer();return false"/><a href="#" onclick="clearsearch(); return false"><img src="images/search_end.png" align="top" /></a>
</form>
</div>
</div>
<br style="clear:both" />

<div class="manage_header"><div class="manage_header_column0"></div><div class="manage_header_column">Game information</div><div class="manage_header_column2"></div><div class="manage_header_column3" id="load_image"></div></div>
<div id="games_container"><div id="thetop"></div>

<?php 

echo '<input type="hidden" id="page" value="1">';

echo '</div>';

?>