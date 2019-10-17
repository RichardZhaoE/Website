<script type="text/javascript">

function loadAccountBox() 
{
	$('#accountBoxContent').load('../include/accountBox.php');
}

function loadContents(page) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=' + page);
	$('#contents').show();
}

function enterPressed(e)
{
	if (e.keyCode == 13) {
		var world = $("#world").val();
		var search = $("#searchBox").val();
		$('#searchBox').val('');
		loadOwl(search, world);
	}
}


function searchOwl() 
{
}


$("form#search_form").submit(function(){
        var world = $("#world").val();
	var search = $("#seachParam").val();
	var newLocation = "home.php?p=fmowl&world=" + world + "&name=" + search;
	window.location = newLocation;
});


function loadOwlWorld(searchParam) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&world=' + searchParam);
	$('#contents').show();
}

function loadOwl(searchParam) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&name=' + searchParam);
	$('#contents').show();
}

function loadOwl(searchParam, world) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&world=' + world + '&name=' + searchParam);
	$('#contents').show();
}

</script>