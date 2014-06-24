/*
AV ARCADE
Manage Categories Script

AJAX management of AV Arcade comments

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

function DeleteComment(id) {
	AjaxPost("includes/delete_news_comment.php", "id=" + id, 
			 function () {
					$('comment-' + id).style.display = 'none';
    		}
	)
}

function goTo(page, scroll) {
	if ($('search_box').value.indexOf("Search") != -1) {
		search = '';
	}
	else {
		search = '&search='+$('search_box').value;
	}
	if (hashvalues['id'] != undefined) {
		id = '&id='+hashvalues['id'];
	}
	else {
		id = '';
	}
	location.hash = 'page='+page+search+id;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadComments(type, search, id) {
	$('comments_container').style.opacity = 0.5;
	
	var url = "includes/manage_news_comments_ajax.php?page=" + hashvalues['page'];

	$('page').value = hashvalues['page'];
	
	if (hashvalues['search'] != undefined) {
		var url = url+"&s=" + hashvalues['search'];
		$('search_box').value = hashvalues['search'];
	}
	else {
		$('search_box').value = 'Search news comments';
	}
	if (hashvalues['id'] != undefined) {
		var url = url+'&id='+hashvalues['id'];
	}
		
	AjaxPost(url, '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('comments_container').innerHTML = xmlHttp.responseText;
					$('comments_container').style.opacity = 1;
				}
    		}
	)
}

function clickclear(thisfield) {
	if (thisfield.value.indexOf("Search") != -1) {
		thisfield.value = "";
		$('search_box').style.color = '#000';
    }
}
    
function clickrecall(thisfield) {
	if (thisfield.value == "") {
		$('search_box').value = 'Search '+ $('category_filter')[$('category_filter').selectedIndex].innerHTML;
		$('search_box').style.color = '#484848';
    }
}

function searchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("goTo(1)", 300);
}

function clearsearch() {
	$('search_box').value = 'Search news comments';
	goTo(1);
}

function change_location(location) {
	window.location = location
}

// Load the correct comments from the hash values
function usehashvalues(hash) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(hash);
			
		LoadComments();
    }
}
// On page load get hash values and display correct comments
function pageloadcheck() {
	
	gethashvalues(window.location.hash);
	
	LoadComments();

}