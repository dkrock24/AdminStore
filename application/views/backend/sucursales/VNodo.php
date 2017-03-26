<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title></title>
	<link rel="stylesheet" type="text/css" media="screen" href="css/master.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="http://localhost/lapizzeria/js/longpoll.js"></script>
	<script>
		var requestUrl = "http://localhost/lapizzeria/demo.php";
		
		/*	set user to 2 here	*/
		var data = {"id_sucursal":$("#id_sucursal").val(), "id_nodo": $("#id_nodo").val() };

		var html = "<div class='list-group'><a href='#' class='list-group-item active'><i class='fa fa-home'></i>ORDEN -  # 220</a><a href='' name='' class='list-group-item nodo'><table class='table table-hover'>";

		var callBack = function(response){
			response = JSON.parse(response);			
			if(response.success == 0){
				
				for(var i=0 ; i<response.feed.length ; i++)
				{
				html+="<tr>";		
					html+="<td>#</td>";
					html+="<td>"+response.feed[i]['nombre_producto']+"</td>";					
					
				html+="</tr>";
				}
				$('.wrapper').append(html);				
			}
		}

		longpoll(requestUrl, data, callBack);
	</script>

	<script>
		$(document).ready(function(){			
      		// CONVERTIR FECHAS A TEXTO
        	$(".wrapper").click(function(){     
        		if($(this).css("background") == "none")
        		{
        			$(this).css("background","green");
        		}
        		else{
        			$(this).css("background","none");
        		}	                   
        	});
        	$(".wrapper").dblclick(function(){
        		$(this).remove();
        	});

        	var tiempo = {
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

                $("#hira").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("#minuto").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("#segundo").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
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
<input type="hidden" name="sucursal" id="id_sucursal" value="<?php echo $sucursales[0]->id_sucursal ?>">
<input type="hidden" name="nodo" id="id_nodo" value="<?php echo $sucursales[0]->id_nodo ?>">
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


	
		<div class="wrapper">
	    	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-home'></i>ORDEN -  # 220
				</a>
				<a href="" name="" class="list-group-item nodo" >
					<table class="table table-hover">
						<tr>
							<td>#</td>
							<td>Item</td>
							<td>Cantidad</td>
							<td>Indicacion</td>
						</tr>
						<tr>
							<td>1</td>
							<td>Licuado de leche</td>
							<td>2</td>
							<td>Poca Azucar</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Licuado de leche</td>
							<td>2</td>
							<td>Poca Azucar</td>
						</tr>
					</table>				
				</a>
				<div class="time">
					<i id="hora"></i> :
					<i id="minuto"></i> :
					<i id="segundo"></i>
				</div>
			</div>

		</div>	

</body>
</html>