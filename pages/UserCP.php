	<script type="text/javascript" src="scripts/UserCP.js"></script>
	<?php include("../include/config2.php"); ?>
	<div class="posttitle">
	My Account Settings - <?php echo $loginCookie; ?>
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
                    <a href="#snipe" class="active">Owl Snipe</a>
                </li>
                <li>
                    <a href="#defaultWorld">Default World Setting</a>
                </li>
                <li>
                    <a href="#account">Account Settings</a>
                </li>
                <li>
                    <a href="#subscribe">Subscribe</a>
                </li>
                <li>
                    <a href="#logout">Logout</a>
                </li>
            </ul>
            <div id="snipe" class="form-action show">
                <form id="snipeForm" onSubmit="return keepOpen()">
			<ul>
			<li>This new search option allows you to choose and save a set of search options which will then allow you to quickly see the cheapest available item in FM based on these options. This is a useful tool that allows you to "snipe" good deals before everyone else without having to search for it. <br><br>Since this feature uses the PAID list ONLY, free users may only add up to 2 searches which can ONLY be deleted AFTER 24 hours. When clicking the "snipe", free users will NOT be able to see the PAID list but be redirected to the free list. Subscribed members on the other hand can add up to 7 snipes and may add/delete freely.<br><br><--Ways this function can be useful--> <br>- Snipe your own store. See how many items have been sold / unsold just by typing in your own IGN.<br>- Find the lowest priced item of your choice in FM at any given time (Price checker?) <br><br><li>
			<input type=text style="width: 300px;" id="searchParam" placeholder="Search Item Name / Item ID / Player IGN" onkeyup="keyLeftUp2(this.value);" onkeydown="keyLeftDown();" onblur="fill2();" autocomplete="off">	
				<div class="suggestionsBox" id="suggestions2" style="display: none;">	
					<img src="../images/searchUpArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
						<div class="suggestionList" id="autoSuggestionsList2">
						</div>
				</div>
			World: <select id="accountSnipeChoice" name="world" width=200px>
				<option value="Scania" selected>Scania</option>
				<option value="Windia">Windia</option>
				<option value="Bera">Bera</option>
				<option value="Broa">Broa</option>
				<option value="Khaini">Khaini</option>
				<option value="YMCK">YMCK</option>
				<option value="GAZED">GAZED</option>
				<option value="BelloNova">BelloNova</option>
				<option value="Renegades">Renegades</option>
				</select>
			Price: 
			<input type="text" value="0" maxlength=10 style="width: 90px;" id="accountSnipePrice1"> - <input type="text" value="9999999999" maxlength=10 style="width: 90px;" id="accountSnipePrice2">
			<select id="accountSnipeOrder" name="accountSnipeOrder">
				<option value="0" selected>None</option>
				<option value="2">Low to High</option>
				<option value="1">High to Low</option>
			</select>
            <br /><b>EXACT IGN? <input type="checkbox" id="accountSnipeIGNCheckBox"> Check this box if your IGN happens to be part of certain item names / other player IGNS and is interferring your own IGN.</b>
			<input type="hidden" value="0" id="accountSnipeLow">
			<input type="hidden" value="999999999" id="accountSnipeHigh"><br><br>
			</li>
			<li><input type="submit" value="Add" class="button" /></li>
			</ul>
                </form>
			<ul id="paramList">
				<script>loadSnipes();</script>
            		</ul>	
            </div>
            <div id="defaultWorld" class="form-action hide">
                <form id="fmSettings" onSubmit="return keepOpen()">
                    <ul>
			<li>Update the world option below to change the default world in which while logged in, will be used to search.</li>
			<li>
			Default World Selection: <select id="accountWorldChoice" name="world" width=200px>
				<option value="Scania" <?php if($defaultWorld == "Scania") echo " selected='selected'"; ?>>Scania</option>
				<option value="Windia" <?php if($defaultWorld == "Windia") echo " selected='selected'"; ?>>Windia</option>
				<option value="Bera" <?php if($defaultWorld == "Bera") echo " selected='selected'"; ?>>Bera</option>
				<option value="Broa" <?php if($defaultWorld == "Broa") echo " selected='selected'"; ?>>Broa</option>
				<option value="Khaini" <?php if($defaultWorld == "Khaini") echo " selected='selected'"; ?>>Khaini</option>
				<option value="YMCK" <?php if($defaultWorld == "YMCK") echo " selected='selected'"; ?>>YMCK</option>
				<option value="GAZED" <?php if($defaultWorld == "GAZED") echo " selected='selected'"; ?>>GAZED</option>
				<option value="BelloNova" <?php if($defaultWorld == "BelloNova") echo " selected='selected'"; ?>>BelloNova</option>
				<option value="Renegades" <?php if($defaultWorld == "Renegades") echo " selected='selected'"; ?>>Renegades</option>
			</select>	
			</li>
			<br>
			<li><input type="submit" value="Update Default World" class="button" /></li>
                    </ul>
                </form>
            </div>
            <div id="subscribe" class="form-action hide">
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <ul>
			<li>
			<div align="left">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="VU8FK3QLEPPX2">

			<input type="hidden" name="on0" value="Time" />
			Time: <select name="os0" style="width:200px;">
				<option value="1 Month (31 Days)">1 Month (31 Days) $3.00 USD</option>
				<option value="2 Months (62 Days)">2 Months (62 Days) $6.00 USD</option>
				<option value="3 Months (93 Days)">3 Months (93 Days) $9.00 USD</option>
				</select>
				<br>
				<br>
				<input type="hidden" name="on1" value="Login ID">
				<input type="hidden" name="os1" value=<?php echo $loginCookie; ?>>

				<input type="hidden" name="currency_code" value="USD">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</div>
			</li>
                    </ul>
		</form>
            </div>
            <div id="account" class="form-action hide">
                <form id="resetForm" onSubmit="return keepOpen()">
                    <ul>
			<li>Account Settings Form</li>
                    </ul>
                </form>
            </div>
            <div id="logout" class="form-action hide">
                <form id="logoutForm" onSubmit="return keepOpen()">
                    <ul>
			<li><input type="submit" value="Logout" class="button" /></li>
                    </ul>
                </form>
            </div>
            <!--/#register.form-action-->
        </div>
	</div>