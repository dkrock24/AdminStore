$(document).ready(function() {


	/**********************************************************************************************
	* Acion del boton para editar el registro del query en la tabla y envia a la accion showQuerys
	***********************************************************************************************/
	$(".edit_query").click(function()
	{
		var id = $(this).attr("id");
		var data = {id:id};
		var sUrl = site_url + 'm/globalreport/showQuerys/';
			$.ajax({
		        url:sUrl,
		        data: data,
		        dataType: "text",
		        type: "POST",		            
			    success: function(data)
			    {
				    $(".container").html(data);               	                                       
			    }                 
		    }); 
	});

	/*****************************************************************************************
	* Se agrega una nueva Query, y la manda al form
	*****************************************************************************************/
	$('#addQuery').click(function()
	{
		var contador=0;
		var form = $("#addData").serializeArray();


		$.each(form, function(i, field)
		{
			if(field.value!=''){
				if(field.name=='name'){
					$(".name").html("");
				}
				if(field.name=='title'){
					$(".title").html("");
				}
				if(field.name=='icon'){
					$(".icon2").html("");
				}
				if(field.name=='description'){
					$(".description").html("");
				}
				if(field.name=='query'){
					$(".query").html("");
				}
				//alert("no es null" + field.name + ":" + field.value + " ");
			}
			else{
				contador+=1;
	
				if(field.name=='name'){
					$(".name").html("*");
					$(".name").css("color","red");

				}
				if(field.name=='title'){
					$(".title").html("*");
					$(".title").css("color","red");
				}
				if(field.name=='icon'){
					$(".icon2").html("*");
					$(".icon2").css("color","red");
				}
				if(field.name=='description'){
					$(".description").html("*");
					$(".description").css("color","red");
				}
				if(field.name=='query'){
					$(".query").html("*");
					$(".query").css("color","red");
				}

				
				//alert("si es null" +field.name + ":" + field.value + " ");
			}
        	//alert(field.name + ":" + field.value + " ");
    	});

    	if(contador==0)
    	{
    		var sUrl = site_url + 'm/globalreport/AddNewQuery/';
    		var sUrl2 = site_url + 'm/globalreport/administration/SettingParameter';
			$.ajax({
				url:sUrl,
				data: form,
				type: "POST",							    
				success:function(data)
				{
					$(".addSuccess").html(data);
					var a = $(".addSuccess").html();
					if(a==" ERROR !"){
						alert("Existe Codigo Malicioso en la Query.");
					}	
					else{
						//alert("no");
						window.location.href = sUrl2;
					}				
					
				}
			});
    	}else{
    		alert("Existen Campos Vacios");

    	}
	});	


	/******************************************************************************************
	* Funcion : Captura el Formulario de los inputs que seran los parametros de la query
	******************************************************************************************/
	$("#addParameter").click(function()
	{
		var form = $("#parameter_form").serializeArray();
		var numero = $("#numero").val();
		var contador=0;
		var otro=0;
		
		$.each(form, function(i, field)
		{
			if(field.value!=''){
			}else{
				contador+=1;
			}
			otro+=1;
        	//alert(field.name + ":" + field.value + " ");
    	});
    	var data = {data:form,numero:otro};
    	if(contador==0)
    	{
    		var sUrl = site_url + 'm/globalreport/SaveParameters/';
    		var sUrl2 = site_url + 'm/globalreport/administration/SettingQueries';
			$.ajax
				({
					url:sUrl,
					data: data,
					type: "POST",							    
					success:function(data)
					{
						$(".addSuccess").html(data);
						window.location.href = sUrl2;
					}
				});
    	}
    	else
    	{
    		alert("Existen Campos Vacios");
    	}

	});

	/******************************************************************************************
	* Carga los parametros de la Query
	******************************************************************************************/
	$("#update_parameter").click(function(){
		var id 		= $(".txt_box").val();
		var data 	= {id:id};
		var sUrl 	= site_url + 'm/globalreport/LoadParameters/';
    	var sUrl2 	= site_url + 'm/globalreport/administration/SettingQueries';
			$.ajax
				({
					url:sUrl,
					data: data,
					type: "POST",							    
					success:function(data)
					{
						$("#load_parameter").html(data);
						window.location.href = sUrl2;
					}
				});
	});


	/*****************************************************************************************
	* Eliminar la query por completa.
	*****************************************************************************************/
	$('#deleteQuery').click(function()
	{		
		var r = confirm("Delete the Information");
		if (r == true)
		{
		    var valor = $(this).attr("name");
		    var sUrl = site_url + 'm/globalreport/deleteQuery/';
		    var sUrl2 = site_url + 'm/globalreport/administration/SettingQueries';
			$.ajax
				({
					url:sUrl,
					data: {id:valor},
					type: "POST",							    
					success:function(data)
					{
						alert("Was Success Delete!");
						window.location.href = sUrl2;
					}
				});
		}
		else
		{
		    x = "You pressed Cancel!";
		}
		
	});

	$(".enlace").click(function(){
		$(".enlace").css("background-color","#49166d");
		$(this).css("background-color","#73E600");
	});


	/******************************************************************************************
	* Function : Agrega Dinamicamente Los imputs a Necesiar como  Parametros en la Query
	******************************************************************************************/

	//Regresa de editar una query 
	$("#aa").click(function(){

		var id = $(this).attr("name");
		data = {id:id};

		var sUrl = site_url + 'm/globalreport/showQuerys/';
			$.ajax
		        ({
		         url:sUrl,
		         data: data,
		         dataType: "text",
		         type: "POST",
		            
			        success: function(data)
			        {
				        $(".container").html(data);               	                                       
			        }                 
		    }); 
	});

	var x = $("#update_form_parameter").attr("name");
	var conta_parametro=0;
	if(x!=null){
		conta_parametro= x-1;
	}
	$("#addInputs").click(function()
	{
		conta_parametro++;
		var A,B,C;
		A="A";
		B="B";
		C="C";
		var total = conta_parametro;

		var html = '';
		$("#parametros").append('<div class="fila"><table border="0"><br><tr><td><input type="text" value="" name="'+A+conta_parametro +'"></td><td><input type="text" value="" name="'+B+conta_parametro +'"></td><td><input type="text" value="" name="'+C+conta_parametro +'"></td><td><pan class="row_input"><i class="icon-cancel-circle"></i>Remove</span></td></tr><table></div>');
		$(".row_input").click(function()
		{
			--total;
			if(total==0)
			{
				conta_parametro=0;
				total=0;
			}
			var padre = $(this).parent().parent().parent().parent().parent();
			padre.remove();
			$("#numero").val(total);
		});
		$("#numero").val(conta_parametro);		
	});

	/*
	* Elimina los inputs(parametros) de cada query cuando se edita la informacion de cada una
	* de ellas, es llamada de la funcion LoadParameters()
	*/
	$(".row_input2").click(function()
	{
		var padre = $(this).parent().parent();
		padre.remove();
	});

	/*
	* Es funcion se ejecuta al dar click al boton de save de actalziacion de los parametros de las querys
	*/
	$("#update_form_parameter").click(function(){

		var idReport   	= $("#aa").attr("name");
		var numero 		= $("#numero").val();
		var form 		= $("#update_parameter_form").serializeArray();
		var sUrl 		= site_url + 'm/globalreport/saveUpdateFormParameters/';
		var sUrl2 		= site_url + 'm/globalreport/administration/SettingQueries';
		var contador	=0;
		$.each(form, function(i, field)
		{
			contador+=1;        	
    	});
		var info 	= {data:form, id:numero,longitud:contador,finaly:idReport};
		$.ajax
			({
				url:sUrl,
				data: info,
				type: "POST",							    
					success:function(data)
					{
						window.location.href = sUrl2;
					}
			});
	});	

	/*
	* Captura el formulario del update de los registros de la 
	* graficas y los envia a la funcion updateForm para procesarlos
	*/
	$('#update').click(function()
	{		
		var form = $("#updateData").serialize();
		var sUrl1 = site_url + 'm/globalreport/updateForm/';
		var sUrl2 = site_url + 'm/globalreport/administration/SettingQueries';
		$.ajax
			({
				url:sUrl1,
				data: form,
				type: "POST",							    
					success:function(data)
					{
						var id = $(".txt_box").val();
						var info = {id:id};
						$(".ddd").html(data);
						$(".container").empty();
						$.ajax
						({
							url:sUrl2,
							data: info,
							type: "POST",							    
								success:function(data)
								{
									$(".container").html(data);
								}
						});
						window.location.href = sUrl2;
					}
			});
	});	


	/*
	* Insertar la funcion de los Iconos al formulario ActionshowQuerys
	*/
	$(".search_icon").click(function(){
		var form=1;
		var sUrl1 = site_url + 'm/globalreport/IconCatalog/';
		$.ajax
			({
				url:sUrl1,
				data: form,
				type: "POST",							    
					success:function(data)
					{
						$('.icon_catalog').html(data);
					}
			});
	});

	/*
	* Funcion que añade el name de la clase en el input del formulario ActionshowQuerys
	*/
	$(".zoom").click(function()
	{
		var icon = $(this).text();
		$("#icon-input").val(icon);
	});


	/*
	* En la Vista de los reportes, al presionar cada boton de grafica, carga los inputs como parametros
	*/

	$("#export").click(function(){
		alert(24);
	});

	$(".views").click(function () 
	{
			var idChart = $(this).attr("id");
		    var oPopupOptions = {
		        fog: {
		            color: '#fff', 
		            opacity: .7
		        },
		        closeOnOuterClick: true        
		    };	
		    var data = {id:idChart};
		    
		    var sUrl = site_url + 'm/globalreport/settingCharts/';
		    
			    $.ajax
		        ({
		         url:sUrl,
		         data: data,
		         dataType: "text",
		         type: "POST",
		            
			        success: function(data)
			        {

			        	/*******************************************************
						*  Inserta la Vista del Formulario en la Funcion Report*
			        	********************************************************/
			        	
				        $("#forms").html(data);
				        $("#graficas").empty();
				        $('#save').click(function()
					    {
					    	$("#graficas").empty();		
					    	var cc = site_url + 'm/globalreport/Loading/';
							$.ajax
							({
									url:cc,
									type: "POST",							    
									success:function(data)
									{
										$("#cc").html(data);									
									}
							});

								var form = $("#plantilla").serializeArray();
								var sUrl1 = site_url + 'm/globalreport/Showchart/';

									$.ajax
										({
										url:sUrl1,
										data: form,
										type: "POST",
											success:function(data)
											{	

												$(".loading").hide();					    	
												$("#graficas").html(data);
												$(".loading").hide();
											}
									});

							});		               	                                       
			        }                 
		        }); 
    });





}); 

 