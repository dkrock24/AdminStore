<script>
  	$(document).ready(function(){
  		//Cargar Sucursal
  		$("#cortar").click(function(){
  			$(".sk-three-bounce").show();
	        $.ajax({
	            url: "../sucursales/Ccortes/cortar/<?php echo $sucursales[0]->id_sucursal;  ?>",
	            type:"post",
	            success: function(){    
	              
	              	setTimeout(function() {	
				     	$(".sk-three-bounce").css('display','none');
			    	}, 1000);  
			    	$(".pages").load("../sucursales/Ccortes/index/<?php echo $sucursales[0]->id_sucursal;  ?>");    
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});
   		//End


   		//Refresh Pages
  		$(".refresh").click(function(){
  			$(".sk-three-bounce").show();
	        $.ajax({
	            url: "",
	            type:"post",
	            success: function(){    
	              
	              	setTimeout(function() {	
				     	$(".sk-three-bounce").css('display','none');
			    	}, 1000);  
			    	$(".pages").load("../sucursales/Ccortes/index/<?php echo $sucursales[0]->id_sucursal;  ?>");    
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});
   		//End



   		$(".go-sucursal").click(function(){
   			$(".sk-three-bounce").show();
    		var id_sucursal = $("#id_sucursal").val();
    		var url1 = $(this).attr("id");
	        $.ajax({
	            //url: url1+id_sucursal,
	            type:"post",
	            success: function(){     
	              $(".pages").load(url1);      
		              setTimeout(function() {
				     	$(".sk-three-bounce").css('display','none');
				    }, 1000);
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});


   		//Filtrar En el Reporte de Cortes
   		$("#filtrar_corte").click(function(){
	        $.ajax({
	            url: "../sucursales/Ccortes/getCortesByFilter/<?php echo $sucursales[0]->id_sucursal;  ?>",
	            type:"post",
	            data: $('#filtros').serialize(),
	            success: function(data){     
	            	$("#dataTable").html(data);
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});

   		$("#btnExport").click(function (e) {
    		window.open('data:application/vnd.ms-excel,' + $('#dataTable').html());
    		e.preventDefault();
		});


	});
</script>
<style>
	.go-sucursal, .nodo{
		cursor: pointer;
	}
	.titulo{
		background: #9AC835;
		text-align: center;
		padding: 10px;
		color: black;
		font-family:padding:  Arial;
		font-style: bold;
	}
	.titulos-tablas{
		background: #e9e9e9;
	}
	.boton-corte{
		text-align: right;
	}
	.color{
		border: 2px solid black;
		color: black;		
	}
	.descripcion{
		border: 1px solid none;
	}
	.load_ordenes{
		background: #9AC835;
		padding: 5px;
		color:black;
	}
	#btnExport{
		float: right;
	}
	table {
		width: 100%;
    border: 1px solid none;
}
th {
    border: 1px solid black;
    padding: 5px;
    background-color:grey;
    color: white;
}
td {
    border: 1px solid none;
    padding: 5px;
}
.alerta_corte{
	padding: 10px;
	background: white;
	color: red;
	text-align: center;
}
.refresh{
	float: right;
	cursor: pointer;
}
</style>
<h3 id="../sucursales/Cindex/cargar_sucursal/<?php echo $sucursales[0]->id_sucursal; ?>" class="go-sucursal">
    		<i class="fa fa-arrow-left"></i>REGRESAR
    	</h3>
<input type="hidden" value="<?php echo $sucursales[0]->id_sucursal; ?>" name="id_sucursal" id="id_sucursal">
<ul class="nav nav-tabs">
  <li id="menu_li" class="active"><a href="#tab1_1" data-toggle="tab">Corte</a></li>
  <li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">Detalle Corte</a></li>
  <li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">Historico</a></li>
</ul>
<div class="tab-content">  	
	<div class="tab-pane fade active in" id="tab1_1">	
	    <div class="row">
	    	<div class="col-md-12 titulo">
	    		<b>CORTES CAJA  /  SUCURSAL / <?php echo $sucursales[0]->nombre_sucursal; ?></b>
	    		<span class="refresh"><i class="fa fa-refresh fa-6"></i></span>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-md-12">
	    	<?php if ($ordenes == null){ echo "<p class='alerta_corte'>Existen Ordenes Abiertas / No hay Datos .. </p>";} ?>
	    	<?php foreach ($ordenes as $totales): ?>
	    		<table class="table">
	    			<tr class="titulos-tablas">
	    				<td width="25%"></td>
	    				<td width="25%"></td>
	    				<td width="25%">Ordenes Canceladas <i class='fa fa-check'></i></td>
	    				<td width="25%">Total a Cortar</td>
	    			</tr>
	    			<tr>	
	    				<td><?php //echo $totales->fechahora_pedido ?></td>
	    				<td><?php //echo $totales->fechahora_pedido ?></td>    			
	    				<td><?php echo $pedidosCerrados[0]->total ?></td>	    				
	    				<td><?php echo $totales->moneda." ". number_format($totales->Monto,2) ?></td>	    			
	    			</tr>
	    			<tr> 	
	    				<td colspan="3"></td>			
	    				<td><?php //echo //$totales->moneda." ". number_format($totales->Total_Adisional,2) ?></td>
	    			</tr>	    			
	    		</table>    		
	    	<?php endforeach ?>

	    	<?php foreach ($ordenesA as $orden_abierta): ?>
	    		<table class="table">
	    			<tr class="titulos-tablas">
	    				<td width="25%"></td>
	    				<td width="25%"></td>
	    				<td width="25%">Ordenes Abiertas <i class='fa fa-times'></td>
	    				<td width="25%">Total a Cortar</td>
	    			</tr>
	    			<tr>	
	    				<td><?php //echo $orden_abierta->fechahora_pedido ?></td>
	    				<td><?php //echo $orden_abierta->fechahora_pedido ?></td>    			
	    				<td><?php echo $pedidosAbiertos[0]->total ?></td>
	    				<td><?php echo $orden_abierta->moneda." ". number_format($orden_abierta->Monto,2) ?></td>	    			
	    			</tr>
	    			<tr> 	
	    				<td colspan="3"></td>			
	    				<td><?php //echo $orden_abierta->moneda." ". number_format($orden_abierta->Total_Adisional,2) ?></td>
	    			</tr>	    			
	    		</table>    		
	    	<?php endforeach ?>

	    	<?php foreach ($Adicional as $total_adicional): ?>
	    		<table class="table">
	    			<tr class="titulos-tablas">  
	    				<td width="25%"></td> 				
	    				<td width="25%">Serie Fin</td>
	    				<td width="25%">Cupones Cambiados</td>	    						
	    				<td width="25%">Total de Adicionales</td>
	    			</tr>
	    			<tr>	
	    				<td></td>  	
	    				<td><?php echo $series[0]->secuencia_orden ?></td>    
	    				<td><?php echo $cupones[0]->Cupones ?></td>  
	    									
	    				<td><?php echo $total_adicional->moneda." ". number_format($total_adicional->Total_Adisional,2) ?></td>	    			
	    			</tr>   
	    			<tr> 	
	    				<td colspan="3"></td>			
	    				<td><?php //echo $orden_abierta->moneda." ". number_format($orden_abierta->Total_Adisional,2) ?></td>
	    			</tr>	 			
	    		</table>    		
	    	<?php endforeach ?>
	    		
	    		<table class="table">	    			
	    			<tr>
	    				<td colspan="2" class="boton-corte">
	    				<?php
	    					if ($ordenes != null)
	    					{
	    						?>
	    							<a href="#" id="cortar" class="btn btn-danger color"><b>Realizar Corte</b></a>
	    						<?php
	    					}
	    				?>
	    					
	    				</td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>
	</div>

	<div class="tab-pane fade in" id="tab1_2">
		<div class="load_ordenes">
		<form id="filtros">
			<div class="row">
				<div class="col-md-4">
					<span>Desde</span>
					<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="<?php echo date("Y-m-d") ?>">
				</div>
				<div class="col-md-4">			
					<span>Hasta</span>
					<input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="<?php echo date("Y-m-d") ?>">					
				</div>
				<div class="col-md-4">	
					<span>Filtrar</span>		
					<a href="#" id="filtrar_corte" class="form-control btn btn-default">Filtrar</a>
				</div>
			</div>
		</form>
		</div>

		<div class="datos">
		<br>
			<input type="button" id="btnExport" value=" Exportar Datos " />
			
			<div class="row" id="dataTable">			
				
			</div>
		</div>
	</div>
</div>


