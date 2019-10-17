<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MapleFm | MapleStory's Owl Alternative</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/home.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/jquery-1.2.1.pack.js"></script>
<script type="text/javascript" src="scripts/suggestionBoxScript.js"></script>
<script type="text/javascript" src="scripts/getPage.js"></script>
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
<?php 
	include_once('include/config.php');
?>
</head>
<body>

		<ul id="navigation" style="margin-top: 2px;">
            		<li class="home"><a href="home.php?p=index"><span>Home</span></a></li>
            		<li class="lookup"><a href="home.php?p=fmowl"><span>Search</span></a></li>
            		<li class="faq" ><a href="home.php?p=About"><span>FAQ</span></a></li>
            		<li class="profile"><a href="home.php?p=Account"><span>Profile</span></a></li>
			<?php if($adminStatus >= 1)
			{ ?>
				<head><link href="administrative/adminStyles.css" rel="stylesheet" type="text/css" /></head>
				<li class="admin"><a href="home.php?p=control"><span>Admin</span></a></li>
			<?php
			} ?>
            		<li class="contact"><a href="home.php?p=Contact"><span>Contact</span></a></li>
        	</ul>
	
	<div class="homeContainer">
		<div class="quote">
    			<blockquote><p>Check out our new function, Owl Snipe! "Snipe" your own character's store or any item you wish to buy!</p></blockquote>
    			<p class="credit">www.MapleFM.com</p>
		</div>
	<table width="427" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="252" height="123" class="logo"><a href="/"><img src="images/logo2.png" width="250" height="45" /></a></td>
			<td width="175" rowspan="2"><a href="/"><img src="images/maple_man.png" width="141" height="187" class="man" /></a></td>
		</tr>
		<tr>
			<td>
				<form Method="POST" action="scripts/search.php">
				<div class="light">
					<input type="hidden" id="world" name="world" value=<?php echo $defaultWorld; ?> />
					<input type="text" id="searchBox" name="searchParam" class="search rounded" placeholder="Search..." onkeyup="keyLeftUp(this.value);" onkeydown="keyLeftDown();" onblur="fill();" onkeypress="enterPressed2(event)" autocomplete="off"/>    
					<div class="suggestionsBox" id="suggestions" style="display: none;">
						<img src="../images/searchUpArrow.png" style="position: relative; top: -12px; left: 10px;" alt="upArrow" />
						<div class="suggestionList" id="autoSuggestionsList">
						</div>
					</div>
                    			<h1>Currently Browsing: <?php echo $defaultWorld; ?></h1>
				</div> 
				</form>
			</div>
			</td>
		</tr>

	</table>
	</div>

		<?php 
		if($loginCookie != "Guest")
		{
		?>
			<script type="text/javascript" src="scripts/UserCP.js"></script>
			<center>
			<ul id="paramList">
				<script>loadSnipes('false');</script>
            		</ul> 
			</center>
		<?php
		}
		?>
    
    <div class="loggedInAs">
    	Logged In As: <a href="home.php?p=Account">
	<?php 
		echo $loginCookie;
	?>
	</a>
    </div>
</header>
</body>
</html>
