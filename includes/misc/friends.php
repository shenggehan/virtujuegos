<?php
defined( 'AVARCADE_' ) or die( '' );
if ($user['login_status'] == 1) {

	// Friend requests recieved
	$requests_q = mysql_query("SELECT ava_users.*
	FROM ava_friend_requests
	LEFT JOIN ava_users 
	ON ava_friend_requests.from_user = ava_users.id
	WHERE ava_friend_requests.to_user = $user[id]");

	if (mysql_num_rows($requests_q)) {
		echo '<p class="profile_box_title">Friend Requests</p> <div class="friend_requests_container">';

		while ($friend = mysql_fetch_array($requests_q)) {
			$friend['url'] = ProfileUrl($friend['id'], $friend['seo_url']);
			$friend['avatar_url'] = AvatarUrl($friend['avatar'], $friend['facebook'], $friend['facebook_id']);
		
			$friend['last_activity'] = FormatDate($friend['last_activity'], 'time');
	
			$friend['buttons'] = '<a href="#" onclick="ManageFriend('.$friend['id'].', \'accept_request\', \'friends_page\');return false"><img src="images/add_friend.png" /></a> 
			<a href="#" onclick="ManageFriend('.$friend['id'].', \'delete_request\', \'friends_page\');return false"><img src="images/delete_friend.png" /></a>';
	
			include('.'.$setting['template_url'].'/'.$template['friend']);
		}
	
		echo '</div>';
	}

	echo '<div class="friends_container">';

	// Mutual friends
	$friends_q = mysql_query("SELECT ava_users.*
	FROM ava_friends
	LEFT JOIN ava_users 
	ON ava_friends.user2 = ava_users.id
	WHERE ava_friends.user1 = $user[id]");

if (mysql_num_rows($friends_q)) {
		while ($friend = mysql_fetch_array($friends_q)) {
			$friend['url'] = ProfileUrl($friend['id'], $friend['seo_url']);
			$friend['avatar_url'] = AvatarUrl($friend['avatar'], $friend['facebook'], $friend['facebook_id']);
		
			$friend['last_activity'] = FormatDate($friend['last_activity'], 'time');
	
			$friend['buttons'] = '<a href="index.php?task=send_message&id='.$friend['id'].'"><img src="images/friend_message.png" /></a> 
			<a href="#" onclick="ManageFriend('.$friend['id'].', \'delete_friend\', \'friends_page\');return false"><img src="images/delete_friend.png" /></a>';
	
			include('.'.$setting['template_url'].'/'.$template['friend']);
		}
	}
	else {
		echo '<div class="no_friends">'.NO_FRIENDS.'</div>';
	}

	echo '</div>';
}
else {
	echo FRIENDS_LOGIN;
}
?>