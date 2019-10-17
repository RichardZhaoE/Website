<?php
include_once("../include/config2.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['resetPassword']))
{
		$username = mysql_real_escape_string($_POST["userName"]);
		$password = $_POST["passWord"];
		$password2 = $_POST["passWord2"];
		$email = mysql_real_escape_string($_POST["Email"]);
		$date = date('Y-m-d H:i:s');
		$timeout = date('Y-m-d H:i:s', strtotime("+1 day"));
		if(preg_match("/^[a-zA-Z0-9]+$/", $password) && strlen($password) >= 4)
		{
			if($password != $password2)
			{	
				die("The passwords you have entered did not match");
			}
			else
			{
				$password = mysql_real_escape_string($password);
				//mysql_query("DELETE FROM failedattempts WHERE lastAttempt > '$date' AND type ='2'");
				$query1 = mysql_query("SELECT * FROM failedAttempts WHERE ip = '$ip' AND lastAttempt > '$date' AND type = '2'");
				$failCount = mysql_num_rows($query1);
				if($failCount > 5)
				{
					die("Maximum number of attempts reached. Please contact the server administrator.");
				}
				else
				{
					$query2 = mysql_query("SELECT * FROM accounts WHERE LoginID = '$username' AND Email = '$email'");
					$count = mysql_num_rows($query2);
					if($count == 0)
					{
						mysql_query("INSERT INTO failedattempts (username, ip, lastAttempt,type) VALUES ('$username', '$ip', '$timeout', '2')");
						echo "These credentials do not exist. A limited number of attempts remaining.";
					}
					else
					{
						mysql_query("UPDATE accounts SET Password = '$password' WHERE LoginID = '$username' AND Email = '$email'");
						die("Reset");
					}
				}
			}
		}else{
			die("Your password must only contain numbers and letters and must be more than 4 characters long.");
		}
}
?>