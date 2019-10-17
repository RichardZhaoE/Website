$("#memberTimes").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../administrative/process_addtime.php",
                type: "POST",
                data: {
			timeAdd: 'true',
			time: $("#time").val(),
			user: $("#user").val()
                },
                success: function(response)
                {	
			if(response == 'Please enter a valid time.' || response == 'You do not have permission to view this page.'|| response == 'You do not have permission to use to this function.')
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
                    	else
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html(response);
                    	}
			document.getElementById("time").value = '';
			$('#loadingBar').hide();
                }
	});
});



function accessLogs(page)
{
	$('#loadingBar').show();
	$('#accessLogs').hide();
	$('#accessLogs').load('../administrative/access_logs.php?page=' + page);
	$('#accessLogs').show();
}



$("#refreshFree").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../administrative/process_list.php",
                type: "POST",
                data: {
			refreshFreeList: 'true'
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Free owl List has successfully been refreshed.");
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

$("#enableFree").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../administrative/process_list.php",
                type: "POST",
                data: {
			enableFree: 'true'
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Free owl List has successfully been enabled.");
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


$("#disableFree").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../administrative/process_list.php",
                type: "POST",
                data: {
			disableFree: 'true'
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Free owl List has successfully been disabled.");
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


$("#disableFreeandDelete").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$('#loadingBar').show();
	$.ajax({
		url: "../administrative/process_list.php",
                type: "POST",
                data: {
			disableFreeandDelete: 'true'
                },
                success: function(response)
                {	
			if(response == 'Success')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Free owl List has successfully been disabled and deleted.");
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