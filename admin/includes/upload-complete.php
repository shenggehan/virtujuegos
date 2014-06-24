<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<script type="application/javascript">
<?php if ($_GET['type'] == 'game') { ?>
function Complete() {
	lol = 'parent.file_selector(2, "<?php echo $_GET['newfile'];?>", <?php echo $_GET['id'];?>)'
	setTimeout ( lol, 500 );
}
<?php } else { ?>
function Complete() {
	lol = 'parent.image_selector(2, "<?php echo $_GET['newfile'];?>", <?php echo $_GET['id'];?>)'
	setTimeout ( lol, 500 );
}
<?php } ?>
</script>
</head>

<body onload="Complete()">
Upload complete
</body>
</html>