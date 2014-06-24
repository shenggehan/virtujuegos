/*
AV ARCADE
Manage kongregate Games

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
pic3= new Image(24,24); 
pic3.src="images/back.png"; 

// AJAX for all browsers
function GetXmlHttpObject() {
    var xmlHttp = null;
    try {
        // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch(e) {
        //Internet Explorer
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e) {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}

// AJAX POST FUNCTION
function AjaxPost(url, param, success_function) {
	xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null) {
        alert("Your browser doesn't support AJAX. You should upgrade it!")
        return
    }
    xmlHttp.onreadystatechange = success_function;
    xmlHttp.open("POST", url, true);
    xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlHttp.send(param);
}

function $(d) {
    return document.getElementById(d);
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('game-' + id).style.height = height + 'px';
        $('game-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('game-' + id).style.display = 'none';
    }

}

function clickclear(thisfield) {
	if (thisfield.value.indexOf("Search") != -1) {
		thisfield.value = "";
		$('search_box').style.color = '#000';
    }
}
    
function clickrecall(thisfield) {
	if (thisfield.value == "") {
		$('search_box').value = 'Search '+ $('kongregate_category')[$('kongregate_category').selectedIndex].innerHTML;
		$('search_box').style.color = '#484848';
    }
}

function clearsearch() {
	$('search_box').value = 'Search '+ $('kongregate_category')[$('kongregate_category').selectedIndex].innerHTML;
	goTo(1);
}

function goTo(page, scroll) {
	if ($('search_box').value.indexOf("Search") != -1) {
		search = '';
	}
	else {
		search = '&search='+$('search_box').value;
	}
	location.hash = 'page='+page+'&cat='+$('kongregate_category').value+search;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadGames() {
	$('games_container').style.opacity = 0.5;
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	var url = "feeds/kongregate/kongregate_ajax.php?page=" + hashvalues['page'] + '&cat=' + hashvalues['cat'];

	$('kongregate_category').value = hashvalues['cat'];
	$('page').value = hashvalues['page'];
	
	if (hashvalues['search'] != undefined) {
		var url = url+"&s=" + hashvalues['search'];
		$('search_box').value = hashvalues['search'];
	}
	else {
		if (hashvalues['cat'] == 'All') {
			$('search_box').value = 'Search by phrase or ID';
		}
		else {
			$('search_box').value = 'Search '+ $('kongregate_category')[$('kongregate_category').selectedIndex].innerHTML;
		}
	}
		
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

function AddGame(id, k_id) {
	$('reject-icon-' + id).innerHTML = '';
	$('download-icon-' + id).innerHTML = '';
	$('play-icon-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("feeds/kongregate/get_kongregate_game.php", "k_id=" + k_id, 
			 function () {
			 	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('game-' + id).className = 'mochi_added';
					var p = eval("(" + xmlHttp.responseText + ")");
					$('play-icon-' + id).innerHTML = '<a href="../index.php?task=view&id='+p.new_id+'"><img src="images/go.png" width="24" height="24"></a>';
					$('download-icon-' + id).innerHTML = '<a href="index.php?task=manage_games#id='+p.new_id+'"><img src="images/edit.png" width="24" height="24"></a>';
					$('edit-game-' + id).innerHTML = '';
					$('game-' + id).style.height = '50px';
				}
    		}
	)
}

function PlayGame(id, height) {
	$('play-icon-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("feeds/kongregate/play_kongregate_game.php", "id=" + id, 
			 function () {
			 	if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
			 		$('game-' + id).style.height = height+'px';
					$('edit-game-' + id).innerHTML = xmlHttp.responseText;
					$('play-icon-' + id).innerHTML = '<img src="images/back.png" width="24" height="24" onclick="ClosePlayGame('+id+', '+height+')">';
				}
    		}
	)
}

function ClosePlayGame(id, height) {
	$('edit-game-' + id).innerHTML = '';
	$('game-' + id).style.height = '50px';
	$('play-icon-' + id).innerHTML = '<img src="images/go.png" width="24" height="24" onclick="PlayGame('+id+', '+height+')">';
}

function RejectGame(id) {
		doMove(id, 50, 1);
		AjaxPost("feeds/kongregate/reject_kongregate_game.php", "id=" + id, 
			 function () {}
	)
}
function searchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("goTo(1)", 300);
}

function usehashvalues(page) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(page);
			
		LoadGames();
    }
}

function pageloadcheck() {
	
	gethashvalues(window.location.hash);
	
	LoadGames();

}