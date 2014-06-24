<?php 
if ($_POST) {
	include('../../config.php');
	include '../secure.php';
	include '../admin_functions.php';
	if ($login_status != 1) exit();
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	mysql_query("UPDATE ava_adverts SET ad_name='$name', ad_content='$content' WHERE id='".$_POST['id']."'") or die (mysql_error());
	header("Location: ../index.php?task=manage_adverts");

} else {
	if ($login_status != 1) exit();
	$sql = mysql_query("SELECT * FROM ava_adverts WHERE id=".$_GET['id']."");
	$row = mysql_fetch_array($sql);

?>
<form id="form1" name="form1" method="post" action="pages/edit_advert.php">
  <div class="page_label">Advert title</div>
  <input name="name" type="text" size="30" class="page_title" value="<?php echo htmlspecialchars($row['ad_name']);?>" />
  <br /><br />
  <div class="page_label">Advert content (HTML)</div>
  <textarea id="page" name="content" cols="100" rows="12"><?php echo ''.$row['ad_content'].'' ?></textarea>

  <br /><br />

  <input name="id" type="hidden" value="<?php echo $_GET['id'];?>">

  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>
