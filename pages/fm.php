<?php
$exportFolder = "../FM/Export2";
include("../include/config2.php");
//die ("<br><br>You do not have permission to view this page<br><br><br><br>"); 

$world = $_GET['world'];
if($world == "")
	$world = "Scania";
$page = $_GET['page'];
if($page == "")
	$page = 1;
$name = urldecode(stripslashes($_GET['name']));
if($name == "")
	$name = "";
$low = $_GET['Price1'];
if($low == "")
	$low = "0";
$high = $_GET['Price2'];
if($high == "")
	$high  = "9999999999";
$order = $_GET['order'];
if($order == "")
	$order = 0;
$down = $_GET['idlow'];
if($down == "")
	$down = "0";
$up = $_GET['idhigh'];
if($up == "")
	$up  = "9999999999";
$searched = $_GET['searched'];
if($searched == "")
	$searched = "0";

if(!isset($loginCookie))
{
	echo "<script>loadContents('Account');</script>";
}else{
	if($subscriptionValue == 1)
	{
		$exportFolder = "../FM/FMExport";
	}else{
		if(!isset($_COOKIE['adfly']) && searched != "1")
		{
			setcookie("adfly", 'ABC', time()+3600);
			echo "<META HTTP-EQUIV='Refresh' Content='0; URL=http://adf.ly/4948466/www.maplefm.com/home.php?p=fmowl&page=$page&world=$world&ad=1&name=$name&Price1=$low&Price2=$high&order=$order&searched=1'>";
			echo "2";
		}else{
			setcookie("adfly", '', time()-3600);
			$exportFolder = "../FM/FMExport2";
		}
	}
}
?>

<?php
//Variables
$perPage = 100;

$world = $_GET['world'];
if($world == "")
	$world = "Scania";
$page = $_GET['page'];
if($page == "")
	$page = 1;
$name = urldecode(stripslashes($_GET['name']));
if($name == "")
	$name = "";
$low = $_GET['Price1'];
if($low == "")
	$low = "0";
$high = $_GET['Price2'];
if($high == "")
	$high  = "9999999999";
$order = $_GET['order'];
if($order == "")
	$order = 0;
$down = $_GET['idlow'];
if($down == "")
	$down = "0";
$up = $_GET['idhigh'];
if($up == "")
	$up  = "9999999999";
$searched = $_GET['searched'];
if($searched == "")
	$searched = "0";


if($searched != "0" && $name != "")
{
	if($pe == "fmowl")
	{
		$searchCounter = file_get_contents('../counters/paid.txt');
		file_put_contents('../counters/paid.txt', $searchCounter + 1);
		//$fp = fopen("counters/paid.txt", "r");
		//$searchCounter = fread($fp, 1024); 
		//fclose($fp);
		//echo $searchCounter;
		//$searchCounter = $searchCounter + 1;
		//$fp = fopen("counters/paid.txt", "w");
		//fwrite($fp, $searchCounter);
		//fclose($fp);
	}
	else
	{
		$searchCounter = file_get_contents('../counters/free.txt');
		file_put_contents('../counters/free.txt', $searchCounter + 1);
	}
}




$date = date('Y-m-d H:i:s');
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

$updateTime;
$maxTimeDiff = 30;

$sold = 0;
$list = array();
if(file_exists("$exportFolder/$world"))
{
	$fileCount = glob("$exportFolder/$world/*.txt");
	if($fileCount > 0){
		foreach (glob("$exportFolder/$world/*.txt") as $filename) {
    			$export = file("$filename", FILE_IGNORE_NEW_LINES);
   			$list = array_merge($list, $export); 
		}
	}
}
$records = count($list);
$totalRecords = $records;
if($records > 0){


foreach($list as $num => &$item){
	$item = explode("%&", $item);
	if (count($item) < $shopItemPrice){ 
		if($num == 0)
		{
			$updateTime = $item[$shopOwner];
		}
		unset($list[$num]);
		$totalRecords = $totalRecords - 1;
		continue;
	}
	if($name != ""){
		$stringzz  = "'";
		$find = str_replace($stringzz, "\'", $item[$shopItemName]);
		if (count($item) >= $shopItemDescription && (strpos(strtolower($find), strtolower ($name)) === false && strpos(strtolower($item[$shopItemID]), strtolower ($name)) === false && strpos(strtolower($item[$shopOwner]), strtolower ($name)) === false))
		
		{
			unset($list[$num]);
			continue;
		}
	}
	if($low != "" && $high != ""){
		if($item[$shopItemPrice] < $low || $item[$shopItemPrice] > $high)
		{
			unset($list[$num]);
			continue;
		}
	}
	if($item[$shopItemQuan] == "SOLD"){
		$sold++;
	}
}


if($order != "0")
{
	if($order == 1)
	{
		function compare($a, $b) {
			global $shopItemPrice;
    			return ($a[$shopItemPrice] < $b[$shopItemPrice]);
		}
		usort($list, 'compare');	
	}
	elseif($order == 2)
	{
		function compare($a, $b){
			global $shopItemPrice;
    			return ($a[$shopItemPrice] > $b[$shopItemPrice]);
		}
		usort($list, 'compare');
	}	
}else{
	function compare($a, $b){
		global $shopItemName;
    		return ($a[$shopItemName] > $b[$shopItemName]);
	}
	//usort($list, 'compare');
}


$list = array_values($list);
$records = count($list);
$avail = $records - $sold;
$d1 = strtotime($updateTime);
$d2 = strtotime($date);
$diff = round(abs($d1 - $d2) / 60);
$timeDiff = "approximately <b>$diff</b> minute(s) ago.";
$line1 = "";
$line2 = "";

if($diff > $maxTimeDiff)
{
	$line1 = "<font color=red>";
	$timeDiff = "$timeDiff This list may be inaccurate.";
	$line2 = "<li>Because this list has not been updated in over $maxTimeDiff minutes, MapleFM may be experiencing downtime.</li></font>";
}

echo "
<form>
	<fieldset>
	<legend>List Information</legend>
	<div class='listParameter'>
		<ul>
			$line1
			<li>$world's list last updated at <b>$updateTime</b> EST, $timeDiff</li>
			$line2
			<li>Total records in $world: <b>$totalRecords</b></li>
			<li>Total records based on current search parameters: <b>$records</b></li>
			<li>Total Items Sold: <span class='text2'>$sold</span></li>
			<li>Available for purchase: <span class='text1'>$avail</span></li>
		</ul>
	</div>
	</fieldset>
</form>
</div>";


$recordsOnPage = 0;
if($records > 0){


$minList = ($page - 1) * $perPage;
$maxList = $page*$perPage;
$maxPages = ceil(count($list)/$perPage);

include('../include/pageCounter.php');
echo"<div class='CSSTable'><table><tr><td style='width: 200px;'>Item Name</td><td>CH</td><td>RM</td><td>Item Information</td></tr>";

foreach ($list as $num => &$item){

if($num >= $minList && $num <= $maxList){
if(is_array($item) && count($item) >= $shopItemPrice) {
	$recordsOnPage++;
	echo "<tr><td><div id='popup'><a href='#'><div style='word-wrap: break-word'><b>";
	
	if($item[$shopItemQuan] == "SOLD"){
		echo "<strike>";
	}
	$enhancements = str_replace("*", "<img src=./images/enhancement.png>", $item[$shopItemEnhance]);
	if($item[$shopItemID] < 2000000){
		if($item[$shopItemEnhance] !== "")
			echo "$enhancements<br><br>";
	}
	echo "<center>";
	$itemImage = "";
	if($item[$shopItemID] >= 3060000 && $item[$shopItemID] < 3070000)
	{
		if($item[$shopItemID] >= 3060000 && $item[$shopItemID] < 3061000)
			$itemImage = "<img border=0 src=./mapleitems/items/Nebs/D-Neb.png>";
		if($item[$shopItemID] >= 3061000 && $item[$shopItemID] < 3062000)
			$itemImage = "<img border=0 src=./mapleitems/items/Nebs/C-Neb.png>";
		if($item[$shopItemID] >= 3062000 && $item[$shopItemID] < 3063000)
			$itemImage = "<img border=0 src=./mapleitems/items/Nebs/B-Neb.png>";
		if($item[$shopItemID] >= 3063000 && $item[$shopItemID] < 3064000)
			$itemImage = "<img border=0 src=./mapleitems/items/Nebs/A-Neb.png>";
		if($item[$shopItemID] >= 3064000 && $item[$shopItemID] < 3065000)
			$itemImage = "<img border=0 src=./mapleitems/items/Nebs/S-Neb.png>";
	}else{
		$itemImage = "<img border=0 src=./mapleitems/items/images/$item[$shopItemID].png>";

	}
	echo "$itemImage";


	echo "<br>$item[$shopItemName]</b><br><img border=0 width=16 height=16 src=./images/meso.png>" .number_format($item[$shopItemPrice])."</strike>"; 

	echo "<span><b><center>$enhancements<br><br>$itemImage<br><br>$item[$shopItemName]<br><img border=0 width=16 height=16 src=./images/meso.png>" .number_format($item[$shopItemPrice])."<br><br>";

	if($item[$shopItemDescription] != ""){
		echo "<br>Description: ". htmlentities($item[$shopItemDescription]) ." ";
	}	
	if($item[$shopItemID] < 2000000){
		$str = explode("<br>", $item[$shopItemPot]);
		foreach($str as $str2)
		{
			echo htmlentities($str2) ."<br>";
		}
	}
	echo "</center><b></span></div></a></div></td>";
	echo "<td>$item[$shopChannel]</td><td>$item[$shopFMRoom]</td><td><div align='left' style='word-wrap: break-word'></center>";

	if($item[$shopItemQuan] == "SOLD"){
		echo "<strike>";
	}
	echo "Player IGN: <span class='mp'>$item[$shopOwner]</span>";

	if($item[$ownerGuild] != "")
	{
		echo "Guild: <span class='mp'>$item[$ownerGuild] </span>";
	}
	
	echo "
	<br>
	Store Type: <span class='mp'>$item[$shopTypeName]</span>
	Store Name: <span class='mp'>$item[$shopName]</span>
	<br>Quantity: ";
	if($item[$shopItemQuan] == "SOLD"){
		echo "<span class='text2'>$item[$shopItemQuan]</span>";
	}
	else
	{
		echo "<span class='text1'>$item[$shopItemQuan]</span> Bundle: <span class='text1'>$item[$shopItemBundle]</span>";
	}
	echo " Item ID: <Span class='mp'>$item[$shopItemID]</span>";
	
	if($item[$shopItemPot] != "")
		echo "<br><br>Item potential available. Hover over item to view potential.";
	if($item[$shopItemDescription] != "")
		echo "<br><br>Hover over the item to view the item description.";
	
	echo "</div></td></tr></strike>";
	
}
}
}

	echo "</table></div><br>";
	include('../include/pageCounter.php');
}else{ echo "<br><br><center>There are no records based on these search parameters</center>"; } //records > 0 based on search

}
else
{
	echo "<form><fieldset><legend>List Information</legend>
		<font color='red'>There are currently no records to be displayed. This could be due to one of the following: 
		<ul>
			<li>MapleStory is currently Offline</li>
			<li>MapleFM is currently experiencing downtime</li>
			<li>MapleFM is currently undergoing mainenance</li>
			<li>MapleFM does not support these search parameters</li>
		</font></ul></fieldset></form>";
}
?>
<script>
var h = <?php echo $recordsOnPage;?>*110 + 280;
document.getElementById("contents").style.height = h + "px";
$("#loadingBar").hide();
</script>