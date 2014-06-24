<?php
$total_cats2 = 0;

if ($cat_info['total_subcats'] != 0) {
	$sql = mysql_query("SELECT * FROM ava_cats WHERE parent_id = $id ORDER BY cat_order");
	
	while($row = mysql_fetch_array($sql)) {
	
		$total_cats2 = ($total_cats2 + 1);
		$seo_name = seoname($row['name']);
		
		$url = CategoryUrl($row['id'], $row['seo_url'], 1, 'newest');
	
		echo '<p class="category_subcats_links"><a href="'.$url.'">'.$row['name'].'';
	
		$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE category_id=".$row['id'].""),0);
		echo ' ('.$cat_numb.')';
	
		if($total_cats2 != $cat_info['total_subcats']) {
			echo ' </a></p>';
		}
	}
}
else {
	echo NO_TAGS;
}
?>