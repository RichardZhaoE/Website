<head>
<link href="css/login.css" rel="stylesheet" type="text/css" />
</head>
<div class="refreshButton">
	<a href="#" onClick="loadContents('Account') "><img src="images/refresh.png"></a>
</div>



<div class="post">

<?php
include_once('../include/config2.php');
if($loginCookie !== "Guest" && $loginCookie !== "")
{
	include("../pages/UserCP.php");
}else{
	include("../pages/Guest.php");
}
?>
</div>

<script>
$("#loadingBar").hide();
</script>