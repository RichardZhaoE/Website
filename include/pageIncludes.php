<?php 
//require_once("config/config.php");
	
	$getpage = isset($_GET['p']) ? $_GET['p'] : "";

	switch($getpage){
		case NULL:
			$getpage = "Home";
			break;
		case "About":
			$getpage = "About";
			break;
		case "Contact":
			$getpage = "Contact";
			break;
		case "Account":
			$getpage = "Account";
			break;
		case "Register":
			$getpage = "Register";
			break;

		case "MyAccount":
			$getpage = "MyAccount";
			break;
		case "subscribe":
			$getpage = "Subscribe";
			break;
		case "Reviews":
			$getpage = "Construction";
			break;
		case "Review":
			$getpage = "Reviews";
			break;
		case "fmowl":
			$getpage = "fmEcho";
			break;

		case "forgotpass":
			$getpage = "ForgotPassword";
			break;
		case "memberStatus":
			$getpage = "Members";
			break;
		case "accesslogs":
			$getpage = "Access";
			break;
		case "TOS":
			$getpage = "TOS";
			break;

		case "control":
			$getpage = "Control";
			break;


		case "Error":
			$getpage = "Error";
			break;
		case "index":
		default:
			$getpage = "Home";
			break;
	}
	include("../pages/".$getpage.".php");
	//include_once('footer.php');
?>