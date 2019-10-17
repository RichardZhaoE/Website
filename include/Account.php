<div class="refreshButton">
	<a href="#" onClick="loadContents('Account') "><img src="images/refresh.png"></a>
</div>


<div class="post">
	<div class="posttitle">

<?php
if(isset($loginCookie))
{
?>
		My Account - Information
	</div>
	<div class="postcontent">
	</div>
	//Logged in

<?
}else{
?>
		My Account - Login
	</div>
	<div class="postcontent">
		<a href="#" onClick="loadContents('Register')">Register</a>
	</div>

<?
}
?>
</div>