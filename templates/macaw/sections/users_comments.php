<!-- Contents in this file will wrapped in <li> tags for the AJAX comments system. The in-built styles for the list are #comments ul and #comments ul li and are included at the top of the CSS file -->

<?php echo '
<li>
<div class="profile_comment">
<div class="comment_username">
	'.GAME.': <a href="'.$comment['game_url'].'">'.$comment['game_name'].'</a>
</div>

<div class="thecomment">
	'.$comment['the_comment'].'
</div>
</div>
</li>'; ?>