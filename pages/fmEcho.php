
<?php

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

$searched = $_GET['searched'];
if($searched == "")
	$searched = "0";
$down = $_GET['idlow'];
if($down == "")
	$down = "0";
$up = $_GET['idhigh'];
if($up == "")
	$up  = "9999999999";

?>
<div style="height:auto;">
<div class="searchSplitContent" style="margin-top: 10px;">
<form name="searchForm" onsubmit="return searchSubmit()">
        <fieldset>
            <legend>Search Parameters</legend>
		<input type="hidden" name="p" value=<?php echo $pe; ?>>
		<input type="hidden" name="page" value="1">
		<input type="hidden" name="searched" value="1">


		<div class="searchParameter">
		World: 
		<label>
			<select id="worldSelect" name="world" width=200px>
			<option value="Scania" <?php if($world == "Scania") echo " selected='selected'"; ?>>Scania</option>
			<option value="Windia" <?php if($world == "Windia") echo " selected='selected'"; ?>>Windia</option>
			<option value="Bera" <?php if($world == "Bera") echo " selected='selected'"; ?>>Bera</option>
			<option value="Broa" <?php if($world == "Broa") echo " selected='selected'"; ?>>Broa</option>
			<option value="Khaini" <?php if($world == "Khaini") echo " selected='selected'"; ?>>Khaini</option>
			<option value="YMCK" <?php if($world == "YMCK") echo " selected='selected'"; ?>>YMCK</option>
			<option value="GAZED" <?php if($world == "GAZED") echo " selected='selected'"; ?>>GAZED</option>
			<option value="BelloNova" <?php if($world == "BelloNova") echo " selected='selected'"; ?>>BelloNova</option>
			<option value="Renegades" <?php if($world == "Renegades") echo " selected='selected'"; ?>>Renegades</option>
			</select>
		</label> 
		<!--
		<br>
		Item Type: 
		<label>
			
			<select id="type" name="itemType">
				<option value="0" <?php if($order == "0") echo " selected='selected'"; ?>>All Types</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>Equips</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Accessory</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Android</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Cap</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Cape</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Coat</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Dragon</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Face</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Glove</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="1" <?php if($order == "1") echo " selected='selected'"; ?>>Highest To Lowest Price</option>
			</select>
			<select id="type" name="itemType">
				<option value="0" <?php if($order == "0") echo " selected='selected'"; ?>>All Types</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>Equips</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Accessory</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Android</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Cap</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Cape</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Coat</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Dragon</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Face</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - Glove</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>  - </option>
				<option value="1" <?php if($order == "1") echo " selected='selected'"; ?>>Highest To Lowest Price</option>
			</select>
		</label> 
		-->
		<br>
			Price: <input type="text" id="Price1" name="Price1" maxlength="10" size="12" value=<?php echo $low; ?> onkeypress="return forceNumber(event);"/> - <input type="text" id="Price2" name="Price2" maxlength="10" size="12" value=<?php echo $high; ?> onkeypress="return forceNumber(event);"/>
			<select id="orderSelect" name="order">
				<option value="0" <?php if($order == "0") echo " selected='selected'"; ?>>None</option>
				<option value="2" <?php if($order == "2") echo " selected='selected'"; ?>>Low to High</option>
				<option value="1" <?php if($order == "1") echo " selected='selected'"; ?>>High to Low</option>
			</select>

		<br>
			<input type="text" id="searchParam" style="width: 360px;" value="<?php echo htmlspecialchars($name);?>" placeholder="Search Item Name / Item ID / Player IGN" onkeyup="keyLeftUp2(this.value);" onkeydown="keyLeftDown();" onblur="fill2();" autocomplete="off">								<div class="suggestionsBox" id="suggestions2" style="display: none;">	
					<img src="../images/searchUpArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
						<div class="suggestionList" id="autoSuggestionsList2">
						</div>
				</div>
			<br>
			<center><input type="submit" value="Search" style="width: 370px;"></center>
		</div>
	</fieldset>
</form>

<script>
	var search ="<?php echo $name; ?>";
	var world="<?php echo $world; ?>";
	var page="<?php echo $page; ?>";
	var low="<?php echo $low; ?>";
	var high="<?php echo $high; ?>";
	var order="<?php echo $order; ?>";
	var down="<?php echo $down; ?>";
	var up="<?php echo $up; ?>";
	loadOwlContents(search, world, page, low, high, order, down, up);
</script>

<div id="fmTable" class="fmTable"><br></div>
<script>
$("#loadingBar").hide();
</script>
</div>