/*
AV ARCADE
Manage users Script

AJAX management of AV Arcade users

Written by Andy Venus
*/

// Image preload

pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(43,11); 
pic2.src="images/load2.gif"; 
pic2= new Image(24,24); 
pic2.src="images/close.png"; 

var admin = new Array();
var active = new Array();

function edit_user(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
	$('ip-image-' + id).innerHTML = '<img src="images/globe.png" onclick="show_ips(' + id + ');">';
	
	AjaxPost("includes/edit_user.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					
					lar = id;
					setTimeout("$('edit-user-' + lar).innerHTML = xmlHttp.responseText",50);
            		$('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="close_edit(' + id + ');">';
				}
    		}
	)
}

function close_edit(id, c) {
    $('edit-user-' + id).innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_user(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="edit_user(' + id + ');">';
    }
}

function SubmitUser(id) {
    $('submit' + id).style.color = '#999';
    $('submit' + id).value = 'Updating...';
    if (id != 0) {
        $('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
    }
	else {
		$('add_icon').innerHTML = '<img src="images/load.gif">';
	}

	if ($('admin'+id).checked == true) {
		admin[id] = 1;
	}
	else {
		admin[id] = 0;
	}
	if ($('active'+id).checked == true) {
		active[id] = 1;
	}
	else {
		active[id] = 0;
	}
	
	if (jQuery('#forum_signature'+id).length != 0) {
		forum_signature = $('forum_signature'+id).value;
	}
	else {
		forum_signature = '';
	}
	
	param = "id=" + id + "&username=" + $('username'+id).value + "&email=" + $('email'+id).value + "&about=" + encodeURIComponent($('about'+id).value) + "&interests=" + "&location=" + encodeURIComponent($('location'+id).value) + "&website=" + $('website'+id).value + "&password=" + encodeURIComponent($('password'+id).value) + "&admin=" + admin[id] + "&active=" + active[id] + "&avatar=" + $('avatar'+id).value + "&points=" + $('points'+id).value + "&forum_signature="+encodeURIComponent(forum_signature);
	
	AjaxPost("includes/user_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
                	$('tuser_name' + id).innerHTML = '&nbsp;<a href="../index.php?task=profile&id=' + id + '" class="manage_user">' + $('username' + id).value + '</a>';
                	close_edit(id, 1);
            		
        		}
    		}
	)
}

function DeleteAsk(id) {
    $('user-' + id).style.height = '90px';
    if (id != 1) {
   		$('edit-user-' + id).innerHTML = '<div class="form_container"><br>Are you sure you want to delete this user including all data such as highscores and comments? A ban may be more suitable. <br />&nbsp;<a href="#" onclick="Deleteuser(' + id + ', 80, 1);return false">Yes</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="CloseDelete(' + id + ');return false">No</a></div>';
   	}
   	else {
	   	$('edit-user-' + id).innerHTML = 'You can\'t delete this account';
   	}
    
    $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_user(' + id + ');">';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
    $('ip-image-' + id).innerHTML = '<img src="images/globe.png" onclick="show_ips(' + id + ');">';
}

function CloseDelete(id) {
    $('user-' + id).style.height = '30px';
    $('edit-user-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('user-' + id).style.height = height + 'px';
        $('user-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('user-' + id).style.display = 'none';
    }

}

function Deleteuser(id) {
	AjaxPost("includes/delete_user.php", "id=" + id, 
			 function () {
					doMove(id, 80, 1);
    		}
	)
}

function ShowAdduser() {
    $('add_user_form').style.display = 'inline';
	$('add_icon').innerHTML = '<img src="images/delete.png" onclick="CloseAdduser();">';
}

function CloseAdduser() {
	$('add_user_form').style.display = 'none';
	$('add_icon').innerHTML = '<img src="images/add.png" onclick="ShowAdduser();">';
}

function clickclear(thisfield) {
	if (thisfield.value.indexOf("Search") != -1) {
		thisfield.value = "";
		$('search_box').style.color = '#000';
    }
}

function clearsearch() {
	$('search_box').value = 'Search by phrase or ID';
	goTo(1);
}
    
function clickrecall(thisfield) {
	if (thisfield.value == "") {
		$('search_box').value = 'Search users';
		$('search_box').style.color = '#484848';
    }
}

function goTo(page, scroll) {
	if ($('search_box').value.indexOf("Search") != -1) {
		search = '';
	}
	else {
		search = '&search='+$('search_box').value;
	}
	location.hash = 'page='+page+search;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadUsers() {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	if (hashvalues['id'] == undefined) {
	
		var url = "includes/manage_users_ajax.php?page=" + hashvalues['page'];

		$('page').value = hashvalues['page'];
	
		if (hashvalues['search'] != undefined) {
			var url = url+"&s=" + hashvalues['search'];
			$('search_box').value = hashvalues['search'];
		}
		else {
			$('search_box').value = 'Search users';
		}
	
		if (hashvalues['ip'] != undefined) {
			var url = url+"&ip="+hashvalues['ip'];
		}
		
		if (hashvalues['online_users'] != undefined) {
			var url = url+"&online_users=1";
			$('all_users_button').style.borderColor = '#cfcfcf';
			$('online_users_button').style.borderColor = '#8396ac';
		}
		else {
			$('online_users_button').style.borderColor = '#cfcfcf';
			$('all_users_button').style.borderColor = '#8396ac';
		}
	}
	else {
		var url = "includes/manage_users_ajax.php?id="+hashvalues['id'];
	}
	
	AjaxPost(url, '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('users_container').innerHTML = xmlHttp.responseText;
					$('users_container').style.opacity = 1;
					$('load_image').innerHTML = '';
				}
    		}
	)
}

function show_ips(id) {
	$('ip-image-' + id).innerHTML = '<img src="images/load.gif" onclick="DeleteAsk(' + id + ');">';
	$('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_user(' + id + ');">';
	$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
	
	AjaxPost("includes/user_ip.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('user-' + id).style.height = '100px';
					$('edit-user-' + id).innerHTML = xmlHttp.responseText;
					$('ip-image-' + id).innerHTML = '<img src="images/globe.png" onclick="CloseIP(' + id + ');">';
				}
    		}
	)
}

function CloseIP(id) {
    $('user-' + id).style.height = '30px';
    $('edit-user-' + id).innerHTML = '';
    $('ip-image-' + id).innerHTML = '<img src="images/globe.png" onclick="show_ips(' + id + ');">';
}

function searchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("goTo(1)", 300);
}

// Load the correct users from the hash values
function usehashvalues(hash) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(hash);
			
		LoadUsers();
    }
}
// On page load get hash values and display correct users
function pageloadcheck() {
	gethashvalues(window.location.hash);
	LoadUsers();
}

// 
function ToggleBanned(id, value) {
	AjaxPost("includes/ban_user.php", "id=" + id + "&value=" + value, 
			 function () {
			 	BannedButton(id, value);
    		}
	)
}

function BannedButton(id, value) {
	if (value == 0) {
		newvalue = 1;
		image = 'published';
	}
	else {
		newvalue = 0;
		image = 'unpublished';
	}
	$('banned-image-'+id).innerHTML = '<img src="images/'+image+'.png" width="24" height="24" onclick="ToggleBanned('+id+', '+newvalue+');">';		
}