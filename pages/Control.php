<?php
include_once('../include/config2.php');
if($adminStatus <= 0)
{
	echo "<script>top.location = 'home.php?p=index';</script>";
}else{
?>

<head>
<link href="../css/login.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="administrative/Control.js"></script>
</head>

<div class="post">
	<div class="posttitle">
	Administrator's Panel - <?php echo "$loginCookie - $userIP"; ?>
	</div>
	<div class="postcontent">
	<div><img id="accountloadingBar" alt="" src="images/loader.gif" /></label></div>
	<div id="successMessage">
	</div>
	<div id="errorMessage">
	</div>
        <div class="flat-form">
            <ul class="tabs">
                <li>
                    <a href="#memberTime" class="active">Time Additions</a>
                </li>
                <li>
                    <a href="#listActs">List Actions</a>
                </li>
                <li>
                    <a href="#accesslog">Access Logs</a>
                </li>
            </ul>
            <div id="memberTime" class="form-action show">
                <form id="memberTimes" onSubmit="return keepOpen()">
                    <ul>
			<li>
			Member: <select id="user">
				<option value="1">All Members</option>
				<option value="2">Current Premium Members</option>
				<?php
				$memberQuery = mysql_query("SELECT * FROM accounts order by LoginID asc");
				while($webUsers = mysql_fetch_array($memberQuery))
				{
				?>
					<option value="<?php echo $webUsers['LoginID']; ?>"><?php echo $webUsers['LoginID'];?></option>
				<?php
				}
				?>
			</select>	
			</li>
			<br>
			<li>Time To Add (Days): <input type='text' name='time' id='time'></li>
			<li><input type="submit" value="Add Time" class="button" /></li>
                    </ul>
                </form>
            </div>
            <div id="listActs" class="form-action hide">
                    <ul>
			<li><form id='refreshFree' onSubmit="return keepOpen()"><input type='submit' class="listButton" value='Refresh Free Owl List'></form></li><br>
			<li><form id='enableFree' onSubmit="return keepOpen()"><input type='submit' class="listButton" value='Enable Free List'></form></li><br>
			<li><form id='disableFree' onSubmit="return keepOpen()"><input type='submit' class="listButton" value='Disable Free List'></form></li><br>
			<li><form id='disableFreeandDelete' onSubmit="return keepOpen()"><input type='submit' class="listButton" value='Disable and Delete Free List'></form></li>
                    </ul>
            </div>
            <div id="accesslog" class="form-action hide">
                <div id="accessLogs"><script>accessLogs('1');</script></div>
            </div>
        </div>
	</div>

</div>


<script>
$("#loadingBar").hide();
</script>

<?php
}
?>