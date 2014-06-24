<?php
function printTagCloud($tags) {
	global $setting, $tags_id, $tags_url, $lang_tags_id, $thisismochi;
        // $tags is the array
        
        asort($tags);
        
        $tags = array_splice($tags, -60);
               
        ksort($tags);
       
        $max_size = 24; // max font size in pixels
        $min_size = 12; // min font size in pixels
       
        // largest and smallest array values
        $max_qty = max(array_values($tags));
        $min_qty = min(array_values($tags));
       
        // find the range of values
        $spread = $max_qty - $min_qty;
        if ($spread == 0) { // we don't want to divide by zero
                $spread = 1;
        }
        
        if (isset($thisismochi)) 
        	$location_extra = '../';
        else
        	$location_extra = '';
       
        // set the font-size increment
        $step = ($max_size - $min_size) / ($spread);
		$myFile = $location_extra."../../includes/modules/tag_cloud.php";
		$fh = fopen($myFile, 'w') or die("can't open file");
		fwrite($fh, '<div class="tag_cloud">');

        // loop through the tag array
        foreach ($tags as $key => $value) {
                // calculate font-size
                // find the $value in excess of $min_qty
                // multiply by the font-size increment ($size)
                // and add the $min_size set above
                if ($value >= 2) {
                $size = round($min_size + (($value - $min_qty) * $step));
                
				$tag_link = TagUrl($tags_url[$key], 1, 'newest');
       
                $new_tag = '<a href="'.$tag_link.'" style="font-size: ' . $size . 'px">' . $key . '</a> ';

				fwrite($fh, $new_tag);
				}
        }
        fwrite($fh, '</div>');
        fclose($fh);
}

$sql = mysql_query("SELECT * FROM ava_tags") or die (mysql_error());
$count = mysql_num_rows($sql);

if ($count >= 1) {

	while ($tags1 = mysql_fetch_array($sql)) {	
		$tag_count = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_tag_relations WHERE tag_id= $tags1[id]"),0);
		if ($tag_count != 0) {
			$tags_cloud[$tags1['tag_name']] = $tag_count;
			$tags_id[$tags1['tag_name']] = $tags1['id'];
			$tags_url[$tags1['tag_name']] = $tags1['seo_url'];
		}
	}
	
	printTagCloud($tags_cloud);
}
?>