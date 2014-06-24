<?php
if ($login_status != 1) exit();

include '../avforums/forum_core.php';
RefreshForumInfo();

echo 'Forum stats and info refreshed';
?>