<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
<!--
body {
	background-color:#000;
	color:#FFF;
}
.site_name {
	font-family:Verdana, Geneva, sans-serif;
}
.site_name a {
	color:#FFF;
}
.site_name a:visited {
	color:#FFF;
}
-->
</style>
</head>
<?php 

require_once '../../config.php';
include ('../../includes/core.php');
include '../../language/'.$setting['language'].'.php';

$id = intval($_GET['id']);
$sql = mysql_query("SELECT * FROM ava_games WHERE id='".$id."'") or die (mysql_error());
$row = mysql_fetch_assoc($sql);

$url = GameUrl($id, $row['seo_url'], $row['category_id']);
	
?>
<body>
<p class="site_name"><?php echo $setting['site_name'];?> | <a target="_parent" href="<?php echo $url;?>">&lt; Return to game page</a></p>
</body>
</html>
