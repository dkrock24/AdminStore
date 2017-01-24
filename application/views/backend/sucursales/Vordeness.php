<?php
	
?>
<!DOCTYPE html>
<html>
<head>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
			width: 45%;
			margin-left: 15px;
			display: inline-block;
			background: #007ba7;
			color: white;
			padding: 5px;
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
  			<div class="col-sm-7 col-md-7 col-lg-7"> 
  				<div class="search">
  					<div class="input-group">
					  	<span class="input-group-addon"><i class="fa fa-search fa-2x pull-left searchicon"></i></span>
					  	<input type="search" class="form-control" id="search" placeholder="Buscar ....">
					</div>
				
				</div>		
  			</div>
  			<div class="col-sm-5 col-md-5 col-lg-5"> 
  				<div class="orden">
					<h3>ORDENES EN PROCESO</h3>
				</div>		
  			</div>	
  		</div>

  		<div class="row">
  			<div class="col-sm-7 col-md-7 col-lg-7"> 

            	<div class="items-collection">
				<?php
					$contador=0;
		            foreach ($productos as $value) {
		                ?>
		                <div class="items">
		                    <div class="itemcontent">		                                    
		                    	<div class="row elemento">
		                    		<div class="col-md-6">
		                    			<h4><?php   echo $value->nombre_producto; ?></h4>
		                    		</div>
		                    		<div class="col-md-6">
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
				?>
				</div>
  			</div>
  			<div class="col-sm-5 col-md-5 col-lg-5"> 
  				<div class="enproceso">
  					Demo
  				</div>
  			</div>	
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

$(window).load(function(){
    $("#search").focus();
});

$(function(){  
    rsv_solicitar('producto_ingredientes_y_adicionales',{}, function(datos){
        for (x in datos.aux.adicionables)
        {
            _adicionales[datos.aux.adicionables[x].ID_adicional] = datos.aux.adicionables[x];
        }
    }, true);


    $('#buscar_producto').qtip({
        content: {
            text: 'Presione [ENTER] o flecha [ABAJO] para pasar a los resultados.'
        }
    });

    $(document).on('focus mouseover', '.agregar_producto', function(event) {
        $(this).qtip({
            overwrite: true,
            content: '[ENTER] para agregar el producto.<br />[ESPACIO] para personalizar<br />[1] a [9] para agregar x cantidad de veces',
            show: {
                solo: true,
                event: event.type,
                ready: true 
            }
        }, event);
    });
    
    $(document).on('mouseover', '#busqueda_adicionales', function(event) {
        $(this).qtip({
            overwrite: true,
            content: 'Presione [ENTER] o flecha [ABAJO] para pasar a los resultados.',
            show: {
                solo: true,
                event: event.type,
                ready: true 
            }
        }, event);
    });
});
</script>
</html>