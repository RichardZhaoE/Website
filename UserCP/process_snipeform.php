<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['snipeAdd']))
	{
		include_once('../include/config2.php');
		$date = date('Y-m-d H:i:s');
			$maxParams = 7;
		if($subscriptionValue < 1){
			$maxParams = 2;
		}
		if (!isset($loginCookie) || !isset($passwordCookie))
			die("Your login session has expired. Please log in again and before trying again.");
		$query = mysql_query("SELECT * FROM accounts WHERE LoginID = '$loginCookie' AND MD5Password = '$passwordCookie'");
		$data = mysql_fetch_array($query);
		$userIDNum = $data['ID'];
		$qry1 = mysql_query("SELECT COUNT(*) AS Total, 
			SUM(IF(userID = '$userIDNum', 1, 0)) AS params
 		FROM snipes");
		$qry= mysql_fetch_array($qry1);
		$totalParams = $qry[params];
		$name = mysql_real_escape_string($_POST['name']);
		$world = $_POST['world'];
		$price1 = $_POST['price1'];
		$price2 = $_POST['price2'];
		$order = $_POST['order'];
		$low = $_POST['low'];
		$high = $_POST['high'];
		$exactIGN = $_POST['exactign'];
		if($name == "")
			die("You must enter a valid term or item name. The search field cannot be blank");
		$now = strtotime(date('Y-m-d H:i:s'));
		$date = date("Y-m-d H:i:s", strtotime('+1 day', $now));
		if(ctype_digit($price1) == false || ctype_digit($price2) == false)
			die("Please check the values of the price range and make sure they are valid POSITIVE INTEGERS");
		if($price1 > $price2 || $price2 < $price1 || $price1 < 0 || $price2 < 0 || $price1 > 9999999999 || $price2 > 9999999999)
			die("Please check the price range to the following rules: <ul><li>Price range values are both greater than 0.</li><li>The higher price cannot be lower than the lower price and vice versa.<li></li>Both prices are under the value '9,999,999,999'</li></ul>"); 
		if($totalParams >= $maxParams)
			die("You have already reached the maximum number of saved search parameters. Please delete a parameter before attempting to add another.");
		else
		{
			$queryz = "INSERT INTO snipes (userID, name, World, Price1, Price2, Ord, Low, High, Date, IGN) VALUES ('$userIDNum', '$name', '$world', '$price1', '$price2', '$order', '$low', '$high', '$date', '$exactIGN')";
			mysql_query($queryz) or die(mysql_error());
			die("Success");		

		}	
	}
}
?>