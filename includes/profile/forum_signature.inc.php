<?php
	include 'avforums/forum_core.php';
	if ($profile['forum_signature'] != '')
		echo formatBB($profile['forum_signature']);
	else
		echo NOT_SET;
?>