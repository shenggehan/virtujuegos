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

function edit_game(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
	//imgtype[id] = 3;
	//urltype[id] = 3;
	
	AjaxPost("includes/edit_game.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					//$('game-' + id).style.height = '660px';
            		$('edit-game-' + id).innerHTML = xmlHttp.responseText;
            		$('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="close_edit(' + id + ');">';
            		if (jQuery('#url'+id).length == 1) {
						urltype[id] = 3;
					}
					else {
						urltype[id] = 5;
					}
					imgtype[id] = 3;
				}
    		}
	)
}

function close_edit(id, c) {
    //$('game-' + id).style.height = '30px';
    lol2 = $('edit-game-' + id);
    lol2.innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_game(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="edit_game(' + id + ');">';
    }
	urltype[id] = 3;
	imgtype[id] = 3;
}

function SubmitGame(id) {
	if (urltype[id] == 1 || imgtype[id] == 1 || urltype[id] == 4 || imgtype[id] == 4) {
        alert('Please make sure you have uploaded the game and image files before submitting or select a file which has aready been uploaded');
        return
    }

    xmlHttp = GetXmlHttpObject()
    if (xmlHttp == null) {
        alert("Your browser doesn't support AJAX. You should upgrade it!")
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
    code = '';
    if (urltype[id] == 2) {
        game_url = $('drop-down' + id).value;
    }
    else if (urltype[id] == 5) {
	    game_url = 'code';
	    code = encodeURIComponent($('html_code' + id).value);
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
	
	param = "id=" + id + "&filetype=" + urltype[id] + "&game_name=" + gamename + "&game_description=" + gamedescription + "&game_instructions=" + gameinstructions + "&game_url=" + game_url + "&imagetype=" + imgtype[id] + "&image_url=" + image_url + "&game_category=" + $('category' + id).value + "&width=" + $('width' + id).value + "&height=" + $('height' + id).value + "&tags=" + $('game_tags' + id).value + "&game_advert=" + $('advert' + id).value + "&published=" + published + "&highscores=" + highscores + "&mochi_id=" + $('mochi_id' + id).value + "&submitter=" + $('submitter' + id).value + "&html_code=" + code;
	
	AjaxPost("includes/edit_game_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            		if (id != 0) {
                		$('tgame_name' + id).innerHTML = '<a href="../index.php?task=view&id=' + id + '" class="manage_link">' + $('game_name' + id).value + '</a>';
                		var w = $('category' + id).selectedIndex;
                		var selected_text = $('category' + id).options[w].text;
                		$('tcategory_name' + id).innerHTML = selected_text;
                		close_edit(id, 1);
                		PublishedButton(id, published);
            		}
           			else {
               			var newdiv = document.createElement('div');
                		newdiv.innerHTML = xmlHttp.responseText;
                		$('games_container').insertBefore(newdiv, $('thetop').nextSibling);
                		$('add_game_form').style.display = 'none';
						$('add_icon').innerHTML = '<img src="images/add.png">';
						$('add_box').onclick = ShowAddGame;
				
						$('game_name0').value = '';
						$('game_description0').value = '';
						$('game_instructions0').value = '';
						$('game_tags0').value = '';
						$('mochi_id0').value = '';
						$('width0').value = '';
						$('height0').value = '';
						$('published0').checked = true;
						$('submit0').style.color = '#fff';
    					$('submit0').value = 'Submit';
				
						file_selector(3, 0, 0);
						image_selector(3, 0, 0);
				
						if (urltype[0] != 2) {
        					$('url0').value = '';
						}
						if (imgtype[0] != 2) {
        					$('img0').value = '';
    					}
            		}
        		}
    		}
	)
}

function DeleteAsk(id) {
    //$('game-' + id).style.height = '90px';
 $('edit-game-' + id).innerHTML = '<div class="form_container"><div class="delete_container"><br><div class="button3"><a href="#" onclick="DeleteGame(' + id + ', 0);return false">Database delete</a></div>&nbsp;&nbsp;&nbsp;<div class="button3"><a href="#" onclick="DeleteGame(' + id + ', 1);return false">File & DB delete</a></div></div></div>';
    $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="edit_game(' + id + ');">';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
}

function CloseDelete(id) {
    //$('game-' + id).style.height = '30px';
    $('edit-game-' + id).innerHTML = '';
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

function DeleteGame(id, files) {
	AjaxPost("includes/delete_game.php", "id=" + id + "&files=" + files, 
			 function () {
					doMove(id, 90, 1);
    		}
	)
}

function ShowAddGame() {
    $('add_game_form').style.display = 'inline';
	$('add_box').onclick = CloseAddGame;
	$('add_icon').innerHTML = '<img src="images/delete.png">';
}

function CloseAddGame() {
	$('add_game_form').style.display = 'none';
	$('add_box').onclick = ShowAddGame;
	$('add_icon').innerHTML = '<img src="images/add.png">';
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
	$('search_box').value = 'Search '+ $('category_filter')[$('category_filter').selectedIndex].innerHTML;
	$('search_box').style.color = '#484848';
	goTo(1);
}

function goTo(page, scroll) {
	if ($('search_box').value.indexOf("Search") != -1) {
		search = '';
	}
	else {
		search = '&search='+$('search_box').value;
	}
	location.hash = 'page='+page+'&cat='+$('category_filter').value+search;
	if (scroll == 1) {
		window.scrollTo(0, 270);
	}
}

function LoadGames() {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	
	if (hashvalues['id'] == undefined) {
	
		var url = "includes/manage_games_ajax.php?page=" + hashvalues['page'] + '&cat=' + hashvalues['cat'];

		$('category_filter').value = hashvalues['cat'];
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
				$('search_box').value = 'Search '+ $('category_filter')[$('category_filter').selectedIndex].innerHTML;
			}
		}
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

function searchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("goTo(1)", 300);
}

function FeatureGame(id, on) {
	if (on == 1) {
		$('feature_icon' + id).innerHTML = '<img src="images/feature_on.png" onclick="FeatureGame('+id+');">';
	}
	else {
		$('feature_icon' + id).innerHTML = '<img src="images/feature.png" onclick="FeatureGame('+id+', 1);">';
	}
	
	AjaxPost('includes/feature_game.php', 'id='+id, 
			 function () {
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

function TogglePublished(id, value) {
	AjaxPost("includes/publish_game.php", "id=" + id + "&value=" + value, 
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

function getFileName(url){
  var path = window.location.pathName;
  var file = path.replace(/^.*\/(\w{2})\.html$/i, "$1");
  return file ? file : "undefined";
}

// Load the correct games from the hash values
function usehashvalues(hash) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(hash);
			
		LoadGames();
    }
}
// On page load get hash values and display correct games
function pageloadcheck() {
	
	gethashvalues(window.location.hash);
	
	if (hashvalues['id'] != undefined) {
		urltype[hashvalues['id']] = 3;
	}
	
	LoadGames();

}