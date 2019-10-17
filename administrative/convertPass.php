<?php
include('../include/config2.php');
$memberQuery = mysql_query("SELECT * FROM accounts order by LoginID asc");
while($webUsers = mysql_fetch_array($memberQuery))
{
	$login = $webUsers['LoginID'];
	$pass = $webUsers['Password'];
	$md5Hash = md5($pass);
	echo "$login -> $pass -> $md5Hash<br>";
	if($webUsers['MD5Password'] == "")
		mysql_query("UPDATE accounts SET MD5Password = '$md5Hash' WHERE LoginID = '$login' AND Password = '$pass'");
}
echo "#END";
?>