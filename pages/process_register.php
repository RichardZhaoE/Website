<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['register']))
{
	session_start(); 
	if(!isset($_POST["agree"]))
	{
		echo "You must agree with the <a href='?p=TOS' target='_blank'>Terms of Service and Conditions</a> to proceed.";
	}
	else
	{
		if ($_POST["captcha"] != $_SESSION["captcha"] OR $_SESSION["captcha"]=='') 
 		{
			echo "You've entered an incorrect verification code. Please try again. If you keep getting this message, then your session may have expired. Press the refresh button and restart.";
		} 
		else
		{
			$username = $_POST['userName'];
			$password = $_POST["passWord"];
			$password2 = $_POST["passWord2"];
			$world = $_POST["world"];
			$email = $_POST["Email"];
			$words = array('admin', 'fuck', 'bitch');
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
					include_once('../include/databaseInfo.php');
					date_default_timezone_set('America/New_York');
					$ip = $_SERVER['REMOTE_ADDR'];
					$date = date('Y-m-d H:i:s');
					$timeout = date('Y-m-d H:i:s', strtotime("+10 min"));
					$con = mysql_connect($host['host'], $host['userName'], $host['passWord']);
					if (!$con)
					{
  						die("Error: Trouble connecting to the database");
					}
					else
					{
						mysql_select_db($host['databaseName'], $con) or die('Failed to connect to database.'); 
						//$query1 = mysql_query("SELECT * FROM accounts WHERE IP = '$ip' OR lastLoginIP = '$ip'");
						//$count = mysql_num_rows($query1);
						//if($count == 0)
						//{
							$result = mysql_query("SELECT COUNT(*) AS Total,
								SUM(IF(LoginID = '$username', 1, 0)) AS userIDCount,
								SUM(IF(Email = '$email', 1, 0)) AS emailNum FROM accounts");
							if($result === FALSE)
							{
								die(mysql_error());
							}
							$query = mysql_fetch_array($result);
							$num1 = $qry[userIDCount];
							$num2 = $qry[emailNum];
							echo $num1;
							echo $num2;
							if($num1 == 0)
							{
								if($num2 == 0)
								{
									$reg = "INSERT INTO accounts (LoginID, Password, Expires, IP, lastLoginIP, lastLogin, Email, Admin, loginTime, dateCreated, approveDate, World) 
									VALUES ('$username', '$password', '$date', '$ip', '$ip', '$date', '$email','0', '$date',  '$date',  '$date', '$world')";
									mysql_query($reg);
									die("Register");
								}
								else
								{
									Echo "This email is currently being used. Please try again.";
								}
							}
							else
							{
								Echo "This username is currently being used. Please try again.";
							}
						//}
						//else
						//{
						//	Echo "You already have an account on record. Please use the account to log in or contact support@maplefm.com to retrieve your account if you are unable to recover it.";
						//}
					}
				}
				else
				{
					echo "The email you have entered is invalid.";
				}
			}
			else
			{
				echo "An error occurred due to one of the following reasons<ul><li>Your passwords do not match</li><li>Your username and password should only consist of letters and numbers</li><li>Username and password should be 4-12 characters long</li><li>Username contains one or more forbidden strings</li></ul>";		
			}
		}
		}
}else{
}
?>