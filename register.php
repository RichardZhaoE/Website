<?php
if(isset($loginCookie))
{
	header("Location: /?p=MyAccount");
}
?>


<div style="overflow:auto; width:auto; top: 100px;margin-left:100px;margin-right:100px;height:auto;">
	
	<?php
	$form = "<div style='width:450px; float:left;'>
		<form name = registerform action='?p=Register' method='POST'>
        	<fieldset>
            		<legend>Register Account</legend>
            		<input type=hidden name='register' value='start' >
			<ul>
				<li><font color='red'>It is not advised to use your xxxxx Login ID / password for security purposes. We are not here to steal your information, but merely just to provide a profitable and convenient service.</font></li>
			</ul>
            		<div align='left'><label3>Login ID:</label3><input type='text' name='userName' maxlength='15' style='width:60%;'></div>
	    		<div align='left'><label3>Password:</label3><input type='password' name='passWord' maxlength='15' style='width:60%;'></div>
	    		<div align='left'><label3>Confirm Password:</label3><input type='password' name='passWord2' maxlength='15' style='width:60%;'></div>
	   		<div align='left'><label3>Email:</label3><input type='text' name='Email' style='width:60%;'></div>
	    		<div align='left'><label3>Captcha:</label3><img src='./include/captcha.php'></div>
	    		<div align='left'><label3></label3><input type='text' name='captcha' style='width:20%;'></div><br>
			<div align='center'><input type='checkbox' name='agree'>I agree with the <a href='?p=TOS'>Terms of Service and Conditions</a></div>
            		<div align='center'><input type='submit' value='Register'></div>
            		<div align='center'><br>Already have an account? <br>Click <a href='?p=Login'>here</a> to login.</div>
		</fieldset>
		</form>
		</div>";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['register']))
	{
		$errorPart1 = "<form><fieldset><legend>Registration Error</legend><font color='red'>";
		$errorPart2 = "</font></fieldset></form> $form";
		$sucessPart1 = "<form><fieldset><legend>Successfully Registered</legend><font color='green'>";
		$sucessPart2 = "</font></fieldset></form>";
		session_start(); 
		if(!isset($_POST["agree"]))
		{
			echo "$errorPart1 You must agree with the <a href='?p=TOS'>Terms of Service and Conditions</a> $errorPart2";
		}
		else
		{
		
		if ($_POST["captcha"] != $_SESSION["captcha"] OR $_SESSION["captcha"]=='') 
 		{
			echo "$errorPart1 You have entered an incorrect verification code. $errorPart2";
		} 
		else
		{
			$username = $_POST["userName"];
			$password = $_POST["passWord"];
			$password2 = $_POST["passWord2"];
			$email = $_POST["Email"];
			
			$words = array('admin', 'fuck');
			$badStrings = 0;
			
			if($password !== $password2)
				$badStrings++;
			
			foreach($words as $str)
			{
				if(stripos($username, $str) !== false)
				{
					$badStrings++;
				}

			}
			if(preg_match("/^[a-zA-Z0-9]+$/", $username) && preg_match("/^[a-zA-Z0-9]+$/", $password) && strlen($username) >= 4 && strlen($password) >= 4 && $badStrings == 0) 
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
  				{
					date_default_timezone_set('America/New_York');
					$ip = $_SERVER['REMOTE_ADDR'];
					$date = date('Y-m-d H:i:s');
					$timeout = date('Y-m-d H:i:s', strtotime("+10 min"));
					$con = mysql_connect($host['host'], $host['userName'], $host['passWord']);
					if (!$con)
					{
  						echo "$errorPart1 Failed to connect to database $errorPart2";
					}
					else
					{
						//mysql_select_db($host['databaseName'], $con) or die('Failed to connect to database.'); 
						//$query1 = mysql_query("SELECT * FROM accounts WHERE IP = '$ip' OR lastLoginIP = '$ip'");
						//$count = mysql_num_rows($query1);
						//if($count == 0)
						//{
							$result = mysql_query("SELECT * FROM accounts WHERE LoginID = '$username'");
							$num_rows = mysql_num_rows($result);
							if($num_rows == 0){
								$result = mysql_query("SELECT * FROM accounts WHERE Email= '$email'");
								$num_rows = mysql_num_rows($result);
								if($num_rows == 0)
								{
								$reg = "INSERT INTO accounts (LoginID, Password, Expires, IP, lastLoginIP, lastLogin, Email, Admin, loginTime, dateCreated, approveDate) 
								VALUES ('$username', '$password', '$date', '$ip', '$ip', '$date', '$email','0', '$date',  '$date',  '$date')";
								mysql_query("$reg");
								

								echo "$sucessPart1 Your account have been successfully created.";
								echo  "Please click here <a href='?p=Login'>here</a> to proceed to the login page if you are not automatically redirected within 10 											seconds<meta http-equiv='refresh' content='8;url=?p=Login'>";
								echo "$sucessPart2";
							
								
								}
								else
								{
									Echo "$errorPart1 This email is already being used. Please try again. $errorPart2";
								}
							}
							else
							{
								Echo "$errorPart1 This username is already being used. Please try again. $errorPart2";
							}
						//}
						//else
						//{
						//	Echo "$errorPart1 You already have an account on record $errorPart2";
						//}
					}
				}
				else
				{
					echo "$errorPart1 Please enter a valid email. $errorPart2";
				}
			}
			else
			{
				echo "$errorPart1 An error occurred due to one of the following reasons<ul><li>Your passwords do not match</li><li>Your username and password should only consist of letters and numbers</li><li>Username and password should be 4-12 characters long</li><li>Username contains one or more forbidden strings</li></ul> $errorPart2";			}
		}
		}
	}
	else
	{
		echo $form;
	}
	?>
</div>
