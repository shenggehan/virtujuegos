<?php

echo'<textarea rows="3" cols="50" onclick="this.select();" class="embed_textbox">&lt;a href=&quot;'.$setting['site_url'].'&quot;&gt;'.$setting['site_name'].'&lt;/a&gt;&lt;br /&gt;';

	if ($row2['import'] == 1) {
		echo '&lt;object width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;param name=&quot;movie&quot; value=&quot;'.$setting['site_url'].'/games/'.$row2['url'].'.swf&quot;&gt;
&lt;embed src=&quot;'.$setting['site_url'].'/games/'.$row2['url'].'.swf&quot; width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;/embed&gt;
&lt;/object&gt;';
	}
	else if ($row2['import'] == 3) {
			echo '&lt;object width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;param name=&lt;strong&gt;&lt;/strong&gt;&quot;movie&quot; value=&quot;'.$setting['site_url'].'/games/'.$row2['url'].'&quot;&gt;
&lt;embed src=&quot;'.$setting['site_url'].'/games/'.$row2['url'].'&quot; width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;/embed&gt;
&lt;/object&gt;';
		}
	else {
		echo '&lt;object width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;param name=&quot;movie&quot; value=&quot;'.$row2['url'].'&quot;&gt;
&lt;embed src=&quot;'.$row2['url'].'&quot; width=&quot;'.$row2['width'].'&quot; height=&quot;'.$row2['height'].'&quot;&gt;
&lt;/embed&gt;
&lt;/object&gt;';
	}


	echo '&lt;br&gt;&lt;a href=&quot;'.$setting['site_url'].'&quot;&gt;'.$setting['site_name'].'&lt;/a&gt;</textarea>';

?>