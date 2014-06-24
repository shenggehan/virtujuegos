<?php
if ($setting['link_exchange'] == 1) {

	echo '<div class="links_header">'.LINK_EXCHANGE.'</a></div>';

	include 'includes/misc/submit_link.php';
	
}

$sql = mysql_query("SELECT * FROM ava_links WHERE published = 1 ORDER BY id asc");

echo '<div class="links_header">'.OUR_FRIENDS.'</a></div>';

while($row = mysql_fetch_array($sql))	{
	
	echo '<div class="link_item"><a href="'.$row['url'].'" target="_blank" onclick="LinkOut('.$row['id'].');"><strong>'.$row['name'].'</strong></a> - '.$row['description'].'</div>';

}
?>