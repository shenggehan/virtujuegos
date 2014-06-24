var urltype=new Array();
var imgtype=new Array();
var urlvalue=new Array();
var imgvalue=new Array();
var codevalue=new Array();
urlvalue[0] = '';
imgvalue[0] = '';
codevalue[0] = '';

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function file_selector(str, newfile, id) {
	if (str == 1) {
		if (urltype[id] == 3) {
			urlvalue[id] = $("url"+id).value;
		}
		else if (urltype[id] == 5) {
			codevalue[id] = $("html_code"+id).value;
		}
		$("file_selection"+id).innerHTML = '<iframe style="border:none;" src="includes/upload_file.php?type=game&id='+id+'" width="320" height="40"></iframe>';
		$("enter_url_link"+id).className -= 'bold';
		$("upload_link"+id).className = 'bold';
		$("select_link"+id).className -= 'bold';
		$("grab_link"+id).className -= 'bold';
		urltype[id] = 1;
	}
	else if (str == 2) {
		if (urltype[id] == 3) {
			urlvalue[id] = $("url"+id).value;
		}
		else if (urltype[id] == 5) {
			codevalue[id] = $("html_code"+id).value;
		}
		$("file_selection"+id).innerHTML = 'Loading...';
		$("enter_url_link"+id).className -= 'bold';
		$("upload_link"+id).className -= 'bold';
		$("select_link"+id).className = 'bold';
		$("grab_link"+id).className -= 'bold';
		$("file_html_code"+id).className -= 'bold';
		LoadDropdown('games', newfile, id);
		urltype[id] = 2;
	}
	else if (str == 3) {
		if (urltype[id] == 5) {
			codevalue[id] = $("html_code"+id).value;
		}
		if (urlvalue[id] != null) {
			urlval = urlvalue[id];
		}
		else {
			urlval = '';
		}
		$("file_selection"+id).innerHTML = '<input name="url'+id+'" type="text" class="'+extracss+'text_box" id="url'+id+'" value="'+urlval+'" />';
		$("enter_url_link"+id).className = 'bold';
		$("upload_link"+id).className -= 'bold';
		$("select_link"+id).className -= 'bold';
		$("grab_link"+id).className -= 'bold';
		$("file_html_code"+id).className -= 'bold';
		urltype[id] = 3;
	}
	else if (str == 4) {
		if (urltype[id] == 3) {
			urlvalue[id] = $("url"+id).value;
		}
		else if (urltype[id] == 5) {
			codevalue[id] = $("html_code"+id).value;
		}
		if (urlvalue[id] != null) {
			urlval = urlvalue[id];
		}
		else {
			urlval = '';
		}
		$("file_selection"+id).innerHTML = '<div class="grab_container"><input name="url'+id+'" type="text" class="'+extracss+'text_box_grab" id="grab'+id+'" value="'+urlval+'" /></div><div class="grab_button" id="grab_button'+id+'" onclick="grabFile('+id+', 1);"><a href="#" onclick="return false">Grab</a></div>';
		$("grab_link"+id).className = 'bold';
		$("enter_url_link"+id).className -= 'bold';
		$("upload_link"+id).className -= 'bold';
		$("select_link"+id).className -= 'bold';
		$("file_html_code"+id).className -= 'bold';
		urltype[id] = 4;
	}
	else if (str == 5) {
		if (urltype[id] == 3) {
			urlvalue[id] = $("url"+id).value;
		}
		if (codevalue[id] != null) {
			codeval = codevalue[id];
		}
		else {
			codeval = '';
		}
		$("file_selection"+id).innerHTML = '<textarea class="'+extracss+'text_area_code" name="html_code" id="html_code'+id+'">'+codeval+'</textarea><div class="html_options">Optional: <a href="#" onclick="htmlToGame('+id+');return false" id="html_link'+id+'">Get details from HTML</a> or just submit plain HTML to use that.</div>';
		$("grab_link"+id).className -= 'bold';
		$("enter_url_link"+id).className -= 'bold';
		$("upload_link"+id).className -= 'bold';
		$("select_link"+id).className -= 'bold';
		$("file_html_code"+id).className = 'bold';
		urltype[id] = 5;
	}
}

function image_selector(str, newfile, id) {
	if (imgvalue[id] == 'undefined') {
		imgvalue[id] = '';
	}
	
	if (str == 1) {
		if (imgtype[id] == 3) {
			imgvalue[id] = $("img"+id).value;
		}
		$("image_selection"+id).innerHTML = '<iframe style="border:none;" src="includes/upload_file.php?type=image&id='+id+'" width="320" height="40"></iframe>';
		$("enter_url_link_image"+id).className -= 'bold';
		$("upload_link_image"+id).className = 'bold';
		$("select_link_image"+id).className -= 'bold';
		$("grab_link_image"+id).className -= 'bold';
		imgtype[id] = 1;
	}
	else if (str == 2) {
		if (imgtype[id] == 3) {
			imgvalue[id] = $("img"+id).value;
		}
		$("image_selection"+id).innerHTML = 'Loading...';
		$("enter_url_link_image"+id).className -= 'bold';
		$("upload_link_image"+id).className -= 'bold';
		$("select_link_image"+id).className = 'bold';
		$("grab_link_image"+id).className -= 'bold';
		LoadDropdown('image', newfile, id);
		imgtype[id] = 2;
	}
	else if (str == 3) {
		$("image_selection"+id).innerHTML = '<input name="image_url'+id+'" type="text" class="'+extracss+'text_box" id="img'+id+'" value="'+imgvalue[id]+'" />';
		$("enter_url_link_image"+id).className = 'bold';
		$("upload_link_image"+id).className -= 'bold';
		$("select_link_image"+id).className -= 'bold';
		$("grab_link_image"+id).className -= 'bold';
		imgtype[id] = 3;
	}
	else if (str == 4) {
		$("image_selection"+id).innerHTML = '<div class="grab_container"><input name="url'+id+'" type="text" class="'+extracss+'text_box_grab" id="grab_image'+id+'" value="" /></div><div class="grab_button" id="grab_image_button'+id+'" onclick="grabFile('+id+', 2);"><a href="#" onclick="return false">Grab</a></div>';
		$("grab_link_image"+id).className = 'bold';
		$("enter_url_link_image"+id).className -= 'bold';
		$("upload_link_image"+id).className -= 'bold';
		$("select_link_image"+id).className -= 'bold';
		imgtype[id] = 4;
	}
}

function LoadDropdown(str, newfile, id)
{ 
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
 {
 alert ("Your browser doesn't support AJAX. You should upgrade it!")
 return
 }
var url="includes/file_drop_down.php";
param="type="+str+"&id="+id;
if (typeof newfile != 'undefined') {
	param=param+"&selected="+newfile;
}
type=str;
ida = id;
xmlHttp.onreadystatechange=stateChanged; 
xmlHttp.open("POST",url,true);
xmlHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
xmlHttp.send(param);

}

function htmlToGame(id) {
	$('html_link'+id).innerHTML = 'Loading...';
	AjaxPost("includes/html_to_game.php", 'code='+ encodeURIComponent($('html_code'+id).value), 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('html_link'+id).innerHTML = 'Get details from HTML';
					response = eval('('+xmlHttp.responseText+')');
					if (confirm(response['message'].replace(/<br\s*[\/]?>/gi, "\n"))) {
						if ("src" in response) {
							urlvalue[id] = response['src'];
							file_selector(3, '', id);
						}
						if ("width" in response) {
							$('width'+id).value = response['width'];
						}
						if ("height" in response) {
							$('height'+id).value = response['height'];
						}
					}
				}
    		}
	)
}

function stateChanged() 
{ 
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
 if (xmlHttp.responseText == '') {
	 alert("An error occured in sending your message");
 }
 else 
  {
	  if (type == 'games') {
		  $("file_selection"+ida).innerHTML = xmlHttp.responseText;
	  }
	  else {
		  $("image_selection"+ida).innerHTML = xmlHttp.responseText;
	  }
  }
 } 
}