<!DOCTYPE html>
<html>
<input type="hidden" name="sucursal" id="id_sucursal" value="<?php echo $sucursales[0]->id_sucursal ?>">
<input type="hidden" name="nodo" id="id_nodo" value="<?php echo $sucursales[0]->id_nodo ?>">
<head>
	<meta charset=utf-8 />
	<title></title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	
	<script src="../../../../../../js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- <script src="http://45.33.3.227/lapizzeria/js/longpoll.js"></script> -->

	<script type="text/javascript">


	</script>


	<script src="/lapizzeria/js/longpoll.js"></script>

	<script>
		//var requestUrl = "http://45.33.3.227/lapizzeria/demo.php";
		var requestUrl = "/lapizzeria/demo.php";
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
		            url: "/lapizzeria/demo2.php",
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
								html += "<div class='wrapper' id='"+response.pedido[i]['numero_mesa']+"' secuencia='"+response.pedido[i]['secuencia_orden']+"' pedido='"+response.pedido[i]['id_pedido']+"'><div class='list-group abc'><a href='#' class='list-group-item active'><i class='fa fa-home'></i>ORDEN -  # "+response.pedido[i]['secuencia_orden']+"</a>";
							
								// pedido
								var ID_PEDIDO_VALUE = response.pedido[i]['id_pedido'];
								html += "<a href='#' name='' class='list-group-item nodo'><table class='table table-hover'>";
								html += "<tr><td>#</td><td>Producto</td></tr>";
								
								for(var j=0 ; j< response.detalle.length; j++)
								{
									// Detalle Productos
									html += "<tr><td>"+contador+"</td>";
									html += "<td><img src='../../../../../../assets/images/icon-no-elaborado.png' width='20px'/>"+response.detalle[j]['nombre_producto'];
										if(response.detalle[i].items){
											for(var x=0; x < response.detalle[i].items.length; x++){	
												if(response.detalle[i].items[x])
												{
													html += "<ul>";
													if(response.detalle[j].items[x]['eliminado']==1)								
													{
														html += "<li> Quitar -> "+response.detalle[j].items[x]['nombre_matarial']+"</li>";
													}
													if(response.detalle[j].items[x]['adicional']==1)
													{
														html += "<li> Agregar -> "+response.detalle[j].items[x]['nombre_matarial']+"</li>";	
													}
													html += "</ul>";																				
												}
											}
										}
											html +="</td></tr>";
									contador++;
								}					
							}
							html += "</table></a>";
							html += "</div><span class='tiempo'></div>";
							$('.ordenes').append(html);		
							html="";
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
					html += "<div class='wrapper' id='"+response.pedido[i]['numero_mesa']+"' secuencia='"+response.pedido[i]['secuencia_orden']+"' pedido='"+response.pedido[i]['id_pedido']+"'><div class='list-group abc'><a href='#' class='list-group-item active'><i class='fa fa-home'></i>ORDEN -  # "+response.pedido[i]['secuencia_orden']+"</a>";
				
					// pedido
					var ID_PEDIDO_VALUE = response.pedido[i]['id_pedido'];
					html += "<a href='#' name='' class='list-group-item nodo'><table class='table table-hover'>";
					html += "<tr><td>#</td><td>Producto</td></tr>";
					
					for(var j=0 ; j< response.detalle.length; j++)
					{
						// Detalle Productos
						html += "<tr><td>"+contador+"</td>";
						html += "<td><img src='../../../../../../assets/images/icon-no-elaborado.png' width='20px'/>"+response.detalle[j]['nombre_producto'];
							if(response.detalle[i].items){
								for(var x=0; x < response.detalle[i].items.length; x++){	
									if(response.detalle[i].items[x])
									{
										html += "<ul>";
										if(response.detalle[j].items[x]['eliminado']==1)								
										{
											html += "<li> Quitar -> "+response.detalle[j].items[x]['nombre_matarial']+"</li>";
										}
										if(response.detalle[j].items[x]['adicional']==1)
										{
											html += "<li> Agregar -> "+response.detalle[j].items[x]['nombre_matarial']+"</li>";	
										}
										html += "</ul>";																				
									}
								}
							}
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
			$(document).on('click', 'div.wrapper', function(){

				$(this).css("background","green");

				var ID_mesa = $(this).attr('id');
				var ID_pedido = $(this).attr('pedido');
				var iSecuencia = $(this).attr('secuencia');
				if (confirm('Despachar Orden # '+ iSecuencia +" Mesa :"+ ID_mesa + '?'))
		        {	            
		            $.ajax({
					    url: "../../despacharPedido/"+ID_pedido+"/"+id_sucursal+"/"+id_nodo,
					    type:"post", 

					    success: function(){     
					    	
					    },
					    error:function(){            
					        alert("Error Al Despachar Pedido");
					    }
					}); 
					$(this).remove();
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
   width:350px;
   height:100%;
   display:inline-block;
   position: relative;
   margin: 10px;
   background: none;
}

.title{
	background: grey;
	color: white;
	text-align: center;
	top: 0px;
}
.time{
	text-align:right;
	padding: 10px;
}
</style>
<body>

<div class="tab-content">
	<div class="row">
		<div class="col-md-12 title">
			<?php
			foreach ($sucursales as $sucursal) {
				?>
				<h2>Sucursal : <?php echo $sucursal->nombre_sucursal.' / '. $sucursal->nombre_nodo; ?></h2>			
				<?php				
			}
			?>
		</div>
	</div>
</div>
	
	<div class="ordenes">
		
	</div>
</body>
</html>