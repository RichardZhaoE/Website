<?php
include_once('../include/databaseInfo.php');
function RandomString($length) {

    $keys = array_merge(range(0,9), range('a', 'z'));

    for($i=0; $i < $length; $i++) {

        $key .= $keys[array_rand($keys)];

    }

    return $key;

}

if($_SERVER['REQUEST_METHOD'] == 'POST' & isset($_POST['login']))
{
	$page = $_POST["page"];
	$username = $_POST["userName"];
	$password = $_POST["passWord"];
	$remember = $_POST["remember"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date('Y-m-d H:i:s');
	$timeout = date('Y-m-d H:i:s', strtotime("+10 min"));
	$con = mysql_connect($host['host'], $host['userName'], $host['passWord']);
	if (!$con)
	{
  		die("Error Connecting to database. Please try again at a later time.");
	}
	else
	{
		$conn2 = mysql_select_db($host['databaseName'], $con);
		if($conn2)
		{ 
			$query = mysql_query("SELECT * FROM failedAttempts WHERE ip = '$ip' AND lastAttempt > '$date' AND type = '1'");
			$failCount = 0;
			if($query)
			{
				$failCount = mysql_num_rows($query);
			}
			if($failCount > 4)
			{
				//header("Location: /?p=$page&error=4");
				die("Too many attempts. Please try again in 10 minutes.");
			}
			else
			{
				$query1 = mysql_query("SELECT * FROM accounts WHERE LoginID = '$username' AND Password = '$password'");
				$count = mysql_num_rows($query1);
				if($count > 0)
				{
					//mysql_query("DELETE FROM failedattempts WHERE ip = '$ip' AND type ='1'");
					$row = mysql_fetch_array($query1);
					$lastLogin = $row["loginTime"];
					$lastIP = $row["IP"];
					mysql_query("UPDATE accounts SET lastLogin = '$lastLogin', lastLoginIP = '$lastIP' WHERE LoginID = '$username'") or die(mysql_error());
					mysql_query("UPDATE accounts SET IP = '$ip', loginTime = '$date' WHERE LoginID = '$username'") or die(mysql_error());
					
					if(isset($_COOKIE['loginCookie']) && $row["loginCookie"] != "")
					{
						if($row["loginCookie"] == $_COOKIE['loginCookie'])
						{
							$data = "INSERT INTO LoginLogs (LoginID, Time, IP, Verify) VALUES ('$username', '$date', '$ip', '1')";
							mysql_query("$data");
						}
						else
						{
							$data = "INSERT INTO LoginLogs (LoginID, Time, IP, Verify) VALUES ('$username', '$date', '$ip', '2')";
							mysql_query("$data");
						}	
					}
					else
					{
						if($row["loginCookie"] == "")
						{
							$randomString = RandomString(15);
							mysql_query("UPDATE accounts SET loginCookie = '$randomString' WHERE LoginID = '$username'") or die(mysql_error());
							setcookie("loginCookie", $randomString, time()+3600*24*365*10); 
							$data = "INSERT INTO LoginLogs (LoginID, Time, IP, Verify) VALUES ('$username', '$date', '$ip', '2')";
							mysql_query("$data");
						}
						else
						{
							if($lastIP == $ip)
							{
								setcookie("loginCookie", $row["loginCookie"], time()+3600*24*365*10);
								$data = "INSERT INTO LoginLogs (LoginID, Time, IP, Verify) VALUES ('$username', '$date', '$ip', '1')";
								mysql_query("$data");
							}
							else
							{
								$data = "INSERT INTO LoginLogs (LoginID, Time, IP, Verify) VALUES ('$username', '$date', '$ip', '2')";
								mysql_query("$data");
							}
						}	
					}
					if(isset($remember))
					{
						setcookie("LoginID", $username, time()+3600*24*365*10, '/');  
						setcookie("Password", $password, time()+3600*24*365*10,  '/');
					}
					else
					{
						setcookie("LoginID", $username, time()+3600,  '/'); 
						setcookie("Password", $password, time()+3600,  '/'); 
					}
					die("Login");
					//header("Location: /?p=fmowl");
				}
				else
				{
					mysql_query("INSERT INTO failedattempts (username, ip, lastAttempt,type) VALUES ('$username', '$ip', '$timeout', '1')");
					die("Incorrect Login ID / Password combination. Please try again. A limited amount of tries remaining.");
					//header("Location: /?p=$page&error=1");
				}
			}
		}
		else
		{
			//header("Location: /?p=$page&error=2");
			die("Error Connecting to database. Please try again at a later time.");
		}
	}
}
?>