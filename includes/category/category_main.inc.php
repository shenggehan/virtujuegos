<?php
defined( 'AVARCADE_' ) or die( '' );
$therow = 0;

if ($id != 0) {
	$where = "(category_id = $id OR category_parent = $id) AND";
}
else {
	$where = '';
}

$cat_numb = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_games WHERE $where published=1"), 0);

if ($cat_numb > 0) {
	$from = (($page * $template['games_per_page']) - $template['games_per_page']);

	if (isset($_GET["sortby"])) {
		if ($_GET['sortby'] == 'nameasc') {
			$sort = 'name ASC';
		}
		else if ($_GET['sortby'] == 'namedesc') {
			$sort = 'name DESC';
		}
		else if ($_GET['sortby'] == 'newest') {
			$sort = 'id DESC';
		}
		else if ($_GET['sortby'] == 'oldest') {
			$sort = 'id ASC';
		}
		else if ($_GET['sortby'] == 'rating') {
			$sort = 'rating DESC';
		}
		else if ($_GET['sortby'] == 'plays') {
			$sort = 'hits DESC';
		}
		else if ($_GET['sortby'] == 'highscores') {
			$sort = 'highscores DESC';
		}
		else {
			$sort = 'id DESC';
		}
	}
	else {
		$sort = 'id DESC';
	}
	$sql = mysql_query("SELECT * FROM ava_games WHERE $where published=1 ORDER BY $sort LIMIT $from, $template[games_per_page]");

	while ($row = mysql_fetch_array($sql)) {
		$therow = $therow + 1;
		
		$game = GameData($row, 'category');

		include '.'.$setting['template_url'].'/'.$template['category_game'];

		if ($therow == $template['category_columns']) {
			$therow = 0;
		}
	}


}
else {
	echo '<div id="no_games">'.CATEGORY_NO_GAMES.'</div>';
}
?>