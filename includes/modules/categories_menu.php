<?php
$sql = mysql_query("SELECT * FROM ava_cats WHERE parent_id = 0 ORDER BY cat_order");
$total_cats = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_cats WHERE parent_id = 0"),0);
$total_cats2 = 0;

if ($setting['all_games'] == 1) {
	$url = CategoryUrl(0, 'all', 1, 'newest');

	echo '<li><a href="'.$url.'">'.ALL_GAMES;
	
	if ($setting['cat_numbers'] == 1) {
		$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games"),0);
		echo ' <em>('.$cat_numb.')</em>';
	}

	echo '</a></li>';
}
	
while($row = mysql_fetch_array($sql)) {
	
	$total_cats2 = ($total_cats2 + 1);
	$seo_name = seoname($row['name']);
	
	$url = CategoryUrl($row['id'], $row['seo_url'], 1, 'newest');
	
	echo '<li><a href="'.$url.'">'.$row['name'];
	
	if ($setting['cat_numbers'] == 1) {
		$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE category_id=".$row['id'].""),0);
		echo ' <em>('.$cat_numb.')</em>';
	}
	
	echo '</a></li>';
}

?>