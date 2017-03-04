
<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<script src="../../../../../assets/js/jquery.qtip.js"></script>
	<script src="../../../../../assets/js/pedidos.js"></script>
	<link rel="stylesheet" href="../../../../../assets/css/jquery.qtip.css" />
	<link rel="stylesheet" href="../../../../../assets/css/estilos_pedidos.css" />
	<style type="text/css">

		#cabecera {
			width: 100%;
			background: black;
			text-align: right;			
			display: inline-block;
			position: relative;
			padding-top: 1%;
			color: white;
		}
		#menu {
		  	float: left;
		  	width: 15%;
		  	background: grey;	
		  	display: inline-block;
			position: relative;
			clear: both;
		}
		#contenido {
		  	float: left;
		  	padding-left: 1%;
		  	width: 100%;
		  	display: inline-block;
		  	position: relative;
		}

		#principal {

		  	width: 80%;
		  	background: grey;
		  	display: inline-block;
			position: relative;
		}
		#secundario {
		  	float: left;
		  	width: 20%;
		  	background: grey;
		  	display: inline-block;
			position: relative;
		}
		 
		#pie {
		  clear: both;
		  background: grey;
		  position: absolute; 
			bottom: 0%; 

		}
		.sucursal{
			font-family: sans-serif;
			font-size: 20px;
			float: right;
			background: none;

		}
		.logo{
			height: 100%;
			float: left;
			display: inline;
			position: relative;
			margin-left: 1%;
			background: none;
		}
		.cajero{
			text-align: left;
		}
		.abc{
			background: #007ba7;
		}
		.items{
			width: 25%;
			height: 50px;
			margin-left: 15px;
			display: inline-block;
			background: #007ba7;
			color: white;
			padding: 5px;
			margin-bottom: 5px;
			border-radius: 5px;
		}
		.items:hover{
			background: black;
		}
		.monto{
			float: right;
		}
		.search{
			padding: 5px;
		}
		#search{
			height: 50px;
			font-size: 20px;
		}
		.orden{
			text-align: center;
		}
		.enproceso{			
			background: orange;
		}
		.searchicon{
			display: inline-block;
		}
		.itemcontent{
			position: relative;
		}
		.producto{
			overflow: hidden;
		}
		.key{
			color: black;
		}
	</style>
</head>
<body>
	<div id="container">
  		<div id="row">
  			<div class="col-sm-12 col-md-12 col-lg-12" id="cabecera"> 				
	  		  	<div class="logo"><img src="../../../../../assets/images/avatars/141020164726lapizzeria.png"></div>
	 
	  			<div class="sucursal">
	  				<table>
	  					<tr>
	  						<td><strong>SUCURSAL :</strong></td>
	  						<td><?php echo $sucursales[0]->nombre_sucursal; ?></td>  						
	  						<td>
	  							[ <input type="checkbox" id="modo_tactil" value="1" /> <label style="font-size:10pt" for="modo_tactil">táctil</label> ]&nbsp; 
	  							
            					<button class="key" key="66" id="borrar_orden"><b>B</b>orrar</button>&nbsp;
            					<button class="key" key="82" id="ver_resumen"><b>R</b>esumen</button>
            					<button class="key" key="69" id="enviar_orden_a_cocina"><b>E</b>nviar</button>
            					
	  						</td>
	  					</tr>
	  					<tr>
	  						<td>CAJERO : </td>
	  						<td class="cajero"><?php echo $_SESSION['uno']; ?></td>
	  					</tr>
	  				</table>
	  			</div>
  			</div>
  		</div>

  		<div class="row" id="contenido">
  			<div class="col-sm-6 col-md-6"> 
  				<div class="search">
  					<div class="input-group">
					  	<span class="input-group-addon"><i class="fa fa-search fa-2x pull-left searchicon"></i></span>
					  	<input type="search" class="form-control key enfocar" id="search" key="88" placeholder="Buscar ....">
					</div>
				
				</div>		
  			</div>
  			<div class="col-sm-4 col-md-5"> 
  				<div class="orden">
					<h3>CREANDO ORDEN</h3>
				</div>		
  			</div>	
  		</div>

  		<div class="row">
  			<div class="col-sm-2 col-md-2"></div>
  			<div class="col-sm-6 col-md-6">
  				<div id="resumen"></div>
  			</div>
  			<div class="col-sm-1 col-md-1"></div>
  		</div>


  		<div class="row">
  			<div class="col-sm-11 col-md-12"> 
  			<input type="hidden" id="mesasas" value="<?php echo $productos[0]->numero_mesas; ?>">
            	<div class="items-collection" id="scroller">            	
				<?php
					$contador=0;
					if($productos !="")
					{
						
		            foreach ($productos as $value) {
		                ?>
		                <div class="items agregar_producto" 
		                	tabindex="<?php echo $contador; ?>"
		                	producto="<?php echo $value->id_producto; ?>" 
		                	nombre="<?php 	echo $value->nombre_producto; ?>"
		                	precio="<?php 	echo $value->precio; ?>">
		                    <div class="itemcontent">		                                    
		                    	<div class="row elemento">
		                    		<div class="col-md-12">
		                    			<span class="producto">
		                    				<?php   echo $value->nombre_producto; ?>
		                    			</span>
		                    			<span class="monto">
		                    				<h4><b><?php echo $value->moneda; ?> <?php echo $value->precio; ?></b></h4>	
		                    			</span>		                    			
		                    		</div>
		                    	</div>
		                        
		                    </div>
		                </div>
		                <?php
		                $contador++;
		            }
		        	}
				?>
				</div>
  			</div>
  			<div class="col-md-2">   				
  				<div id="info_principal">
  					
  				</div>
  			</div>	
  		</div>

  		<div class="row" id="menu_productos">		
			    <?php
			    foreach ($categorias as $categoria) {
			    	?>
			    	<a class="mp" href="#"><?php echo $categoria->nombre_categoria_producto; ?></a>
			    	<?php
			    }
			    ?>
  		</div>

	</div>
</body>
<script>
$(function () {
    $('#search').on('keyup', function () {
        var pattern = $(this).val();
        $('.items-collection .items').hide();
        $('.items-collection .items').filter(function () {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });
});
</script>
</html>


