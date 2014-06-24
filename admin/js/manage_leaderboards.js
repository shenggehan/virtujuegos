/*
AV ARCADE
Manage Games Script

AJAX management of AV Arcade games

Written by Andy Venus
*/

// Image preload

pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(43,11); 
pic2.src="images/load2.gif"; 
pic2= new Image(24,24); 
pic2.src="images/close.png"; 
var TIMER;
var pageis;
var storedHash;

function SubmitLeaderboard(id) {
	   
    name = encodeURIComponent($('lb_name').value);
    units = encodeURIComponent($('lb_units').value);
	
	param = "id=" + id + "&name=" + name + "&units=" + units + "&sort=" + $('lb_sort').value;
	
	AjaxPost("includes/edit_leaderboard_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            	alert('DONE');
            	}
    		}
	)
}

function DeleteAsk(id) {
    $('leaderboard-' + id).style.height = '80px';
    $('edit-leaderboard-' + id).innerHTML = '<div class="form_container"><br>Are you sure you want to delete this leaderboard and it\'s scores? &nbsp;<a href="#" onclick="DeleteLeaderboard(' + id + ');return false">Yes</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="CloseDelete(' + id + ');return false">No</a></div>';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
}

function CloseDelete(id) {
	$('leaderboard-' + id).style.height = '30px';
    $('edit-leaderboard-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('leaderboard-' + id).style.height = height + 'px';
        $('leaderboard-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('leaderboard-' + id).style.display = 'none';
    }

}

function DeleteLeaderboard(id) {
	AjaxPost("includes/delete_leaderboard.php", "id=" + id, 
			 function () {
					doMove(id, 80, 1);
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

function clearsearch() {
	$('search_box').value = 'Search by phrase or ID';
	goTo(1);
}

function goTo(page, scroll) {
	location.hash = 'page='+page;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadScores(page) {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	var url = "includes/manage_leaderboards_ajax.php?page=" + hashvalues['page'];

	$('page').value = hashvalues['page'];
	
	
	AjaxPost(url, '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('games_container').innerHTML = xmlHttp.responseText;
					$('games_container').style.opacity = 1;
					$('load_image').innerHTML = '';
				}
    		}
	)
}

function searchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("goTo(1)", 300);
}

function getFileName(url){
  var path = window.location.pathName;
  var file = path.replace(/^.*\/(\w{2})\.html$/i, "$1");
  return file ? file : "undefined";
}

// Load the correct scores from the hash values
function usehashvalues(page) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(page);
		
		LoadScores(hashvalues['page']);
    }
}

// On page load get hash values and display correct scores
function pageloadcheck() {
	
	gethashvalues(window.location.hash);

	LoadScores(hashvalues['page']);

}