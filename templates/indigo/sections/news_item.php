<?php
echo '
<div class="news_wrapper">
	<div class="news_header">
		<div class="news_image">
			<img src="'.$news['image_url'].'" width="60" height="60" alt="" />
		</div>

		<div class="news_title">
			<a href="'.$news['news_url'].'">'.$news['title'].'</a>

			<div class="news_author">
				'.POSTBY.': <a href="'.$news['user_url'].'">'.$news['author'].'</a>, '.$news['date'].'
			</div>
		</div>
		<br style="clear:both" />
	</div>

	<div class="news_main">'.$news['main'].'</div>
	<div class="news_footer"><a href="'.$news['news_url'].'">'.$news['comments'].' '.NEWS_COMMENTS2.'</a></div>
</div>';
?>