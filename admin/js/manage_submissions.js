pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(43,11); 
pic2.src="images/load2.gif"; 
pic2= new Image(24,24); 
pic2.src="images/close.png"; 
var TIMER;
var pageis;
var storedHash;

function Reviewgame(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';

	AjaxPost("includes/review_submission.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('game-' + id).style.height = '670px';
            		lol2 = $('edit-game-' + id);
            		lol2.innerHTML = xmlHttp.responseText;
            		$('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="CloseReview(' + id + ');">';
					urltype[id] = 3;
					imgtype[id] = 3;
				}
    		}
	)
}

function CloseReview(id, c) {
    $('game-' + id).style.height = '50px';
    lol2 = $('edit-game-' + id);
    lol2.innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/dl.png" onclick="Reviewgame(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="Reviewgame(' + id + ');">';
    }
	urltype[id] = 3;
	imgtype[id] = 3;
}


function SubmitGame(id) {
	if (urltype == 1 || imgtype == 1 || urltype == 4 || imgtype == 4) {
        alert('Please make sure you have uploaded the game and image files before submitting or select a file which has aready been uploaded');
        return
    }

    $('submit' + id).style.color = '#999';
    $('submit' + id).value = 'Updating...';
    if (id != 0) {
        $('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
    }
	else {
		$('add_icon').innerHTML = '<img src="images/load.gif">';
	}

    var url = "includes/edit_game_submit.php";
    if (urltype[id] == 2) {
        game_url = $('drop-down' + id).value;
    }
    else {
        game_url = $('url' + id).value;
    }

    if (imgtype[id] == 2) {
        image_url = $('image-drop-down' + id).value;
    }
    else {
        image_url = $('img' + id).value;
    }
    
    if ($('published' + id).checked) {
    	published = 1;
    }
    else {
    	published = 0;
    }
    
    if ($('highscores' + id).checked) {
    	highscores = 1;
    }
    else {
    	highscores = 0;
    }
    
    gamename = encodeURIComponent($('game_name' + id).value);
    gamedescription = encodeURIComponent($('game_description' + id).value);
    gameinstructions = encodeURIComponent($('game_instructions' + id).value);
    game_url = encodeURIComponent(game_url);
	
	param = "id=0" + "&filetype=" + urltype[id] + "&game_name=" + gamename + "&game_description=" + gamedescription + "&game_instructions=" + gameinstructions + "&game_url=" + game_url + "&imagetype=" + imgtype[id] + "&image_url=" + image_url + "&game_category=" + $('category' + id).value + "&width=" + $('width' + id).value + "&height=" + $('height' + id).value + "&tags=" + $('game_tags' + id).value + "&game_advert=" + $('advert' + id).value + "&published=" + published + "&highscores=" + highscores + "&mochi_id=" + $('mochi_id' + id).value + "&submitter=" + $('submitter' + id).value;
	
	AjaxPost("includes/edit_game_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					AjaxPost("includes/delete_submission.php", "id=" + id + '&givepoints=1&user=' + $('submitter' + id).value, 
			 				function () {
								doMove(id, 120, 1);
								$('edit-game-' + id).innerHTML = '';
    						}
					)
                }
    		}
	)
}

function DeleteAsk(id) {
 $('delete-image-' + id).innerHTML = '<input class="button_no" name="Submit" type="button" value="Delete" onclick="Deletegame('+id+');" /><input class="button" name="Submit" type="button" value="Cancel" onclick="CloseDelete('+id+');" />';
}

function CloseDelete(id) {
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
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

function Deletegame(id) {
	AjaxPost("includes/delete_submission.php", "id=" + id, 
			 function () {
					doMove(id, 120, 1);
    		}
	)
}

function GetDimensions(id) {
	if (urltype[id] == 3) {
		file = $('url' + id).value
	}
	else {
		file = $('drop-down' + id).value;
	}
	
	AjaxPost("includes/dimensions.php", "file=" + file + "&type=" + urltype[id], 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					var p = eval("(" + xmlHttp.responseText + ")");
					$('width' + id).value = p.width;
					$('height' + id).value = p.height;
				}
    		}
	)
}

function goTo(page, scroll) {
	location.hash = 'page='+page;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function Loadgames() {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	if (hashvalues['id'] == undefined) {
	
		var url = "includes/manage_submissions_ajax.php?page=" + hashvalues['page'];

		$('page').value = hashvalues['page'];
	
	}
	else {
		var url = "includes/manage_games_ajax.php?id="+hashvalues['id'];
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

function grabFile(id, type) {
	if(type == 1) {
		grab_url = $('grab' + id).value;
		$('grab_button' + id).innerHTML = '<img src="images/loader3.gif" />';
	}
	else {
		grab_url = $('grab_image' + id).value;
		$('grab_image_button' + id).innerHTML = '<img src="images/loader3.gif" />';
	}
	AjaxPost('includes/grab_file.php', 'type='+type+'&url='+grab_url, 
		function () {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
				if(type == 1) {
					var filename = $('grab' + id).value.substring($('grab' + id).value.lastIndexOf('/')+1);
					file_selector(2, filename, id);
				}
				else {
					var filename = $('grab_image' + id).value.substring($('grab_image' + id).value.lastIndexOf('/')+1);
					image_selector(2, filename, id);
				}
			}
    	}
	)
}

function getFileName(url){
  var path = window.location.pathName;
  var file = path.replace(/^.*\/(\w{2})\.html$/i, "$1");
  return file ? file : "undefined";
}

// Load the correct games from the hash values
function usehashvalues(hash) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(hash);
			
		Loadgames();
    }
}
// On page load get hash values and display correct games
function pageloadcheck() {
	
	gethashvalues(window.location.hash);
	
	Loadgames();

}

function PlayGame(id, height) {
	$('play-icon-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("includes/play_submitted_game.php", "id=" + id, 
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