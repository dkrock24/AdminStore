$( document ).ready(function() 
{
	$("a#submenu").click(function()
	{
		$(".sk-three-bounce").show();
		var pages 	= $(this).attr('href');	
		var data 	= pages.substr(1);
		var titulo 	= $(this).text();	
		
		$(".titulo_submenu").html("<span>"+titulo+"</span>");

		$.ajax({
		    url: "../../../class_db/configuracion.php",
		    type:"post",
		    data: 1,
		    
		    success: function()
		    {
		       	$(".pages").load("http://localhost/lapizzeria/index.php/"+data);	
		       	//$(".pages").load("http://localhost/lapizzeria/index.php/"+data);
		       	$(".sk-three-bounce").show();
			    setTimeout(function() {
			     	$(".sk-three-bounce").css('display','none');
			    }, 1000);
		     
		    },
		    error:function(){
		        alert("failure1");

		    }
		});	
	});

	

});
	
