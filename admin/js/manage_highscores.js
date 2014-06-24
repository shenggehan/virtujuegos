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

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('score-' + id).style.height = height + 'px';
        $('score-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('score-' + id).style.display = 'none';
    }

}

function DeleteScore(id) {
	AjaxPost("includes/delete_highscore.php", "id=" + id, 
			 function () {
					doMove(id, 30, 1);
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
	location.hash = 'page='+page+'&leaderboard='+$('leaderboard_select').value + "&game=" + hashvalues['game'];
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadScores(type, leaderboard, game, page) {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	var url = "includes/manage_highscores_ajax.php?page=" + hashvalues['page'] + '&leaderboard=' + hashvalues['leaderboard'] + "&game=" + hashvalues['game'];

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
		
		LoadLeaderboard(hashvalues['game'], hashvalues['leaderboard']);
    }
}

function LoadLeaderboard(game_id, leaderboard_id) {
	var url = "includes/manage_leaderboard_form.php?game=" + game_id + '&leaderboard=' + leaderboard_id;	
	
	AjaxPost(url, '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('manage_leaderboard_form').innerHTML = xmlHttp.responseText;
					$('manage_leaderboard_form').style.opacity = 1;
					LoadScores(5, hashvalues['leaderboard'], hashvalues['game'], hashvalues['page']);
					//$('load_image').innerHTML = '';
				}
    		}
	)
}

// On page load get hash values and display correct scores
function pageloadcheck() {
	
	gethashvalues(window.location.hash);

	dropdown_exists = $('leaderboard_select');

	if (dropdown_exists != null) {
		$('leaderboard_select').value = hashvalues['leaderboard'];
	
		LoadLeaderboard(hashvalues['game'], hashvalues['leaderboard']);
	}
	else {
		$('games_container').innerHTML = '<br />No highscores yet';
	}

}