<?php 
if ($_POST) {
	include('../../config.php');
	include('../../includes/core.php');
	include '../secure.php';
	include '../admin_functions.php';
	if ($login_status != 1) exit();
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	$tags = escape($_POST['meta_tags']);
	$seo_name = create_seoname($_POST['name'], $_POST['id'], 'page');
	mysql_query("UPDATE ava_pages SET name='$name', page='$content', menu='$_POST[menu]', seo_url = '$seo_name', meta_tags = '$tags' WHERE id='".$_POST['id']."'") or die (mysql_error());
	header("Location: ../index.php?task=manage_pages");

} else {
	if ($login_status != 1) exit();
	$sql = mysql_query("SELECT * FROM ava_pages WHERE id=".$_GET['id']."");
	$row = mysql_fetch_array($sql);

?>
<head><script language="javascript" type="text/javascript" src="<?php echo $setting['site_url']; ?>/admin/js/wyzz.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="pages/edit_page.php">
  <div class="page_label">Page title</div>
  <input name="name" type="text" size="30" class="page_title" value="<?php echo htmlspecialchars($row['name']);?>" />
  <br /><br />
  <div class="page_label">Page content</div>
  <textarea id="page" name="content" cols="100" rows="12"><?php echo ''.$row['page'].'' ?></textarea>

  <script type="text/javascript">
	<?php if (file_exists('../uploads/ckeditor')) {
  		echo "CKEDITOR.replace( 'page', { width: '790px' } );";
  	}
  	else {
		echo "make_wyzz('page')";
	}
	?>
  </script>

  <br />
  
  <div class="page_label">Meta tags</div>
  <input name="meta_tags" type="text" size="30" class="page_title" value="<?php echo htmlspecialchars($row['meta_tags']);?>" /><br /><br />
  
  <div class="page_label">Show in menu</div>
<div class="drop_down_container">
  <?php if ($row['menu'] == 1) { echo '
          <input name="menu" type="radio" value="1" checked="checked" />
        Yes
        <input name="menu" type="radio" value="0" /> No';}
		else {
		echo'<input name="menu" type="radio" value="1" />
        Yes
        <input name="menu" type="radio" value="0" checked="checked" /> No';
		} ?>
</div>
  <input name="id" type="hidden" value="<?php echo $_GET['id'];?>">

  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>
</body>
</html>