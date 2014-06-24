<?php
defined( 'AVARCADE_' ) or die( '' );
if ($setting['add_to_site'] == 1) {
	echo '<textarea rows="3" cols="60">&lt;a href="'.$setting['site_url'].'"&gt;'.$setting['site_name'].'&lt;/a&gt;&lt;br /&gt;';
	
	if ($row2['import'] == 1) {
		echo '&lt;object type="application/x-shockwave-flash" data="'.$setting['site_url'].'/games/'.$row2['url'].'.swf" width="'.$row2['width'].'" 
		height="'.$row2['height'].'"&gt; &lt;param name="movie" value="'.$setting['site_url'].'/games/'.$row2['url'].'.swf" /&gt;&lt;/object&gt;';
	}
	else if ($row2['import'] == 3) {
		echo '&lt;object type="application/x-shockwave-flash" data="'.$setting['site_url'].'/games/'.$row2['url'].'" width="'.$row2['width'].'" 
		height="'.$row2['height'].'"> &lt;param name="movie" value="'.$setting['site_url'].'/games/'.$row2['url'].'" /&gt;&lt;/object&gt;';
	}
	else {
		echo '&lt;object type="application/x-shockwave-flash" data="'.$row2['url'].'" width="'.$row2['width'].'" height="'.$row2['height'].
		'"&gt; &lt;aram name="movie" value="'.$row2['url'].'" /&gt; &lt;/object&gt;';
	}
			
	echo '&lt;br /&gt;&lt;a href="'.$setting['site_url'].'"&gt;'.$setting['site_name'].'&lt;/a&gt;</textarea>';
}
?>