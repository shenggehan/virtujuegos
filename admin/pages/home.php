<?php if ($login_status != 1) exit(); 

$total_games = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games"),0);
$total_users = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_users"),0);
$total_comments = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_comments"),0);
$total_cats = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_cats"),0);
$total_plays1 = mysql_query("SELECT sum(hits) AS total_plays FROM ava_games");
$total_plays2 = mysql_fetch_array($total_plays1);

$unregistered_online = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_usersonline WHERE user_id = 0"),0);
$registered_online = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_usersonline WHERE user_id != 0"),0);
$total_online = $unregistered_online + $registered_online;
?>

<div class="module1">
	<div class="module1_row">
		<a href="?task=manage_games#page=1&cat=All"><?php echo $total_games;?></a><br />
		<span class="module_text">GAMES</span>
	</div>
    <div class="module1_row">
    	<a href="?task=manage_users#page=1"><?php echo $total_users;?></a><br />
    	<span class="module_text">MEMBERS</span>
    </div>
    <div class="module1_row">
    	<a href="?task=manage_categories"><?php echo $total_cats;?></a><br />
    	<span class="module_text">CATEGORIES</span>
    </div>
    <div class="module1_row2">
    	<a href="?task=manage_games#page=1&cat=All"><?php echo $total_plays2['total_plays'];?></a><br />
    	<span class="module_text">GAME PLAYS</span>
    </div>
    <div class="clear"></div>
</div>
<br />
<div class="main_column1">
<div class="version">AV Arcade <?php echo $version;?></div>

<div class="users_online">
	<div class="users_online_title">Registered users online: <strong><?php echo $registered_online;?></strong></div>
	
<?php
$query = mysql_query("
	SELECT ava_users.*
	FROM ava_users
	INNER JOIN ava_usersonline
	ON ava_users.id=ava_usersonline.user_id
	ORDER BY ava_usersonline.time DESC");
while ($online_user = mysql_fetch_array($query)) {
	$url = ProfileUrl($online_user['id'], $online_user['seo_url']);
	echo '<a href="'.$url.'">'.$online_user['username'].'</a> &nbsp;';
}
?>
</div>


</div><div class="main_column2">
<div class="quick_add_container">
	<div class="quick_add_title">
		Add a game
	</div>
	<?php include('includes/quick_add_game_form.php'); ?>
</div>
</div>