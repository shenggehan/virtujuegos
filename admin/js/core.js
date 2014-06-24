/*
AV ARCADE
Core javascript functions
Written by Andy Venus
*/

var timeout	= 0;
var closetimer	= 0;
var ddmenuitem	= 0;
var lastitem	= 0;

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

///////////////////
// DROPDOWN MENU //
///////////////////

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(ddmenuitem) { 
		ddmenuitem.style.visibility = 'hidden';
		$(lastitem+'-t').style.background = 'none';
	}

	// get new layer and show it
	ddmenuitem = document.getElementById(id);
	lastitem = id;
	ddmenuitem.style.visibility = 'visible';
	$(id+'-t').style.background = '#1a385b url(images/menu_bg.png)';

}
// close showed layer
function mclose()
{
	if(ddmenuitem) { 
		ddmenuitem.style.visibility = 'hidden';
		$(lastitem+'-t').style.background = 'none';
	}
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
document.onclick = mclose; 

// Use HTML5 hashchange event if available 
if ("onhashchange" in window) {
    window.onhashchange = function () {
       	usehashvalues(window.location.hash);
    }
}
else { 
   	var storedHash = window.location.hash;
    window.setInterval(function () {
        if (window.location.hash != storedHash) {
            storedHash = window.location.hash;
            usehashvalues(storedHash);
        }
    }, 100);
}

// Get data from the url hash
function gethashvalues(page) {
	page = page.replace('#', '');
        	
        hashvalues = new Array();
		var pairs = page.split( "&" );
		for ( i in pairs )
		{
		    var keyval = pairs[ i ].split( "=" );
			    hashvalues[ keyval[0] ] = keyval[1];
		}
}

// Simple go to url on click
function gotourl(url) {
	window.location = url;
}