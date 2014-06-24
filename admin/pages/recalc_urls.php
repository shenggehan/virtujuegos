<?php
if ($login_status != 1) exit();

mysql_query("TRUNCATE TABLE ava_seonames");

mysql_query("UPDATE ava_games SET seo_url = ''");
mysql_query("UPDATE ava_cats SET seo_url = ''");
mysql_query("UPDATE ava_news SET seo_url = ''");
mysql_query("UPDATE ava_pages SET seo_url = ''");
mysql_query("UPDATE ava_users SET seo_url = ''");
mysql_query("UPDATE ava_tags SET seo_url = ''");

mysql_query("UPDATE ava_forums SET seo_url = ''");
mysql_query("UPDATE ava_topics SET seo_url = ''");


function generate_seonames($table, $column, $type) {
	$sql = mysql_query("SELECT * FROM $table ORDER BY id ASC");
	while ($row = mysql_fetch_array($sql)) {
		$seo_name = seoname($row[$column]);
		$seo_name_exists = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_seonames WHERE seo_name = '$seo_name' AND type = '$type'"),0);
		if($seo_name_exists >= 1) {
			$seo_name_count = mysql_fetch_array(mysql_query("SELECT uses FROM ava_seonames WHERE seo_name = '$seo_name' AND type = '$type'"));
		
			$number = $seo_name_count['uses'] + 1;
			$final_seo_name = $seo_name.'-'.$number;
		
			mysql_query("UPDATE $table SET seo_url = '$final_seo_name' WHERE id = $row[id]");
			mysql_query("UPDATE ava_seonames SET uses = uses + 1 WHERE seo_name = '$seo_name'");
		}
		else {
			mysql_query("UPDATE $table SET seo_url = '$seo_name' WHERE id = $row[id]");
			mysql_query("INSERT INTO ava_seonames (seo_name, type, uses) VALUES ('$seo_name', '$type', 1)");
		}
	}
}


generate_seonames('ava_games', 'name', 'game');
generate_seonames('ava_cats', 'name', 'category');
generate_seonames('ava_news', 'title', 'news');
generate_seonames('ava_pages', 'name', 'page');
generate_seonames('ava_tags', 'tag_name', 'tag');
generate_seonames('ava_forums', 'name', 'forum');
generate_seonames('ava_topics', 'title', 'topic');


$sql = mysql_query("SELECT * FROM ava_users");
while ($row = mysql_fetch_array($sql)) {
	$seo_name = seoname($row['username']);
	
	mysql_query("UPDATE ava_users SET seo_url = '$seo_name' WHERE id = $row[id]");
}

echo 'URL\'s recalculated';
?>