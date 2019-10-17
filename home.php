<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MapleFm | MapleStory's Owl Alternative</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="scripts/suggestionBoxScript.js"></script>
<script type="text/javascript" src="scripts/checkNumber.js"></script>
<script type="text/javascript" src="scripts/getPage.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
            $(function() {
                var d=300;
                $('#navigation a').each(function(){
                    $(this).stop().animate({
                        'marginTop':'-80px'
                    },d+=150);
                });

                $('#navigation > li').hover(
                function () {
                    $('a',$(this)).stop().animate({
                        'marginTop':'-2px'
                    },200);
                },
                function () {
                    $('a',$(this)).stop().animate({
                        'marginTop':'-80px'
                    },200);
                }
            );
            });
</script>
</head>
<?php 
include_once('include/config.php'); 
?>
<body>
	<div class="main">
		<header>
			<div class="container">
	
			<ul id="navigation">
            		<li class="home"><a href="#" onClick="loadContents('index')"><span>Home</span></a></li>
            		<li class="lookup"><a href="#" onClick="loadOwlWorld('<?php echo $defaultWorld;?>')"><span>Search</span></a></li>
            		<li class="faq" ><a href="#" onClick="loadContents('About')"><span>FAQ</span></a></li>
            		<li class="profile"><a href="#"  onClick="loadContents('Account')"><span>Profile</span></a></li>
			<?php if($adminStatus >= 1)
			{ ?>
				<head><link href="administrative/adminStyles.css" rel="stylesheet" type="text/css" /></head>
				<li class="admin"><a href="#" onClick="loadContents('control')"><span>Admin</span></a></li>
			<?php
			} ?>
            		<li class="contact"><a href="#" onClick="loadContents('Contact')"><span>Contact</span></a></li>
        	</ul>
			
			<div id="accountBoxContent"></div>
			<script>
				loadAccountBox();
			</script>


			<div class="box">
				<table width="427" border="0" cellspacing="0" cellpadding="0" margin="auto">
				<tr>
					<td width="252" height="123" class="logo"><a href="/"><img src="images/logo2.png" width="250" height="45" /></a></td>
					<td width="175" rowspan="2"><a href="/"><img src="images/maple_man.png" width="141" height="187" class="man" /></a></td>
				</tr>
				<tr>
					<td>
						<div class="light">
						<input type="hidden" id="world" value=<?php echo $defaultWorld; ?> />
						<input type="text" id="searchBox" class="search rounded" placeholder="Search..." onkeyup="keyLeftUp(this.value);" onkeydown="keyLeftDown();" onblur="fill();" onkeypress="enterPressed(event)" onblur="fill();" autocomplete="off"/>  
						<div class="suggestionsBox" id="suggestions" style="display: none;">
							<img src="../images/searchUpArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
							<div class="suggestionList" id="autoSuggestionsList">
							</div>
						</div><h1>Currently Browsing: <?php echo $defaultWorld; ?></h1> 
					</td>
				</tr>
				</table>
			</div>

			</div>
		</header>

		<contentbody>
			<content>
				<img id="loadingBar" src="images/loader.gif" />
				<div id="contents">
				<?php 
					$page = isset($_GET['p']) ? $_GET['p'] : "";
					if($page != "fmowl")
					{
						?>
						<script>
							window.onload = function() {
								var page="<?php echo $page; ?>";
								loadContents(page);
						
							};
						</script>
						<?php 
					}else{
						$world = $_GET['world'];
						if($world == "")
							$world = "Scania";
						$page = $_GET['page'];
							if($page == "")
								$page = "1";
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
								$order = "0";
						$searched = $_GET['searched'];
							if($searched == "")
								$searched = "0";
						$down = $_GET['idlow'];
							if($down == "")
								$down = "0";
						$up = $_GET['idhigh'];
							if($up == "")
								$up  = "9999999999";
						$searched = $_GET['searched'];
							if($searched == "")
								$searched = "0";
						?>
						<script>
							window.onload = function() {
								var name = "<?php echo $name; ?>";
								var world = "<?php echo $world; ?>";
								var page = "<?php echo $page; ?>";
								var low = "<?php echo $low; ?>";
								var high = "<?php echo $high; ?>";
								var order = "<?php echo $order; ?>";
								var down = "<?php echo $down; ?>";
								var up = "<?php echo $up; ?>";
								var searched = "<?php echo $searched; ?>";
								loadOwlPage(name, world, page, low, high, order, down, up, searched);
							};
						</script>
						<?php
					}
				?>
				</div>
			
			</content>
		</contentbody>
		
		
		<footer>
			<div class="footerContents"><center>
				Copyright © 2013 MapleFM. Some images belong to MapleStory Nexon Corporation. All rights reserved.<br />
MapleFM cannot be held liable for any content on this site.<br />
By visiting this site, you agree to it's <a href="#" onClick="loadContents('TOS')">Terms of Service and Conditions</a> which are subject to change at any time.
			</center></div>
		</footer>
		
	</div>
</body>
</html>
