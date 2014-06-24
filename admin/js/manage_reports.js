/*
AV ARCADE
Manage Reported Games Script

AJAX management of AV Arcade Reported Games
*/

// Image preload

pic1= new Image(24,24); 
pic1.src="images/load.gif"; 
pic2= new Image(24,24); 
pic2.src="images/edit-complete.png"; 
pic3= new Image(24,24); 
pic3.src="images/close.png"; 
pic4= new Image(10,30); 
pic4.src="images/newly_added.png"; 

function DeleteReported(id, type, user) {
	AjaxPost("includes/delete_report.php", "id=" + id + "&type=" + type + "&user=" + user, 
			 function () {
			 	if (type == 1) {
					$('reported-' + id).style.borderColor = '#00b223';
				}
				else {
					$('reported-' + id).style.borderColor = '#b20001';
				}
				
				$('good-report-' + id).innerHTML = '';
				$('bad-report-' + id).innerHTML = '';
    		}
	)
}

function LoadReports() {
	$('reported_container').style.opacity = 0.5;
	
	$('report_type').value = hashvalues['type'];
	
	AjaxPost("includes/manage_reports_ajax.php?type="+hashvalues['type']+"&page=" + hashvalues['page'], '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('reported_container').innerHTML = xmlHttp.responseText;
					$('reported_container').style.opacity = 1;
				}
    		}
	)
}

function ChangePage() {
	window.location = '#page='+$('page').value+'&type='+hashvalues['type'];
}

function clickclear(thisfield, defaulttext) {
	if (thisfield.value == defaulttext) {
		thisfield.value = "";
    }
}
    
function clickrecall(thisfield, defaulttext) {
	if (thisfield.value == "") {
		thisfield.value = defaulttext;
    }
}

function change_location(location) {
	window.location = location
}

// Load the correct games from the hash values
function usehashvalues(hash) {
	if (location.href.indexOf("#") != -1) {
        
        gethashvalues(hash);
			
		LoadReports();
    }
}
// On page load get hash values and display correct games
function pageloadcheck() {
	
	gethashvalues(window.location.hash);
	
	if (hashvalues['id'] != undefined) {
		urltype[hashvalues['id']] = 3;
	}
	
	LoadReports();

}