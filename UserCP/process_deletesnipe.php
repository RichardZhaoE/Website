<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['deleteSnipe']))
	{
		include_once('../include/config2.php');
		$date = date('Y-m-d H:i:s');
		$ID = $_POST['id'];
		if (!isset($loginCookie) || !isset($passwordCookie))
			die("Your login session has expired. Please log in again and before trying again.");
		$query = mysql_query("SELECT Count(*) AS TOTAL, SUM(IF(LoginID = '$loginCookie' AND MD5Password = '$passwordCookie', 1, 0)) AS confirm FROM accounts");
		$qry= mysql_fetch_array($query);
		$verify = $qry[confirm];
		if($verify > 0)
		{
			if($subscriptionValue < 1){
				$qry1 = mysql_query("SELECT * FROM snipes WHERE ID = '$ID'");
				$qry= mysql_fetch_array($qry1);
				$time = $qry['Date'];
				if(strtotime($time) >= strtotime($date))
					die("You are unable to delete this record. You will be able to delete this record after the following time: ".$time."(EST)");
			}
			mysql_query("DELETE FROM snipes where ID = '$ID'") or die("There has been an error while attempting to delete your record. Please try again. <br>If this error continues, try refreshing the page and trying again.");
			die("Deleted");
		}else{
			die("This is not your search record to delete");
		}

	}
}
?>