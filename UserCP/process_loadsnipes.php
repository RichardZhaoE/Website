<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['loadSnipes']))
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
		if($totalParams == "")
			$totalParams = 0;
		$snipeResults = "My Owl Snipes ".$totalParams."/".$maxParams."  <b> || </b>  Total Community Snipes ".$qry[Total]."<br><br>";
		if($totalParams > 0){

		$snipeArray = array();
		$snipeCount = 1;
		$snipes = mysql_query("Select * FROM snipes WHERE userID = '$userIDNum'");
			while($snipe = mysql_fetch_array($snipes))
			{
				$stringzz = getCountAndLowest($snipe['name'], $snipe['World'], $snipe['Price1'], $snipe['Price2'], "../FM/FMExport", $snipe['IGN']);
				$ordString = getOrder($snipe['Ord'], $snipe['Price1'], $snipe['Price2']);
				$snipeResults = $snipeResults."<li>";

				if($_POST['home'] == "true")
					$snipeResults = $snipeResults."<div style='float:left;'><a href='#' onClick=deleteSnipe('".$snipe[ID]."');><img src='../images/remove.png'></a><a href='#' onClick='loadOwlPage(\"$snipe[name]\", \"$snipe[World]\", \"1\", \"$snipe[Price1]\", \"$snipe[Price2]\", \"$snipe[Ord]\", \"$snipe[Low]\", \"$snipe[High]\")' ></div>";
				else
					$snipeResults = $snipeResults."<a href=home.php?p=fmowl&name=".$snipe['name']."&world=".$snipe['World']."&page=1&low=".$snipe['Price1']."&high=".$snipe['Price2']."&down=".$snipe['Low']."&up=".$snipe['High']."&searched=1>";

				$snipeResults = $snipeResults.$snipeCount.": ".$stringzz." <b>".$snipe['name']."</b> in <b>".$snipe['World']."</b> | <b>".$ordString."</b></a></li>";
				$snipeCount++;
			}
			die($snipeResults);
		}else{
			die($snipeResults."No saved search parameters");
		}
	}
}




function getOrder($str, $low, $high)
{
	if($str == 0)
		return "Price : $low - $high";
	elseif($str == 1)
		return "High($high) -> Low($low)";
	elseif($str == 2)
		return "Low($low) -> High($high)";
}



function getCountAndLowest($name, $world, $price1, $price2, $exportFolder, $IGN)
{
	$shopOwner = 0;
	$ownerGuild = 1;
	$shopName = 2;
	$shopTypeName = 3;
	$shopChannel = 4;
	$shopFMRoom = 5;
	$shopItemID = 6;
	$shopItemName = 7;
	$shopItemDescription = 8;
	$shopItemQuan = 9;
	$shopItemBundle = 10;
	$shopItemPrice = 11;
	$shopItemEnhance = 12;
	$shopItemPot = 13;
	$list = array();
	$name = stripslashes($name);
	if(file_exists("$exportFolder/$world"))
	{
		$fileCount = glob(".exportFolder/$world/*.txt");
		if($fileCount > 0){
			foreach (glob("$exportFolder/$world/*.txt") as $filename) {
    				$export = file("$filename", FILE_IGNORE_NEW_LINES);
   				$list = array_merge($list, $export); 
			}
		}
	}
	$records = count($list);
	$totalSale = 0;
	$forSale = 0;
	$lowestPrice = 999999999999;
	$lowestChannel = 0;
	$lowestRoom = 0;
	if($records > 0)
	{
		foreach($list as $num => &$item){
			$item = explode("%&", $item);
			if (count($item) < $shopItemPrice){ 
				unset($list[$num]);
				continue;
			}
			$stringzz  = "'";
			$find = str_replace($stringzz, "\'", $item[$shopItemName]);
			
			if($IGN > 0)
			{
				if (count($item) >= $shopItemDescription && strtolower($item[$shopOwner]) == strtolower($name))
				{
					$totalSale++;
					if($item[$shopItemQuan] == "SOLD")
						continue;
					if($item[$shopItemPrice] >= $price1 && $item[$shopItemPrice] <= $price2)
					{
						$forSale++;
						if($item[$shopItemPrice] < $lowestPrice){
							$lowestPrice = $item[$shopItemPrice];
							$lowestChannel = $item[$shopChannel];
							$lowestRoom = $item[$shopFMRoom];
						}	
					}
				}
			}else{
				if (count($item) >= $shopItemDescription && (strpos(strtolower($find), strtolower($name)) !== false || strpos(strtolower($item[$shopItemID]), strtolower($name)) !== false || strpos(strtolower($item[$shopOwner]), strtolower($name)) !== false))
				{
					$totalSale++;
					if($item[$shopItemQuan] == "SOLD")
						continue;
					if($item[$shopItemPrice] >= $price1 && $item[$shopItemPrice] <= $price2)
					{
						$forSale++;
						if($item[$shopItemPrice] < $lowestPrice){
							$lowestPrice = $item[$shopItemPrice];
							$lowestChannel = $item[$shopChannel];
							$lowestRoom = $item[$shopFMRoom];
						}	
					}
				}
			}
		}
		$lowestPrice = number_format($lowestPrice);
		if($forSale > 0)
			return "<b>".$forSale."</b>/".$totalSale." items for sale (Lowest: ".$lowestPrice." @ <b>CH".$lowestChannel."/RM".$lowestRoom. "</b>) when searching for ";
		else
			return "0 items for sale when searching for ";
	}else{
		return "0 items for sale while searching for ";
	}
}

?>