<?php
include '../../config.php';
include '../core.php';
include '../../language/'.$setting['language'].'.php';

echo "({message: 'Comment earned points', points: $setting[points_comment]})";
?>