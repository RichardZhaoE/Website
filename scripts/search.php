<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['world']))
{
	$searchString = $_POST['searchParam'];
	$world = $_POST['world'];
	header("Location: ../home.php?p=fmowl&world=$world&name=$searchString");
}else{
	die("You do not have permission to access this page.");
}

?>