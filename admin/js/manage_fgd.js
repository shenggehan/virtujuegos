/*
AV ARCADE
Manage fgd Games

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
		$('search_box').value = 'Search '+ $('fgd_category')[$('fgd_category').selectedIndex].innerHTML;
		$('search_box').style.color = '#484848';
    }
}

function clearsearch() {
	$('search_box').value = 'Search '+ $('fgd_category')[$('fgd_category').selectedIndex].innerHTML;
	goTo(1);
}

function goTo(page, scroll) {
	if ($('search_box').value.indexOf("Search") != -1) {
		search = '';
	}
	else {
		search = '&search='+$('search_box').value;
	}
	location.hash = 'page='+page+'&cat='+$('fgd_category').value+search;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadGames(type, search, cat) {
	$('games_container').style.opacity = 0.5;
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	var url = "feeds/fgd/fgd_ajax.php?page=" + hashvalues['page'] + '&cat=' + hashvalues['cat'];

	$('fgd_category').value = hashvalues['cat'];
	$('page').value = hashvalues['page'];
	
	if (hashvalues['search'] != undefined) {
		var url = url+"&s=" + hashvalues['search'];
		$('search_box').value = hashvalues['search'];
	}
	else {
		if (hashvalues['cat'] == 'All') {
			$('search_box').value = 'Search All Games';
		}
		else {
			$('search_box').value = 'Search '+ $('fgd_category')[$('fgd_category').selectedIndex].innerHTML;
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

function AddGame(id, gametag) {
	$('reject-icon-' + id).innerHTML = '';
	$('download-icon-' + id).innerHTML = '';
	$('play-icon-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("feeds/fgd/get_fgd_game.php", "fgd_id=" + gametag, 
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
	AjaxPost("feeds/fgd/play_fgd_game.php", "id=" + id, 
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
		AjaxPost("feeds/fgd/reject_fgd_game.php", "id=" + id, 
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