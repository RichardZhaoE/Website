<?php 
include_once('../include/config2.php');
if(!isset($loginCookie))
{
	echo "<script>top.location = 'home.php?p=Account';</script>";
	
}
else
{
	if($adminStatus == 0)
	{
		echo "<script>top.location = 'home.php?p=index';</script>";
	}else{
?>

<?php
$count = mysql_num_rows(mysql_query("SELECT * FROM timelogs"));
$perPage = 80;
$total_pages = ceil($count / $perPage); 

echo "Total Records: $count";

	if (isset($_GET["page"])) 
	{ 
		$page  = $_GET["page"]; 
	} else { 
		$page=1; 
	}; 



$start_from = ($page-1) * 20; 
$sql = "SELECT * FROM timelogs ORDER BY ID DESC LIMIT $start_from, $perPage";



$rs_result = mysql_query($sql); 
?> 
<div class='adminTable' style='width:880'><table width=100%>
<tr>
	<td>Admin</td>
	<td>User</td>
	<td>Action</td>
	<td>DateTime Preformed</td>
	<td>Expires</td>
</tr>
<tr></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><? echo $row["AdminID"]; ?></td>
            <td><? echo $row["LoginID"]; ?></td>
            <td><? echo $row["Days"]; ?></td>
            <td><? echo $row["CurrentDay"]; ?></td>
            <td><? echo $row["NewTime"]; ?></td>
            </tr>
<?php 
}; 
?> 
</table>
</div><div><center>
<?php 


for ($i=1; $i<=$total_pages; $i++) { 
	if($total_pages == $i){
		if($page != $i)
			echo "<a href='#' onclick=accessLogs('$i');>".$i."</a>"; 
		else
			echo "$i";
	}
	else
	{
		if($page != $i)
			echo "<a href='#'onclick=accessLogs('$i');>".$i."</a> | "; 
		else
			echo "$i | ";
	}
}
?>

<?php
	}
}
?>
</center></div>

<script>
$("#loadingBar").hide();
</script>