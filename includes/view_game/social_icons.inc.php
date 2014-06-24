<!-- 
Social buttons for AV Arcade 

Icon images copyright komodomedia.com

-->

<?php 
$long_url = htmlspecialchars((GameUrl($game['id'], $game['seo_url'], $row2['category_id']))); 
$short_url = htmlspecialchars(ShortUrl($game['id']));
?>
<div class="social_icons">
	<div class="social_text">
	<?php 
	if (defined("SHARE_INFO")) {
		echo SHARE_INFO;
		$share_message = SHARE_MESSAGE;
		$your_url_title = YOUR_URL_TITLE;
	}
	else {
		echo 'Share on social sites and earn points';
		$share_message = 'I have been playing this great game';
		$your_url_title = 'Your unique referral url';
	}
?>
	</div>
	<!- Twitter ->
	<a href="http://twitter.com/home?status=<?php echo $share_message;?>: <?php echo $short_url;?>" title="Twitter" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/twitter.png" alt="Twitter" title="Twitter"></a>
	<!- Facebook ->
	<a href="http://www.facebook.com/sharer.php?u=<?php echo $short_url;?>&t=<?php echo $game['name'].'%20-%20'.$setting['site_name'];?>" title="Facebook" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/facebook.png" alt="Facebook" title="Facebook"></a>
	<!- Digg ->
	<a href="http://digg.com/submit?url=<?php echo $long_url;?>" title="Digg" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/digg.png" alt="Digg" title="Digg"></a>
	<!- Delicious ->
	<a href="http://del.icio.us/post?url=<?php echo $long_url;?>&title=<?php echo $game['name'].'%20-%20'.$setting['site_name'];?>" title="Delicious" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/delicious.png" alt="Delicious" title="Delicious"></a>
	<!- Stumbleupon ->
	<a href="http://www.stumbleupon.com/submit?url=<?php echo $long_url;?>&title=<?php echo $game['name'].'%20-%20'.$setting['site_name'];?>" title="Stumbleupon" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/stumble.png" alt="Stumbleupon" title="Stumbleupon"></a>
	<!- Myspace ->
	<a href="http://www.myspace.com/index.cfm?fuseaction=postto&t=<?php echo $game['name'].'%20-%20'.$setting['site_name'];?>&c=<?php echo $share_message;?>&u=<?php echo $short_url;?>&l=" title="Myspace" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/myspace.png" alt="Myspace" title="Myspace"></a>
	<!- Email ->
	<a href="mailto:?subject=<?php echo $share_message;?>&body=<?php echo $game['name'].'%20-%20'.$setting['site_name'];?> - <?php echo $short_url;?>&l=" title="Email" target="_blank" rel="nofollow"><img src="<?php echo $setting['site_url'];?>/templates/macaw/images/email.png" alt="Email" title="Email"></a>
</div>
