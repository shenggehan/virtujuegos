<?php 
if ($_POST) {
	include('../../config.php');
	include('../../includes/core.php');
	include '../secure.php';
	if ($login_status != 1) exit();
	$date = date("F j Y H:i");
	include '../admin_functions.php';
	$name = escape($_POST['name']);
	$content = escape($_POST['content']);
	$tags = escape($_POST['meta_tags']);
	$seo_name = create_seoname($_POST['name'], 0, 'news');
	mysql_query("INSERT INTO ava_news (title, content, user, date, image, seo_url, meta_tags) VALUES ('$name', '$content', '$_COOKIE[ava_userid]', '$date', '$_POST[image]', '$seo_name', '$tags')");
	header("Location: ../index.php?task=manage_news");

} else {
if ($login_status != 1) exit();
?>

<head><script language="javascript" type="text/javascript" src="<?php echo $setting['site_url']; ?>/admin/js/wyzz.js"></script>
</head>
<body>
<form id="form1" name="form1" method="post" action="pages/add_news.php">
  <div class="page_label">Headline</div>
  <input name="name" type="text" size="30" class="page_title"  />
  <br /><br />
  <div class="drop_down_container">
  <div class="page_label">News image</div>
  <select name="image">
      <?php
	$dir = opendir('../uploads/news_icons');
	while (false !== ($file = readdir($dir))) {
		if ($file != "." && $file != ".." && $file != "Thumbs.db" && $file != ".DS_Store") {
			echo '<option value="'.$file.'">'.$file.'</option>';
		}
	}
	closedir($dir);
?>
       </select>
  </div>
   <br />
  <div class="page_label">News content</div>
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

  <br>
  
  <div class="page_label">Meta tags</div>
  <input name="meta_tags" type="text" size="30" class="page_title"  /><br /><br />
  
  <div class="page_button_container"><input class="button" name="Submit" type="submit" value="Submit" id="submit0" /></div>
</form>
<?php   }
?>
</body>
</html>