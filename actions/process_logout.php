<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['Logout']))
{
	if($_POST['Logout'] == "LogOut")
	{
		setcookie("LoginID", '', time()-3600, '/');
		setcookie("Password", '', time()-3600, '/');
		setcookie("Admin", '', time()-3600, '/');
		die("LoggedOut");
	}else{
		die("An unknown error has occured. Please try again.");
	}
}
?>