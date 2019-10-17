$("#logoutForm").submit(function() {
	$('#loadingBar').show();
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$.ajax({
		url: "../actions/process_logout.php",
                type: "POST",
                data: {
			Logout: 'LogOut',
                },
                success: function(response)
                {	
			if(response == 'LoggedOut')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully Logged out. You will be redirected shortly.");
				setTimeout(function () { window.location="home.php?p=Account"; }, 3000);
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
			$('#loadingBar').hide();
                }
	});
	
});


$("#snipeForm").submit(function() {
	$('#loadingBar').show();
	$("#errorMessage").hide();
	$("#successMessage").hide();
	var exactIGN = 0;
	if($('#accountSnipeIGNCheckBox').attr('checked'))
		exactIGN = 1;
	$.ajax({
		url: "../UserCP/process_snipeform.php",
                type: "POST",
                data: {
			snipeAdd: 'Start',
			name: $("#searchParam").val(),
			world: $("#accountSnipeChoice").val(),
			price1: $("#accountSnipePrice1").val(),
			price2: $("#accountSnipePrice2").val(),
			order: $("#accountSnipeOrder").val(),
			low: $("#accountSnipeLow").val(),
			high: $("#accountSnipeHigh").val(),
			exactign: exactIGN
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully added an additional snipe parameter. Reloading snipe list now.");
				document.getElementById("snipeForm").reset();
				loadSnipes();
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
				$('#loadingBar').hide();
                    	}
                }
	});
	
});



$("#fmSettings").submit(function() {
	$('#loadingBar').show();
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$.ajax({
		url: "../actions/process_Account_FM.php",
                type: "POST",
                data: {
			updateFMSettings: '1',
			world: $("#accountWorldChoice").val(),
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully updated FM Settings. The page will be refreshed shortly.");
				setTimeout(function () { window.location = "home.php?p=Account" }, 2000);
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
			$('#loadingBar').hide();
                }
	});
});


function loadSnipes(Home)
{
   	if(typeof(Home)==='undefined') Home = "true";
	$("#paramList").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../UserCP/process_loadsnipes.php",
                type: "POST",
                data: {
			loadSnipes: 'loadSnipes',
			home: Home
                },
                success: function(response)
                {	
                        $("#paramList").html(response);
			$("#paramList").show();
			$('#loadingBar').hide();
                }
	});
}
function deleteSnipe(ID)
{
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../UserCP/process_deletesnipe.php",
                type: "POST",
                data: {
			deleteSnipe: 'deleteSnipe',
			id: ID 
                },
                success: function(response)
                {	
			if(response == 'Deleted')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully deleted the search parameter.");
				loadSnipes();
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
				$('#loadingBar').hide();
                    	}
                }
	});
}



function keepOpen()
{
	return false;
}


(function( $ ) {
  // constants
  var SHOW_CLASS = 'show',
      HIDE_CLASS = 'hide',
      ACTIVE_CLASS = 'active';
  
  $( '.tabs' ).on( 'click', 'li a', function(e){
    e.preventDefault();
    var $tab = $( this ),
         href = $tab.attr( 'href' );
  
     $( '.active' ).removeClass( ACTIVE_CLASS );
     $tab.addClass( ACTIVE_CLASS );
  
     $( '.show' )
        .removeClass( SHOW_CLASS )
        .addClass( HIDE_CLASS )
        .hide();
    
      $(href)
        .removeClass( HIDE_CLASS )
        .addClass( SHOW_CLASS )
        .hide()
        .fadeIn( 550 );
  });
})( jQuery );

$(document).ready(function(){
	$("#accountloadingBar").hide();
	$("#errorMessage").hide();
	$("#successMessage").hide();
});