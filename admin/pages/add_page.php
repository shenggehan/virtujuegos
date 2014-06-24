<?php 
if ($_POST) {
	include('../../config.php');
	include('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();	
	include '../admin_functions.php';
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	$tags = escape($_POST['meta_tags']);
	$seo_name = create_seoname($_POST['name'], 0, 'page');
	mysql_query("INSERT INTO ava_pages (name, page, menu, seo_url, meta_tags) VALUES ('$name', '$content', $_POST[menu], '$seo_name', '$tags')") or die(mysql_error());
	header("Location: ../index.php?task=manage_pages");

} else {
if ($login_status != 1) exit();

?>

<head><script language="javascript" type="text/javascript" src="<?php echo $setting['site_url']; ?>/admin/js/wyzz.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="pages/add_page.php">
  <div class="page_label">Page title</div>
  <input name="name" type="text" size="30" class="page_title"  />
  <br /><br />

  <div class="page_label">Page content</div>
  <textarea id="page" name="content" cols="100" rows="12"></textarea>

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
  <input name="meta_tags" type="text" size="30" class="page_title"  /><br /><br />
  
<div class="page_label">Show in menu</div>
<div class="drop_down_container">
          <input name="menu" type="radio" value="1" checked="checked" />
        Yes
        <input name="menu" type="radio" value="0" /> No
       </div>
		
  <br />
  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>
</body>
</html>