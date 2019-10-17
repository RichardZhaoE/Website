
<script type="text/javascript">

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

function keepOpen()
{
	return false;
}


function checkLogin(remember)
{
	$.ajax({
		url: "../pages/process_login.php",
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
                        	$("#successMessage").html("Successfully Logged in. You will be redirected shortly");
				setTimeout(loadAccountBox(), 9000);
				setTimeout(loadContents('Account'), 9000);
                    	}
                    	else
                    	{
				$("#errorMessage").show();
                        	$("#errorMessage").html(response);
                    	}
                }
	});
}



function register(agreed)
{
	$.ajax({
		url: "../pages/process_register.php",
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

</script>