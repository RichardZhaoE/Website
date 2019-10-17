<?php
include_once('../include/config2.php');
if($adminStatus <= 0)
{
	echo "<script>top.location = 'home.php?p=index';</script>";
}else{


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!isset($loginCookie) && !isset($passwordCookie))
		header("Location: /?p=Login&error=5");
	$time = $_POST['time'];
	$userID = $_POST['user'];
	$currentDate = date('Y-m-d H:i:s');
	$query = mysql_query("SELECT * FROM accounts WHERE LoginID = '$loginCookie' AND MD5Password = '$passwordCookie'");
	$data = mysql_fetch_array($query);
	if($data['Admin'] >= '1')
	{	
		$date = strtotime($data['Expires']);
		if(isset($_POST['timeAdd'])){
			date_default_timezone_set('America/New_York');
			if (preg_match('/^-?[0-9]{1,4}$/',$time)){
				if($userID == 1)
				{
					if($data['Admin'] > 1){
					$now = strtotime(date('Y-m-d H:i:s'));
					$query = mysql_query("SELECT * FROM accounts");
					while($data = mysql_fetch_array($query))
					{
						$date = strtotime($data['Expires']);
						$login = $data['LoginID'];
						if($date > $now)
						{
							$date = date("Y-m-d H:i:s", strtotime('+'.$time.' day', $date));
						}
						else
						{
							$date = date("Y-m-d H:i:s", strtotime('+'.$time.' day', $now));
						}	
					}
					$sql = mysql_query("UPDATE accounts SET Expires = '$date' WHERE LoginID = '$login'");
					$info = "INSERT INTO timelogs (LoginID, AdminID, Days, NewTime, CurrentDay) VALUES ('All Members', '$loginCookie', '$time days added', '$date', '$currentDate')";
					if($userID != $loginCookie)
						mysql_query("$info");
					die("$time days has successfully been added to All Users's subscriptions.");
					}else{
						die("You do not have permission to use to this function.");
					}
				}
				elseif($userID == 2)
				{
					$now = strtotime(date('Y-m-d H:i:s'));
					$query = mysql_query("SELECT * FROM accounts");
					while($data = mysql_fetch_array($query))
					{
						$date = strtotime($data['Expires']);
						$login = $data['LoginID'];
						if($date > $now)
						{
							$date = date("Y-m-d H:i:s", strtotime('+'.$time.' day', $date));
							$sql = mysql_query("UPDATE accounts SET Expires = '$date' WHERE LoginID = '$login'");
						}	
					}
					$info = "INSERT INTO timelogs (LoginID, AdminID, Days, NewTime, CurrentDay) VALUES ('All Premium Members', '$loginCookie', '$time days added', '$date', '$currentDate')";
					if($userID != $loginCookie)
						mysql_query("$info");
					die("$time days has successfully been added to All Premium Members's subscriptions.");
				}
				else
				{
					$query = mysql_query("SELECT * FROM accounts WHERE LoginID = '$userID'");
					$data = mysql_fetch_array($query);
					$now = strtotime(date('Y-m-d H:i:s'));
					$date = strtotime($data['Expires']);
					if($date == "0"){
						$date = $now;
					}
					if($date > $now)
					{
						$date = date("Y-m-d H:i:s", strtotime('+'.$time.' day', $date));
					}
					else
					{
						$date = date("Y-m-d H:i:s", strtotime('+'.$time.' day', $now));
					}
					$sql = mysql_query("UPDATE accounts SET Expires = '$date' WHERE LoginID = '$userID'");
					$info = "INSERT INTO timelogs (LoginID, AdminID, Days, NewTime, CurrentDay) VALUES ('$userID', '$loginCookie', '$time days added', '$date', '$currentDate')";
					if($userID != $loginCookie)
						mysql_query("$info");
					die("$time days has successfully been added to $userID's subscriptions.");
				}
			}
			elseif ($time == "Revoke")
			{
				$date = date("Y-m-d H:i:s");
				$sql = mysql_query("UPDATE accounts SET Expires = '$date' WHERE LoginID = '$userID'");
				$info = "INSERT INTO timelogs (LoginID, AdminID, Days, NewTime, CurrentDay) VALUES ('$userID', '$loginCookie', 'Access Revoked', '$date', '$currentDate')";
				if($userID != $loginCookie)
					mysql_query("$info");
				die("&user's subscription has successfully been revoked.");
			} 	
			else
			{
				$query = mysql_query("SELECT * FROM administrative WHERE AdminPassword1 = '$time'");
				$count = mysql_num_rows($query);
				if($count > 0)
				{
					$sql = mysql_query("UPDATE accounts SET Expires = '0000-00-00 00:00:00' WHERE LoginID = '$userID'");	
					$info = "INSERT INTO timelogs (LoginID, AdminID, Days, NewTime, CurrentDay) VALUES ('$userID', '$loginCookie', 'Lifetime Access Granted', '0000-00-00 00:00:00', '$currentDate')";
					if($userID != $loginCookie)
						mysql_query("$info");
					die("A lifetime subscription has been successfully added to $userID's subscriptions.");
				}
				else
				{
					die("Please enter a valid time.");
				}
			}
		}
	}
	else
	{
		die("You do not have permission to view this page.");
	}
}


}
?>