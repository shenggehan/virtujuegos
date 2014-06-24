/*
AV ARCADE
Manage links Script

AJAX management of AV Arcade links

Written by Andy Venus
*/

// Image preload

pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(43,11); 
pic2.src="images/load2.gif"; 
pic2= new Image(24,24); 
pic2.src="images/close.png"; 

function edit_link(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
	
	AjaxPost("includes/edit_link.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('link-' + id).style.height = '290px';
					lar = id;
					setTimeout("$('edit-link-' + lar).innerHTML = xmlHttp.responseText",50);
            		$('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="close_edit(' + id + ');">';
					urltype[id] = 3;
					imgtype[id] = 3;
				}
    		}
	)
}

function close_edit(id, c) {
    $('link-' + id).style.height = '30px';
    $('edit-link-' + id).innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_link(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="edit_link(' + id + ');">';
    }
}

function SubmitLink(id) {
    $('submit' + id).style.color = '#999';
    $('submit' + id).value = 'Updating...';
    if (id != 0) {
        $('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
    }
	else {
		$('add_icon').innerHTML = '<img src="images/load.gif">';
	}

    var url = "includes/edit_link_submit.php";
    if ($('sitewide' + id).checked == true) {
    	sitewide = 1;
    }
    else {
    	sitewide = 0;
    }
    
     if ($('published' + id).checked == true) {
    	published = 1;
    }
    else {
    	published = 0;
    }
    
	param = "id=" + id + "&name=" + encodeURIComponent($('link_name'+id).value) + "&url=" + encodeURIComponent($('link_url'+id).value) + "&description=" + encodeURIComponent($('link_description'+id).value) + "&sitewide=" + sitewide + "&published=" + published + "&submitter=" + $('submitter'+id).value;
	
	AjaxPost("includes/link_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            		if (id != 0) {
                		$('tlink_name' + id).innerHTML = '<a href="' + $('link_url'+id).value + '" class="manage_link">' + $('link_name' + id).value + '</a>';
                		PublishedButton(id, published);
                		close_edit(id, 1);
            		}
           			else {
               			var newdiv = document.createElement('div');
                		newdiv.innerHTML = xmlHttp.responseText;
                		$('links_container').insertBefore(newdiv, $('thetop').nextSibling);
                		$('add_link_form').style.display = 'none';
						$('add_icon').innerHTML = '<img src="images/add.png" onclick="ShowAddlink();">';
				
						$('link_name0').value = '';
						$('link_description0').value = '';
						$('link_url0').value = '';
						$('submit0').style.color = '#000';
    					$('submit0').value = 'Submit';
				
            		}
        		}
    		}
	)
}

function DeleteAsk(id) {
    $('link-' + id).style.height = '80px';
    $('edit-link-' + id).innerHTML = '<div class="form_container"><br>Are you sure you want to delete this link? &nbsp;<a href="#" onclick="Deletelink(' + id + ', 80, 1);return false">Yes</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="CloseDelete(' + id + ');return false">No</a></div>';
    $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_link(' + id + ');">';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
}

function CloseDelete(id) {
    $('link-' + id).style.height = '30px';
    $('edit-link-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('link-' + id).style.height = height + 'px';
        $('link-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('link-' + id).style.display = 'none';
    }

}

function Deletelink(id) {
	AjaxPost("includes/delete_link.php", "id=" + id, 
			 function () {
					doMove(id, 80, 1);
    		}
	)
}

function ShowAddlink() {
    $('add_link_form').style.display = 'inline';
	$('add_icon').innerHTML = '<img src="images/delete.png" onclick="CloseAddlink();">';
}

function CloseAddlink() {
	$('add_link_form').style.display = 'none';
	$('add_icon').innerHTML = '<img src="images/add.png" onclick="ShowAddlink();">';
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

function Loadlinks(type) {
	$('links_container').style.opacity = 0.5;
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	if (type == 1) {
    	var url = "includes/manage_links_ajax.php?page=" + $('page').value;
	}
	else if (type == 2) {
		var url = "includes/manage_links_ajax.php?s=" + $('search_box').value;
	}
	else {
		var url = "includes/manage_links_ajax.php";
		$('search_box').value = 'Search by phrase or ID';
	}
	
	AjaxPost(url, '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('links_container').innerHTML = xmlHttp.responseText;
					$('links_container').style.opacity = 1;
					$('load_image').innerHTML = '';
				}
    		}
	)
}

function TogglePublished(id, value) {
	AjaxPost("includes/publish_link.php", "id=" + id + "&value=" + value, 
			 function () {
			 	PublishedButton(id, value);
    		}
	)
}

function PublishedButton(id, value) {
	if (value == 0) {
		newvalue = 1;
		image = 'unpublished';
	}
	else {
		newvalue = 0;
		image = 'published';
	}
	$('published-image-'+id).innerHTML = '<img src="images/'+image+'.png" width="24" height="24" onclick="TogglePublished('+id+', '+newvalue+');">';		
}

function pageloadcheck() {}