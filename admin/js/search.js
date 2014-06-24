var TIMER;
var current = 1;

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

// GET ELEMENT BY ID
function $(d) {
    return document.getElementById(d);
}

function gclickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
		thisfield.value = "";
    }
    else {
    	$('search_popup').style.display = 'inline';
		$('global_sc').style.backgroundImage = 'url(images/search_popup_top.png)';
	}
}
    
function gclickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
		thisfield.value = defaulttext;
    }
}

// Search input
function searchInput(ev) {

  arrows=((ev.which)||(ev.keyCode));
  
switch(arrows) {

 case 38:
   $(current).className = 'search_item';
   $(current-1).className = 'search_item_selected';
   current = current-1;
   return false;
   break;

 case 40:
   $(current).className = 'search_item';
   $(current+1).className = 'search_item_selected';
   current = current+1;
   return false;
   break;
   
  case 13:
  	go(current);
  	break;
  	
  default:
  	globalSearchTimer();
  	break;

  }
 }
 
// Highlight search result
function highlightResult(id) {
	$(current).className = 'search_item';
  	$(id).className = 'search_item_selected';
  	current = id;
}

// Go to search result
function go(id) {
	window.location = $('slnk'+id).href;
	hideResults(1);
}

// Get search results
function fetchResults() {	
	AjaxPost("admin_search.php", "q=" + $('gSearch').value, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					if (xmlHttp.responseText != '') {
						$('search_results').innerHTML = xmlHttp.responseText;
						$('search_popup').style.display = 'inline';
						$('global_sc').style.backgroundImage = 'url(images/search_popup_top.png)';
						current = 1;
					}
					else {
						hideResults(1);
					}
				}
    		}
	)
}

function hideResults(go) {
	if (go == 1) {
		$('search_popup').style.display = 'none';
		$('global_sc').style.backgroundImage = '';
	}
	else {
		setTimeout("hideResults(1)", 100);
	}
}

// Search countdown timer
function globalSearchTimer() {
  if (TIMER) {
   clearTimeout(TIMER);
 }
 TIMER = setTimeout("fetchResults()", 300);
}