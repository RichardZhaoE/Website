<?php
$host['host'] = '';                // my host
$host['userName'] = 'Website';       // my database username
$host['passWord'] = '';   // my database password
$host['databaseName'] = '';       // my database name
$userIP = $_SERVER['REMOTE_ADDR'];

if(isset($_SERVER["HTTP_CF_CONNECTING_IP"])){
	$userIP = $_SERVER["HTTP_CF_CONNECTING_IP"];
}







function check_input($value)
{
	// Stripslashes
	if (get_magic_quotes_gpc())
	{
		$value = stripslashes($value);
	}
	// Quote if not a number
	if (!is_numeric($value))
	{
		$value = "'" . mysql_real_escape_string($value) . "'";
	}
	return $value;
}

?>