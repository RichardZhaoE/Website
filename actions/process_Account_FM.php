<?php
include_once("../include/config2.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['updateFMSettings']))
{
	$worldSelect = $_POST["world"];
	mysql_query("UPDATE accounts SET World = '$worldSelect' WHERE LoginID = '$loginCookie'");
	$defaultWorld = $worldSelect;
	die("Success");
}
?>