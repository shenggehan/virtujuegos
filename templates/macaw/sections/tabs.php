	  <?php
defined( 'AVARCADE_' ) or die( '' );
$therow = 0;
$sql = mysql_query("SELECT * FROM ava_cats ORDER BY cat_order ASC");
while($row = mysql_fetch_array($sql)) {
	$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE (category_id = $row[id] OR category_parent = $row[id]) AND published=1"),0);
	if ($cat_numb > 0) {
 		$therow = $therow + 1;
 	
 		$category = array('name' => $row['name']);
 		
 		$mugcat = array('name' => $row['name']);
 		$mugcat['name'] = str_replace(' ', '', $mugcat['name']);
 		
		$category['url'] = CategoryUrl($row['id'], $row['seo_url'], 1, 'newest');
	
		include('.'.$setting['template_url'].'/sections/tabcats.php');
	
		if ($therow == $template['homepage_columns']) {
			$therow = 0;
		}
	}
}
?>
