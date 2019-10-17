function loadAccountBox() 
{
	$('#accountBoxContent').load('../include/accountBox.php');
}

function accountBoxLinkClick()
{
	loadContents('Account');
	return false;
}

function loadContents(page) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=' + page);
	$('#contents').show();
	document.getElementById("contents").style.height = "auto";
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

$("form#search_form").submit(function(){
        var world = $("#world").val();
	var search = $("#seachParam").val();
	var newLocation = "home.php?p=fmowl&world=" + world + "&name=" + search;
	window.location = newLocation;
});

function loadOwlWorld(world) {
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&world=' + world);
	$('#contents').show();
}


function loadOwl(searchParam, world) {
	searchParam = encodeURIComponent(searchParam);
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&world=' + world + '&name=' + searchParam);
	$('#contents').show();
}

function loadOwlPage(searchParam, world, page, low, high, order, down, up)  {
	searchParam = encodeURIComponent(searchParam);
	$('#loadingBar').show();
	$('#contents').hide();
	$('#contents').load('../include/pageIncludes.php?p=fmowl&name=' + searchParam + '&world=' + world + '&page=' + page + '&Price1=' + low + '&Price2=' + high + '&order=' + order + '&searched=1&idlow=' + down + '&idHigh=' + up);
	$('#contents').show();
}


function loadOwlContents(searchParam, world, page, low, high, order, down, up) 
{
	searchParam = encodeURIComponent(searchParam);
	$('#loadingBar').show();
	$('#fmTable').load('../pages/fm.php?&name=' + searchParam + '&world=' + world + '&page=' + page + '&Price1=' + low + '&Price2=' + high + '&order=' + order + '&searched=1&idlow=' + down + '&idHigh=' + up);
}


function searchSubmit() 
{
	var searchParam = encodeURIComponent($("#searchParam").val());
	var world = $("#worldSelect").val();
	var low = $("#Price1").val();
	var high = $("#Price2").val();
	var order = $("#orderSelect").val();
	var down = 0;
	var up = 99999999;
	$('#loadingBar').show();
	$('#fmTable').load('../pages/fm.php?&name=' + searchParam + '&world=' + world + '&page=1&Price1=' + low + '&Price2=' + high + '&order=' + order + '&searched=1&idlow=' + down + '&idHigh=' + up);
	return false;
}