<?php
if ($_POST) {
	include '../../config.php';
	include('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
	include '../admin_functions.php';
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	$tags = escape($_POST['meta_tags']);
	$seo_name = create_seoname($_POST['name'], $_POST['id'], 'news');
	mysql_query("UPDATE ava_news SET title='$name', image='$_POST[image]', content='$content', seo_url = '$seo_name', meta_tags = '$tags' WHERE id='$_POST[id]'") or die (mysql_error());
	header("Location: ../index.php?task=manage_news");

} else {
	if ($login_status != 1) exit();
	$sql = mysql_query("SELECT * FROM ava_news WHERE id=".$_GET['id']."");
	$row = mysql_fetch_array($sql);

?>

<head><script language="javascript" type="text/javascript" src="<?php echo $setting['site_url']; ?>/admin/js/wyzz.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="pages/edit_news.php">
  <div class="page_label">Headline</div>
  <input name="name" type="text" size="30" class="page_title" value="<?php echo htmlspecialchars($row['title']);?>"  />
  <br /><br />
  <div class="drop_down_container">
  <div class="page_label">News image</div>
  <select name="image">
      <?php
	$dir = opendir('../uploads/news_icons');
	while (false !== ($file = readdir($dir))) {
		if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store") {
			if ($file == $row['image']) {
				echo '<option value="'.$file.'" selected>'.$file.'</option>';
			}
			else {
				echo '<option value="'.$file.'">'.$file.'</option>';
			}
		}
	}
	closedir($dir);
?>
       </select>
  </div>
   <br />
  <div class="page_label">News content</div>
  <textarea id="page" name="content" cols="100" rows="12"><?php echo $row['content'];?></textarea>

  <script type="text/javascript">
	<?php if (file_exists('../uploads/ckeditor')) {
  		echo "CKEDITOR.replace( 'page', { width: '790px' } );";
  	}
  	else {
		echo "make_wyzz('page')";
	}
	?>
  </script>

  <input name="id" type="hidden" value="<?php echo $_GET['id'];?>">
  <br>
  
  <div class="page_label">Meta tags</div>
  <input name="meta_tags" type="text" size="30" class="page_title" value="<?php echo htmlspecialchars($row['meta_tags']);?>" /><br /><br />
  
  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>
</body>
</html>