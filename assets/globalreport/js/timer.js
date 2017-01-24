

TrlHfa.prototype.showPopup = function(sUrl) {

    var oPopupOptions = {
        fog: {
            color: '#fff', 
            opacity: .7
        },
        closeOnOuterClick: false        
    };

    $.get(sUrl, function(data) {   
        $('#hfa_popup').remove();
        $(data).appendTo('body').dolPopup(oPopupOptions); 
    });

}

$(document).ready(function(){


	$('.enlace').click(function(){
		//$('.row2').load("grafica.php");
		$('this').load(demo());
	});

	$(".add").click(function(){
		alert("add");
	});


	graydisabled();
	$(".inputdata").click(function(){
		$(this).find("input").attr("disabled","").focus();
	
	});
	
	$(".inputdata").find("input").blur(function(){
		graydisabled();
	});
	
	


});

function graydisabled(){
	$(".idata").each(function(){
		if(!$(this).val()>0){
			$(this).attr("disabled","true");
		}
	});

}

