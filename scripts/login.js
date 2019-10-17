$("#loginForm").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$("#accountloadingBar").show();
	var remember = $('input[id=rememberMe]:checked').map(function()
	{
		return $("#rememberMe").val();
	}).get();
	checkLogin(remember);
	$("#accountloadingBar").hide();
	
});

$("#registerForm").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$("#accountloadingBar").show();
	var agreed = $('input[id=regagree]:checked').map(function()
	{
		return $("#regagree").val();
	}).get();
	register(agreed);
	$("#accountloadingBar").hide();
	
});

$("#resetForm").submit(function() {
	$("#errorMessage").hide();
	$("#successMessage").hide();
	$("#accountloadingBar").show();
	$.ajax({
		url: "../actions/process_resetPassword.php",
                type: "POST",
                data: {
					resetPassword: 'Start',
					userName: $("#resetFormID").val(),
					Email: $("#resetFormEmail").val(),
					passWord: $("#resetFormPassword1").val(),
					passWord2: $("#resetFormPassword2").val(),
                },
                success: function(response)
                {	
						if(response == 'Reset')
                    	{
							$("#successMessage").show();
                        	$("#successMessage").html("Password successfully reset. You may now log in with your new password.");
                    	}
                    	else
                    	{
							$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
						document.getElementById("resetFormPassword1").value = '';
						document.getElementById("resetFormPassword2").value = '';
						$('#loadingBar').hide();
						$("#accountloadingBar").hide();
                }
	});
});


function keepOpen()
{
	return false;
}


function checkLogin(remember)
{
	$('#loadingBar').show();
	$.ajax({
		url: "../actions/process_login.php",
                type: "POST",
                data: {
			login: 'Start',
			userName: $("#username").val(),
			passWord: $("#password").val(),
			remember: remember
                },
                success: function(response)
                {	
			if(response == 'Login')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully Logged in. You will be redirected shortly.");
				setTimeout(function () { window.location="home.php?p=Account"; }, 3000);
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
			document.getElementById("password").value = '';
			$('#loadingBar').hide();
                }
	});
}



function register(agreed)
{
	$('#loadingBar').show();
	$.ajax({
		url: "../actions/process_register.php",
                type: "POST",
                data: {
			register: 'Start',
			agree: agreed,
			captcha: $("#regcaptcha").val(),
			userName: $("#regusername").val(),
			Email: $("#regemail").val(),
			passWord: $("#regpassword").val(),
			passWord2: $("#regpassword2").val(),
			world: $("#regworld").val()
                },
                success: function(response)
                {	
			if(response == 'Register')
                    	{
				$("#successMessage").show();
                        	$("#successMessage").html("Successfully registered. You may now log in.");
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
			document.getElementById("regpassword").value = '';
			document.getElementById("regpassword2").value = '';
			$('#loadingBar').hide();
                }
	});
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