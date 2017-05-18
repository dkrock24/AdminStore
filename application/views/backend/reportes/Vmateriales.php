<script>
  	$(document).ready(function(){
  		//Cargar Sucursal
  		$("#cortar").click(function(){
	        $.ajax({
	            url: "../sucursales/Ccortes/cortar/<?php echo $sucursales[0]->id_sucursal;  ?>",
	            type:"post",
	            success: function(){     
	              //$(".pages").load(url1);      
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});
   		//End

   		$(".go-sucursal").click(function(){
    		var id_sucursal = $("#id_sucursal").val();
    		var url1 = $(this).attr("id");
	        $.ajax({
	            //url: url1+id_sucursal,
	            type:"post",
	            success: function(){     
	              $(".pages").load(url1+id_sucursal);      
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});


   		//Filtrar En el Reporte de Cortes
   		$("#filtrar_corte").click(function(){
   			//var id_sucursal = $("#sucursal").val();
	        $.ajax({
	            url: "../reportes/CglobalReporte/getMateriales",
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
		border: 1px solid black;
	}
	.form-control{
		border:1px solid grey;
	}
	.load_ordenes{
		background: none;
		padding: 5px;
		color:black;
	}
	#btnExport{
		float: right;
	}
	table {
		width: 100%;
    border: 1px solid black;
	}
	th {
	    border: 1px solid black;
	    padding: 5px;
	    background-color:grey;
	    color: white;
	}
	td {
	    border: 1px solid black;
	    padding: 5px;
	}
</style>
    	
<ul class="nav nav-tabs">
	<li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">Productos</a></li>
</ul>
<div class="tab-content">  	

	<div class="tab-pane fade active in" id="tab1_2">
		<div class="load_ordenes">
		<form id="filtros">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-3"></div>
				<div class="col-md-3">	
					<span>Sucursal</span>		
					<select name="sucursal" id="id_sucursal" class="form-control">
						<option value="todas">Todas</option>
						<?php
						foreach ($sucursales as $sucursal) {
						?>
							<option value="<?php echo $sucursal->id_sucursal ?>">
								<?php echo $sucursal->nombre_sucursal; ?>
							</option>
						<?php
						}
						?>
					</select>
				</div>

				<div class="col-md-3">	
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


