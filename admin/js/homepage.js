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



function SubmitGame(id) {
	if (urltype == 1 || imgtype == 1) {
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
	
	param = "id=" + id + "&filetype=" + urltype[id] + "&game_name=" + gamename + "&game_description=" + gamedescription + "&game_instructions=" + gameinstructions + "&game_url=" + game_url + "&imagetype=" + imgtype[id] + "&image_url=" + image_url + "&game_category=" + $('category' + id).value + "&width=" + $('width' + id).value + "&height=" + $('height' + id).value + "&tags=" + $('game_tags' + id).value + "&game_advert=" + $('advert' + id).value + "&published=" + published + "&highscores=" + highscores + "&mochi_id=" + $('mochi_id' + id).value + "&submitter=" + $('submitter' + id).value + "&html_code=" + code + "&homepage=1";
	
	AjaxPost("includes/edit_game_submit.php", param, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
            		if (id != 0) {
                		$('tgame_name' + id).innerHTML = '<a href="../index.php?task=view&id=' + id + '" class="manage_link">' + $('game_name' + id).value + '</a>';
                		var w = $('category' + id).selectedIndex;
                		var selected_text = $('category' + id).options[w].text;
                		$('tcategory_name' + id).innerHTML = selected_text;
                		close_edit(id, 1);
            		}
           			else {
						alert(xmlHttp.responseText);
										
						$('game_name0').value = '';
						$('game_description0').value = '';
						$('game_instructions0').value = '';
						$('width0').value = '';
						$('game_tags0').value = '';
						$('submitter0').value = '';
						$('height0').value = '';
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

function pageloadcheck() {}