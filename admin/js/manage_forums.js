/*
AV Arcade
Manage Categories Script

AJAX management of AV Arcade games

Written by Andy Venus
*/

// Image preload

pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(24,24); 
pic2.src="images/edit-complete.png"; 
pic3= new Image(24,24); 
pic3.src="images/close.png"; 
pic4= new Image(10,30); 
pic4.src="images/newly_added.png"; 

function EditForum(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	
	jQuery.post("includes/edit_forum.php", "id=" + id, function(data) {
		$('forum-' + id).style.height = '270px';
        $('edit-forum-' + id).innerHTML = data;
        $('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="CloseEdit(' + id + ');">';
	})
}

function CloseEdit(id, c) {
    $('forum-' + id).style.height = '30px';
    $('edit-forum-' + id).innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="EditForum(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="EditForum(' + id + ');">';
    }
}

function EditForumSubmit(id) {
	if (id != 0) {
        $('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
    }
	else {
		$('add_icon').innerHTML = '<img src="images/load.gif">';
   		$('submit0').value = 'Loading...';
	}
	
	//catname = encodeURIComponent($('forum_name' + id).value);
	//catdesc = encodeURIComponent($('forum_description' + id).value);
	//catkeywords = encodeURIComponent($('forum_keywords' + id).value);
	
	postData = jQuery('#edit_forum_'+id).serialize();
	
	jQuery.post("includes/forum_submit.php", postData, function() {
		if (id == 0) {
			jQuery('#edit_forum_0')[0].reset();
   			CloseAddGame();
   			RefreshForums();
		}
		else {
			CloseEdit(id, 1);
			RefreshForums();
		}
		$('submit0').value = 'Submit';
		jQuery('#refresh_forums').load('includes/forums_dropdown_ajax.php');
	})		
}

function EditOrderSubmit(id) {
	
	order_value = encodeURIComponent($('order_box' + id).value);

	jQuery.post("includes/forum_order.php", "id="+id+"&order=" + order_value, function(data) {
		$('order_box' + id).style.border = '1px solid #4fb600';
	})
		
}

function EditOrderDefault(id) {
	$('order_box' + id).style.border = '1px solid #CCC';
}

function DeleteAsk(id) {
	$('delete-image-' + id).innerHTML = '<img src="images/load.gif">';

	AjaxPost("includes/forum_delete_options.php", "id="+id, 
		function () {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    			$('forum-' + id).style.height = '100px';
   				$('edit-forum-' + id).innerHTML = xmlHttp.responseText;
    			$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
    		}
    	}
    )
}

function CloseDelete(id) {
    $('forum-' + id).style.height = '30px';
    $('edit-forum-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('forum-' + id).style.height = height + 'px';
        $('forum-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('forum-' + id).style.display = 'none';
    }

}

function DeleteForum(id) {
	$('delete-image-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("includes/delete_forum.php", "id=" + id + "&new_forum=" + $('new_forum' + id).value, 
			 function () {
			 	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					RefreshForums();
				}
    		}
	)
}

function ShowAddGame() {
    $('add_forum_form').style.display = 'inline';
    $('add_box').onclick = CloseAddGame;
	$('add_icon').innerHTML = '<img src="images/delete.png" onclick="CloseAddGame();">';
}

function CloseAddGame() {
	$('add_forum_form').style.display = 'none';
	$('add_box').onclick = ShowAddGame;
	$('add_icon').innerHTML = '<img src="images/add.png" onclick="ShowAddGame();">';
}

function clickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
		thisfield.value = "";
    }
}
    
function clickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
		thisfield.value = defaulttext;
    }
}

function RefreshForums() {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	AjaxPost('includes/manage_forums_ajax.php', '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('forum_container').innerHTML = xmlHttp.responseText;
					$('load_image').innerHTML = '';
					AjaxPost('includes/refresh_dropdown.php', '', 
			 			function () {
							if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
							
							}
    					}
					)
				}
    		}
	)
}

function pageloadcheck() {
	RefreshForums();
}