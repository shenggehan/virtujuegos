<?php
if ($login_status != 1) exit();

mysql_query('ALTER TABLE `ava_games` CHANGE `rating` `rating` DECIMAL(5,1) NOT NULL');


$sql = mysql_query('SELECT * FROM ava_games');

while ($row = mysql_fetch_array($sql)) {

	$no_of_ratings = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_ratings WHERE game_id='$row[id]'"),0);
	$get_ratings = mysql_query("SELECT sum(rating) AS rating FROM ava_ratings WHERE game_id='$row[id]'");
	$ratings_sum = mysql_fetch_array($get_ratings);
	
	if ($no_of_ratings != 0) {
		$rating = ($ratings_sum['rating'] / $no_of_ratings);
	}
	else {
		$rating = 0;
	}
				
	mysql_query("UPDATE ava_games SET rating='$rating' WHERE id='$row[id]'") or die (mysql_error());
	
}

echo 'Game ratings recalculated';
 

?>