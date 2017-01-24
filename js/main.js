$(document).ready(function(){
	
	
	$("#idioma").change(function(){
		var lenguaje = $(this).val();
		
		if(lenguaje=='en'){
			location.href = "index";
		}else{
			location.href = "es";
		}
		
	});

	$("#sendApply").click(function(){
		var phone = $("#validPhone").val();
		var name = $("#validPhone").attr('placeholder');

		var CellPhone 		= $("#validCellPhone").val();
		var nameCellPhone 	= $("#validCellPhone").attr('placeholder');
		
		if(phone.length==8){	
			$(".warning1").text("");			
			if(CellPhone.length==8)
			{				
				$(".warning2").text();	
				return true;
			}
			else
			{					
				$(".warning2").text("Invalid "+ nameCellPhone );
				$(".warning2").css("color","red");
				return false;	
			}
			return true;
		}
		else
		{
			$(".warning1").text("Invalid "+ name );			
			$(".warning1").css("color","red");
			return false;	
		}

		
		
	});
});


//demo();