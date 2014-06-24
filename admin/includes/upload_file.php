<?php
require_once '../../config.php';
include '../secure.php';
if ($login_status != 1) exit();
if (isset($_GET['done'])) {
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
	}
	else
	{

		if ($_POST['type'] == 'game') {
			$directory = "../../games/";}
		else {
			$directory = "../../games/images/"; }
		
		$filename = basename($_FILES['file']['name']);
		$ext = substr($filename, strrpos($filename, '.') + 1);

		if (file_exists($directory . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
		}
		elseif (((strpos($ext, "php") !== false) || $ext == 'aspx' || $ext == 'py' || $ext == 'htaccess') && !isset($allow_php_uploads)) {
			echo 'Uploading PHP files disabled';
		}
		else
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],
				$directory . $_FILES["file"]["name"]);
			$text = "File " . $_FILES["file"]["name"] . " has been uploaded to the games folder<br />";
			header("Location: upload-complete.php?type=".$_POST['type']."&newfile=".$_FILES["file"]["name"]."&id=".$_POST['id']."");
		}
	}
?>
  <?php } else { ?><head>
 <style type="text/css">
 body {
	 margin:0px;
	 padding:0px;
 }
 </style>
 </head>

 <form action="upload_file.php?done=1" method="post"
enctype="multipart/form-data">
  <input type="file" name="file" id="file" />
  <input name="id" type="hidden" value="<?php echo $_GET['id'];?>" />
  <input name="type" type="hidden" value="<?php echo $_GET['type'];?>" />
  <input type="submit" name="submit" value="Upload" />
</form>
<?php } ?>