<script type="text/javascript">

function keyLeftUp(inputString) {
	if(inputString.length == 0)
		$('#suggestions').hide();
	window.timer = setTimeout(function() { lookup(inputString) }, 1000);
}
function keyLeftDown() {
	clearTimeout(window.timer);
}

function lookup(inputString) {
	clearTimeout(window.timer);
	if(inputString.length == 0) {
		// Hide the suggestion box.
		$('#suggestions').hide();
	} else {
		$.post("scripts/suggestion.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').show();
				$('#autoSuggestionsList').html(data);
			}
		});
	}
} // lookup
	
function fill(thisValue) {
	$('#searchBox').val(thisValue);
	setTimeout("$('#suggestions').hide();", 200);
}


function keyLeftUp2(inputString) {
	if(inputString.length == 0)
		$('#suggestions2').hide();
	window.timer = setTimeout(function() { lookup2(inputString) }, 1000);
}

function lookup2(inputString) {
	clearTimeout(window.timer);
	if(inputString.length == 0) {
		// Hide the suggestion box.
		$('#suggestions2').hide();
	} else {
		$.post("scripts/suggestion.php", {queryString: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions2').show();
				$('#autoSuggestionsList2').html(data);
			}
		});
	}
} // lookup

function fill2(thisValue) {
	$('#searchBox').val(thisValue);
	setTimeout("$('#suggestions2').hide();", 200);
}

</script>