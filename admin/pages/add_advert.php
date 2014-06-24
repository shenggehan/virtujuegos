<?php 
if ($_POST) {
	include('../../config.php');
	include '../secure.php';
	if ($login_status != 1) exit();	
	include '../admin_functions.php';
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	mysql_query("INSERT INTO ava_adverts (ad_name, ad_content) VALUES ('$name', '$content')") or die(mysql_error());
	header("Location: ../index.php?task=manage_adverts");

} else {
if ($login_status != 1) exit();

?>

<form id="form1" name="form1" method="post" action="pages/add_advert.php">
  <div class="page_label">Advert title</div>
  <input name="name" type="text" size="30" class="page_title"  />
  <br /><br />
  <div class="page_label">Advert content (HTML)</div>
  <textarea id="page" name="content" cols="100" rows="12"></textarea>


  <br /><br />
  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>