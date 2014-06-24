/*
AV ARCADE
Manage Categories Script

AJAX management of AV Arcade games

Written by Andy Venus
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

function DeleteAsk(id) {
    $('page-' + id).style.height = '80px';
    $('edit-page-' + id).innerHTML = '<div class="form_container"><br>Are you sure you want to delete this page? &nbsp;<a href="#" onclick="Deletepage(' + id + ', 80, 1);return false">Yes</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="CloseDelete(' + id + ');return false">No</a></div>';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
}

function CloseDelete(id) {
    $('page-' + id).style.height = '30px';
    $('edit-page-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('page-' + id).style.height = height + 'px';
        $('page-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('page-' + id).style.display = 'none';
    }

}

function Deletepage(id) {
	AjaxPost("includes/delete_page.php", "id=" + id, 
			 function () {
					doMove(id, 80, 1);
    		}
	)
}

function pageloadcheck() {}