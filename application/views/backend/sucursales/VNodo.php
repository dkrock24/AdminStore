<!DOCTYPE html>
<html>
<input type="hidden" name="sucursal" id="id_sucursal" value="<?php echo $sucursales[0]->id_sucursal ?>">
<input type="hidden" name="nodo" id="id_nodo" value="<?php echo $sucursales[0]->id_nodo ?>">
<head>
	<meta charset=utf-8 />
	<title></title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />

<!--
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

-->

	<script type="text/javascript" src="../../../../../../assets/jquery.min.js"></script>
	<script type="text/javascript" src="../../../../../../assets/jquery1.11.min.js"></script>
	<script type="text/javascript" src="/control/assets/js/jquery.fullscreen.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../../../../../assets/bootstrap.min.css">

	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- <script src="http://45.33.3.227/lapizzeria/js/longpoll.js"></script> -->

	<script src="/control/js/longpoll.js"></script>

	<script>
		//var requestUrl = "http://45.33.3.227/lapizzeria/demo.php";
		var requestUrl = "/control/demo.php";
		/*	set user to 2 here	*/
		var id_sucursal = $("#id_sucursal").val();
		var id_nodo 	= $("#id_nodo").val();
		var data 		= {"id_sucursal":id_sucursal, "id_nodo":id_nodo};
		var html 		= "";

		/*
		/ =================================================
		*/
		var response;
		function init(){
				$.ajax({
		            url: "/control/demo2.php",
		            type:"post",
		            data:data,
		            success: function(data){     
		            	response = JSON.parse(data);		            	
						//console.log(response);
				
						if(response.success == 0)
						{
							var contador=1;
							console.log(response);
							for(var i=0 ; i<response.pedido.length ; i++)
							{

								html += "<div class='wrapper' id='wrapper"+response.pedido[i]['id_pedido']+"' ><div class='list-group abc'><a href='#' class='list-group-item default comanda'><i class='fa fa-home'></i>ORDEN -  # "+response.pedido[i]['secuencia_orden']+"</a>";
							
								// pedido
								var ID_PEDIDO_VALUE = response.pedido[i]['id_pedido'];
								html += "<a href='#' name='' class='list-group-item nodo'><table class='table table-hover' style='border:1px solid black;'>";
								
								

				
								
								var de = Object.keys(response.pedido[0]).length;
					
								de = de - 9;
								contador=1;
								for(var j=0 ; j< de; j++)
								{
									if(response.pedido[i][j]['nombre_producto']!=null)
									{

									// Detalle Productos
									//html += "<tr><td>"+contador+"</td>";
									html += "<tr><td width='30%'>[ "+ response.pedido[i][j]['pedido_estado'] +" ] - "+response.pedido[i][j]['nombre_producto']+" / " +response.pedido[i][j]['description_producto']+"<img src='/kaprichos/uploaded/mod_productos/"+response.pedido[i][j]['image']+"' width='150px' height='' />";
									html += "<td width='40%'>";
									html += "Encargado de Produccion : <select name='empleado1' class='form-control' id='empleado1"+response.pedido[i]['id_pedido']+"'>"+
												"<?php foreach($empleados as $emp){ ?>"+
												"<option value='<?php echo $emp->id_usuario; ?>'><?php echo $emp->nickname;  ?></option>"+
												"<?php } ?>"
											+"</select><br>";	
									html += "Encargado de Entrega : <select name='empleado2' class='form-control' id='empleado2"+response.pedido[i]['id_pedido']+"'>"+
												"<?php foreach($empleados as $emp){ ?>"+
												"<option value='<?php echo $emp->id_usuario; ?>'><?php echo $emp->nickname; ?></option>"+
												"<?php } ?>"
											+"</select>";
									html += "Estado : <select name='estado' class='form-control' id='estado"+response.pedido[i]['id_pedido']+"'>"+
												"<?php foreach($estados as $est){ ?>"+
												"<option value='<?php echo $est->id_pedido_estado; ?>'><?php echo $est->pedido_estado; ?></option>"+
												"<?php } ?></select>";
									html += "<br>"+response.pedido[i][j]['nota_interna']+"</td>";
									
									html +="<td width='30%'>Precio Original: ";
									
									html +="<b> $ "+response.pedido[i][j]['precio_original']+"</b><br>";

									html +="Precio Grabado:<b>$ "+response.pedido[i][j]['precio_grabado']+"</b>"+
											"<br>Cantidad :<b> "+ response.pedido[i][j]['cantidad'] +"</b><br><a  href='#' class='btn btn-warning completar' id='"+response.pedido[i]['numero_mesa']+"' secuencia='"+response.pedido[i]['secuencia_orden']+"' pedido='"+response.pedido[i]['id_pedido']+"'>Completar</a>";
										
											html +="</td></tr>";
									contador++;
									}
								}	
								html += "</table></a>";
							html += "</div><span class='tiempo'></div>";
							$('.ordenes').append(html);		
							html="";			
							}
							
						}

					},
					error:function(){
					    //alert("Error.. No se subio la imagen");
					}
				}); 
		}
		init();

		var callBack = function(response)
		{
			response = JSON.parse(response);	
			//console.log(response);
				
			if(response.success == 0)
			{
				var contador=1;
				console.log(response);
				for(var i=0 ; i<response.pedido.length ; i++)
				{
					html += "<div class='wrapper' id='wrapper"+response.pedido[i]['id_pedido']+"' ><div class='list-group abc'><a href='#' class='list-group-item default comanda'><i class='fa fa-home'></i>ORDEN -  # "+response.pedido[i]['secuencia_orden']+"</a>";
				
					// pedido
					var ID_PEDIDO_VALUE = response.pedido[i]['id_pedido'];
					html += "<a href='#' name='' class='list-group-item nodo'><table class='table table-hover' style='border:1px solid black;'>";
								


					var de = Object.keys(response.detalle).length;
					//alert(de);
					//de = de - 9;
					contador=1;
					
					for(var j=0 ; j< de; j++)
					{
						// Detalle Productos
						
						// Detalle Productos
									//html += "<tr><td>"+contador+"</td>";
									html += "<tr><td width='30%'>[ "+ response.detalle[j]['pedido_estado'] +" ] - "+response.detalle[j]['nombre_producto']+" / " +response.detalle[j]['description_producto']+"<img src='/kaprichos/uploaded/mod_productos/"+response.detalle[j]['image']+"' width='150px' height='' />";
									html += "<td width='40%'>";
									html += "Encargado de Produccion : <select name='empleado1' class='form-control' id='empleado1"+response.detalle[j]['id_pedido']+"'>"+
												"<?php foreach($empleados as $emp){ ?>"+
												"<option value='<?php echo $emp->id_usuario; ?>'><?php echo $emp->nickname;  ?></option>"+
												"<?php } ?>"
											+"</select><br>";	
									html += "Encargado de Entrega : <select name='empleado2' class='form-control' id='empleado2"+response.detalle[j]['id_pedido']+"'>"+
												"<?php foreach($empleados as $emp){ ?>"+
												"<option value='<?php echo $emp->id_usuario; ?>'><?php echo $emp->nickname; ?></option>"+
												"<?php } ?>"
											+"</select>";
									html += "Estado : <select name='estado' class='form-control' id='estado"+response.detalle[j]['id_pedido']+"'>"+
												"<?php foreach($estados as $est){ ?>"+
												"<option value='<?php echo $est->id_pedido_estado; ?>'><?php echo $est->pedido_estado; ?></option>"+
												"<?php } ?></select>";
									html += "<br>"+response.detalle[i]['nota_interna']+"</td>";
									
									html +="<td width='30%'>Precio Original: ";
									
									html +="<b> $ "+response.detalle[i]['precio_original']+"</b><br>";

									html +="Precio Grabado:<b>$ "+response.detalle[i]['precio_grabado']+"</b>"+
											"<br>Cantidad :<b> "+ response.detalle[i]['cantidad'] +"</b><br><a  href='#' class='btn btn-warning completar' id='"+response.detalle[j]['numero_mesa']+"' secuencia='"+response.detalle[i]['secuencia_orden']+"' pedido='"+response.detalle[i]['id_pedido']+"'>Completar</a>";
										
											html +="</td></tr>";
									contador++;
					}					
				}
				html += "</table></a>";
				html += "</div><span class='tiempo'></div>";
				$('.ordenes').append(html);		
				html="";
			}

			var tiempo = 
			{
	        	hora: 0,
	        	minuto: 0,
	        	segundo: 0
    		};

    		var tiempo_corriendo = null;

			tiempo_corriendo = setInterval(function(){
		                // Segundos
		                tiempo.segundo++;
		                if(tiempo.segundo >= 60)
		                {
		                    tiempo.segundo = 0;
		                    tiempo.minuto++;
		                }      

		                // Minutos
		                if(tiempo.minuto >= 60)
		                {
		                    tiempo.minuto = 0;
		                    tiempo.hora++;
		                }

		                $(this).find(".hora").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
		                $(this).find(".minuto").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
		                $(this).find(".segundo").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
		    }, 1000);			
		}

		longpoll(requestUrl, data, callBack);
	</script>

	<script>
		$(function(){
			$(document).on('click', '.completar', function(){
				//$(this).children('.abc').toggle();				

				$(this).css("background","green");	


				//var ID_mesa = $(this).attr('id');
				var ID_pedido = $(this).attr('pedido');
				var iSecuencia = $(this).attr('secuencia');
				
				
				var elaborado = $('#empleado1'+ID_pedido).val();
				var entregado = $('#empleado2'+ID_pedido).val();
				var estado = $('#estado'+ID_pedido).val();


				if (confirm('Despachar Orden # '+ iSecuencia + '?'))
		        {	            
		            $.ajax({
					    url: "../../despacharPedido/"+ID_pedido+"/"+id_sucursal+"/"+id_nodo+"/"+elaborado+"/"+entregado+"/"+estado,
					    type:"post", 

					    success: function(){     
					    	
					    },
					    error:function(){            
					        alert("Error Al Despachar Pedido");
					    }
					}); 
					$('#wrapper'+ID_pedido).remove();
		            return;
		        }        	
	        });
		});
	</script>
</head>
<style>
body{
	background: black;
	color: white;
}
#x{
	color:white;
}
.hora,.minuto,.segundo{
	font-size: 18px;
}
.wrapper
{
   width:45%;
   height:100%;
   display:inline-block;
   position: relative;
   margin: 10px;
   background: none;
}

.title{
	background: #D82787;
	color: white;
	text-align: center;
	top: 0px;
}
.requestfullscreen{
	color: white;
}
.time{
	text-align:right;
	padding: 10px;
}
.comanda{
	text-align: center;	
}
</style>
<body oncontextmenu="return false;">
<div class="example" id="fullscreen">
<div class="tab-content" style="width: 100%;
    position: fixed;
    display: inline-block;
    z-index: 1000;">
	<div class="row">
		<div class="col-md-12 title">
			<?php
			foreach ($sucursales as $sucursal) {
				?>
				<h2>Sucursal : <?php echo $sucursal->nombre_sucursal.' / '. $sucursal->nombre_nodo; ?></h2>			
				<?php				
			}
			?>

			<div class="derecha">
 				<a href="#" class="requestfullscreen">Pantalla completa</a>
 				<a href="#" class="exitfullscreen" style="display: none">Cerrar Nodo</a>.</p>
		</div>
		</div>
		
	</div>
</div>
			
	<div class="ordenes" style="padding-top: 100px;">
		
	</div>
	</div>
</body>

<script type="text/javascript">
				$(function() {
					// check native support
					$('#support').text($.fullscreen.isNativelySupported() ? 'supports' : 'doesn\'t support');

					// open in fullscreen
					$('#fullscreen .requestfullscreen').click(function() {
						$('#fullscreen').fullscreen();						
						return false;
					});

					// exit fullscreen
					$('#fullscreen .exitfullscreen').click(function() {
						$.fullscreen.exit();
						window.close();
						return false;
					});

					// document's event
					$(document).bind('fscreenchange', function(e, state, elem) {
						// if we currently in fullscreen mode
						if ($.fullscreen.isFullScreen()) {
							$('#fullscreen .requestfullscreen').hide();
							$('#fullscreen .exitfullscreen').show();
						} else {
							$('#fullscreen .requestfullscreen').show();
							$('#fullscreen .exitfullscreen').hide();
						}

						$('#state').text($.fullscreen.isFullScreen() ? '' : 'not');
					});
				});
			</script>

			<!--
			<script src="../../../../../../js/jquery.js"></script>

			-->

</html>