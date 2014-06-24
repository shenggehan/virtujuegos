<?php
if (isset($_GET['sort'])) {
	if ($_GET['sort'] == 'username') {
		$sort = 'username';
	}
	else if ($_GET['sort'] == 'points') {
		$sort = 'points';
	}
	else {
		$sort = 'id';
	}		
}
else {
	$sort = 'username';
}

if (isset($_GET['order'])) {
	if ($_GET['order'] == 'asc') {
		$order = 'asc';
	}
	else {
		$order = 'desc';
	}
}
else {
	$order = 'asc';
}

if (!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = intval($_GET['page']);
	if ($page == 0)
		$page = 1;
}
$mpp = 20;
$from = (($page * $mpp) - $mpp);

$sql = mysql_query("SELECT * FROM ava_users WHERE activate = 1 ORDER BY $sort $order LIMIT $from, $mpp");

echo '
  <table border="0" cellspacing="0" cellpadding="0" id="member_list">
    <tr>
      <td class="member_list_title"></td>
      <td class="member_list_title">
      	<strong>'.ML_USERNAME.'</strong> 
      	<a href="'.MemberListUrl('username', 'asc', 1).'"><img src="'.$setting['site_url'].'/images/plus.png" alt="tinyup" width="10" height="10" /></a>
      	<a href="'.MemberListUrl('username', 'desc', 1).'"><img src="'.$setting['site_url'].'/images/minus.png" alt="tinyup" width="10" height="10" /></a>
      </td>
      <td class="member_list_title">
      	<strong>'.ML_POINTS.'</strong>
      	<a href="'.MemberListUrl('points', 'desc', 1).'"><img src="'.$setting['site_url'].'/images/plus.png" alt="tinyup" width="10" height="10" /></a>
      	<a href="'.MemberListUrl('points', 'asc', 1).'"><img src="'.$setting['site_url'].'/images/minus.png" alt="tinyup" width="10" height="10" /></a>
      </td>
	  <td class="member_list_title">
	  	<strong>'.ML_JOIN_DATE.'</strong>
	  	<a href="'.MemberListUrl('date', 'desc', 1).'"><img src="'.$setting['site_url'].'/images/plus.png" alt="tinyup" width="10" height="10" /></a>
      	<a href="'.MemberListUrl('date', 'asc', 1).'"><img src="'.$setting['site_url'].'/images/minus.png" alt="tinyup" width="10" height="10" /></a>
	  </td>
    </tr>';
while ($row = mysql_fetch_array($sql)) {
	$profile_url = ProfileUrl($row['id'], $row['seo_url']);
	
	if($row['points'] == '') {
		$points = 0;
	}
	else {
		$points = $row['points'];
	}
	
	if($row['avatar'] == '') { 
		if ($row['facebook'] == 1) {
			$avatar = 'http://graph.facebook.com/'.$row['facebook_id'].'/picture';
		}
		else {
			$avatar = $setting['site_url'].'/uploads/avatars/default.png';
		}
	}
	else {
		$avatar = $setting['site_url'].'/uploads/avatars/'.$row['avatar'];
	}
	
	echo '<tr class="member_listBOX">
			<td class="member_list_info" width="40"><img src="'.$avatar.'" width="30" height="30" alt="avatar" /></td>
      		<td class="member_list_info"><a href="'.$profile_url.'">'.$row['username'].'</a></td>
     		<td class="member_list_info">'.$points.'</td>
			<td class="member_list_info">'.FormatDate($row['joined'], 'short').'</td>
    	  </tr>';
} 
    		  
echo' </table>'; 

// Pages
$total_results = mysql_result(mysql_query("SELECT COUNT(*) as Num FROM ava_users WHERE activate = 1"),0);
$total_pages = ceil($total_results / $mpp);

if ($total_pages > 1) {

	echo '<div class="category_pages member_list_pages">';
	
	if($page > 1){
		$prev = ($page - 1);
		$url = MemberListUrl($sort, $order, $prev);
	
		echo '<a href="'.$url.'">&laquo; '.PREVIOUS.'</a> ';

	}

	if ($page > 4) {
		$url = MemberListUrl($sort, $order, 1);
		echo '<a href="'.$url.'">1</a> ';
	}
	if ($page > 5) {
		$url = MemberListUrl($sort, $order, 2);
		echo '<a href="'.$url.'">2</a> ... ';
	}

	$low = $page - 4;
	$high = $page + 8;

	for($i = 1; $i <= $total_pages; $i++){
		if (($i > $low) && ($i < $high)) {
    		if($page == $i){
       		 	echo '<b><a href="#">'.$i.'</a></b> ';
    		} 
    		else {
    			$url = MemberListUrl($sort, $order, $i);
				echo '<a href="'.$url.'">'.$i.'</a> ';
    		}
    	}
	}

	if (($page < $total_pages - 8)) {
		$penultimate = $total_pages - 1;
		$url = MemberListUrl($sort, $order, $penultimate);
		echo ' ... <a href="'.$url.'">'.$penultimate.'</a> ';
	}
	if (($page < $total_pages - 7)) {
		$url = MemberListUrl($sort, $order, $total_pages);
		echo '<a href="'.$url.'">'.$total_pages.'</a> ';
	}

	if($page < $total_pages){
  	  	$next = ($page + 1);
   		$url = MemberListUrl($sort, $order, $next);
		echo '<a href="'.$url.'">'.NEXT.' &raquo;</a> ';
	}

	echo '</div>';
}

?>