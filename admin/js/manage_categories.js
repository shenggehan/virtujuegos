/*
AV Arcade
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

function EditCategory(id) {
	$('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
	
	AjaxPost("includes/edit_category.php", "id=" + id, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('category-' + id).style.height = '270px';
            		$('edit-category-' + id).innerHTML = xmlHttp.responseText;
            		$('edit-image-' + id).innerHTML = '<img src="images/close.png" onclick="CloseEdit(' + id + ');">';
				}
    		}
	)
}

function CloseEdit(id, c) {
    $('category-' + id).style.height = '30px';
    $('edit-category-' + id).innerHTML = '';
    if (c == undefined) {
        $('edit-image-' + id).innerHTML = '<img src="images/edit.png" onclick="EditCategory(' + id + ');">';
    } else {
        $('edit-image-' + id).innerHTML = '<img src="images/edit-complete.png" onclick="EditCategory(' + id + ');">';
    }
}

function EditCategorySubmit(id) {
	
	if (id != 0) {
        $('edit-image-' + id).innerHTML = '<img src="images/load.gif">';
    }
	else {
		$('add_icon').innerHTML = '<img src="images/load.gif">';
		$('submit0').style.color = '#999';
   		$('submit0').value = 'Loading...';
	}
	
	catname = encodeURIComponent($('category_name' + id).value);
	catdesc = encodeURIComponent($('category_description' + id).value);
	catkeywords = encodeURIComponent($('category_keywords' + id).value);
	
	AjaxPost("includes/category_submit.php", "id="+id+"&name=" + catname +"&description=" + catdesc +"&keywords=" + catkeywords + "&parent_id=" + $('parent_id' + id).value, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					if (id == 0) {
						$('category_name0').value = '';
						$('category_description0').value = '';
						$('category_keywords0').value = '';
						$('submit0').style.color = '#fff';
   						$('submit0').value = 'Submit';
   						CloseAddGame();
   						RefreshCategories();
					}
					else {
						CloseEdit(id, 1);
						RefreshCategories();
					}
				}
    		}
	)
		
}

function EditOrderSubmit(id) {
	
	order_value = encodeURIComponent($('order_box' + id).value);
	
	AjaxPost("includes/category_order.php", "id="+id+"&order=" + order_value, 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('order_box' + id).style.border = '1px solid #4fb600';
				}
    		}
	)
		
}

function EditOrderDefault(id) {
	$('order_box' + id).style.border = '1px solid #CCC';
}

function DeleteAsk(id) {
	$('delete-image-' + id).innerHTML = '<img src="images/load.gif">';

	AjaxPost("includes/category_delete_options.php", "id="+id, 
		function () {
			if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
    			$('category-' + id).style.height = '80px';
   				$('edit-category-' + id).innerHTML = xmlHttp.responseText;
    			$('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="CloseDelete(' + id + ');">';
    		}
    	}
    )
}

function CloseDelete(id) {
    $('category-' + id).style.height = '30px';
    $('edit-category-' + id).innerHTML = '';
    $('delete-image-' + id).innerHTML = '<img src="images/delete.png" onclick="DeleteAsk(' + id + ');">';
}

function doMove(id, height, opacity) {
    if (height > 0) {
        height = (height - 6)
        opacity = opacity - 0.08
        $('category-' + id).style.height = height + 'px';
        $('category-' + id).style.opacity = opacity;

        setTimeout('doMove(' + id + ', ' + height + ', ' + opacity + ')', 10); // call doMove() in 20 msec
    }
    else {
        $('category-' + id).style.display = 'none';
    }

}

function DeleteCategory(id) {
	$('delete-image-' + id).innerHTML = '<img src="images/load.gif">';
	AjaxPost("includes/delete_category.php", "id=" + id + "&new_cat=" + $('new_category' + id).value, 
			 function () {
					doMove(id, 80, 1);
    		}
	)
}

function ShowAddGame() {
    $('add_category_form').style.display = 'inline';
    $('add_box').onclick = CloseAddGame;
	$('add_icon').innerHTML = '<img src="images/delete.png" onclick="CloseAddGame();">';
}

function CloseAddGame() {
	$('add_category_form').style.display = 'none';
	$('add_box').onclick = ShowAddGame;
	$('add_icon').innerHTML = '<img src="images/add.png" onclick="ShowAddGame();">';
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

function RefreshCategories() {
	$('load_image').innerHTML = '<img src="images/load2.gif">';
	AjaxPost('includes/manage_categories_ajax.php', '', 
			 function () {
				if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
					$('category_container').innerHTML = xmlHttp.responseText;
					$('load_image').innerHTML = '';
					AjaxPost('includes/refresh_dropdown.php', '', 
			 			function () {
							if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
								$('refresh_category').innerHTML = xmlHttp.responseText;
							}
    					}
					)
				}
    		}
	)
}

function pageloadcheck() {}