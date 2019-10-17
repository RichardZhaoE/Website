<?php
include_once('../include/config2.php');
	
	if($loginCookie == "Guest" || $loginCookie == "")
	{
	?>
		<div class="accountBox2">
		<br />
		<br />
        <br />
        <br />
		<form onsubmit="return accountBoxLinkClick();"><input type="submit"  value="Login" /> or <input type="submit"  value="Sign Up" /><br>
		</div>
	<?php
	}else{
	?>
		<div class="accountBox">
	<?php
		echo "Welcome <a href='#' onClick=loadContents('Account');>$loginCookie</a>!<br />";
		echo "Subscription Status: $subscriptionString";
	?>
		<div align='right' style='padding-left:5px;' >
                <div>
			<center>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="VU8FK3QLEPPX2">

			<input type="hidden" name="on0" value="Time" />
			<center>
			<div align='left'>Time: <select name="os0" style="width:200px;">
				<option value="1 Month (31 Days)">1 Month (31 Days) $3.00 USD</option>
				<option value="2 Months (62 Days)">2 Months (62 Days) $6.00 USD</option>
				<option value="3 Months (93 Days)">3 Months (93 Days) $9.00 USD</option>
				</select>
			</div>
		
				<input type="hidden" name="on1" value="Login ID">
				<input type="hidden" name="os1" value=<?php echo $loginCookie; ?>>

				<input type="hidden" name="currency_code" value="USD">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</center>
				</center>
				</form>
		</div>
		</div>
		
		</div>
	<?
	}
?>