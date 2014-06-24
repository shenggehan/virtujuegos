<?php
include '../../config.php';
?>

<select name="parent_id" id="parent_id0">
   <?php 
   	    echo '<option value="0" selected>None</option>';
   $cq = mysql_query("SELECT * FROM ava_cats WHERE parent_id = 0 ORDER BY cat_order ASC");
   while($ca = mysql_fetch_array($cq)) {
		   echo '<option value="'.$ca['id'].'">'.$ca['name'].'</option>'; 
   }?>
   </select>