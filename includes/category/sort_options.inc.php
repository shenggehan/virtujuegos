<?php
defined( 'AVARCADE_' ) or die( '' );

foreach ($sort_options as $key => $sort_name) {
	$url = CategoryUrl($cat_info['id'], $cat_info['seo_url'], 1, $key);
	
	echo '<p class="sub_button"><a href="'.$url.'">'.$sort_name.'</a></p>';
	
	if ($key != 'namedesc') {
		echo '';
	}
}

?>