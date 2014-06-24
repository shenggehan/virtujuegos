<?php
// mySQL information
$server = 'localhost';                   // MySql server
$username = 'virtujuegos_net';                      // MySql Username
$password = 'GxdzMWwB' ;                         // MySql Password
$database = 'virtujuegos_net';                  // MySql Database

// The following should not be edited
  $con = mysql_connect("$server","$username","$password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("$database", $con); 


// Get settings
if (!isset($install)) {
	$sql = mysql_query("SELECT * FROM ava_settings");
	while ($get_setting = mysql_fetch_array($sql)) {
		$setting[$get_setting['name']] = $get_setting['value'];
	}
}
?>