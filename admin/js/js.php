<script type="text/javascript" src="js/core.js"></script>
<script type="text/javascript" src="../includes/jquery-1.8.2.js"></script>

<?php
if (isset($_GET['task'])) {
if ($_GET['task'] == 'manage_games') {
	echo '
<script type="text/javascript" src="js/file_selector.js"></script>
<script type="text/javascript" src="js/manage_games.js"></script>
<script type="text/javascript">extracss = \'\';</script>';
}
else if ($_GET['task'] == 'manage_categories') {
	echo '<script type="text/javascript" src="js/manage_categories.js"></script>';
}
else if ($_GET['task'] == 'manage_highscores') {
	echo '<script type="text/javascript" src="js/manage_highscores.js"></script>';
}
else if ($_GET['task'] == 'manage_leaderboards') {
	echo '<script type="text/javascript" src="js/manage_leaderboards.js"></script>';
}
else if ($_GET['task'] == 'manage_pages') {
	echo '<script type="text/javascript" src="js/manage_pages.js"></script>';
}
else if ($_GET['task'] == 'manage_news') {
	echo '<script type="text/javascript" src="js/manage_news.js"></script>';
}
else if ($_GET['task'] == 'manage_links') {
	echo '<script type="text/javascript" src="js/manage_links.js"></script>';
}
else if ($_GET['task'] == 'manage_comments') {
	echo '<script type="text/javascript" src="js/manage_comments.js"></script>';
}
else if ($_GET['task'] == 'manage_news_comments') {
	echo '<script type="text/javascript" src="js/manage_news_comments.js"></script>';
}
else if ($_GET['task'] == 'mochi') {
	echo '<script type="text/javascript" src="js/manage_mochi.js"></script>';
}
else if ($_GET['task'] == 'playtomic') {
	echo '<script type="text/javascript" src="js/manage_playtomic.js"></script>';
}
else if ($_GET['task'] == 'kongregate') {
	echo '<script type="text/javascript" src="js/manage_kongregate.js"></script>';
}
else if ($_GET['task'] == 'fgd') {
	echo '<script type="text/javascript" src="js/manage_fgd.js"></script>';
}
else if ($_GET['task'] == 'fog') {
	echo '<script type="text/javascript" src="js/manage_fog.js"></script>';
}
else if ($_GET['task'] == 'spil') {
	echo '<script type="text/javascript" src="js/manage_spil.js"></script>';
}
else if ($_GET['task'] == 'manage_adverts') {
	echo '<script type="text/javascript" src="js/manage_adverts.js"></script>';
}
else if ($_GET['task'] == 'manage_users') {
	echo '<script type="text/javascript" src="js/manage_users.js"></script>';
}
else if ($_GET['task'] == 'manage_submissions') {
	echo '<script type="text/javascript" src="js/file_selector.js"></script>
	<script type="text/javascript" src="js/manage_submissions.js"></script>
	<script type="text/javascript">extracss = \'\';</script>';
}
else if ($_GET['task'] == 'manage_reports') {
	echo '<script type="text/javascript" src="js/manage_reports.js"></script>';
}
else if ($_GET['task'] == 'manage_forums') {
	echo '<script type="text/javascript" src="js/manage_forums.js"></script>';
}
}
else {
	echo '<script type="text/javascript" src="js/file_selector.js"></script>
<script type="text/javascript" src="js/homepage.js"></script>
<script type="text/javascript">extracss = \'qa_\';</script>';
}

if (file_exists('../uploads/ckeditor')) {
	echo '<script type="text/javascript" src="../uploads/ckeditor/ckeditor.js"></script>';
}
?>
<script type="text/javascript" src="js/search.js"></script>