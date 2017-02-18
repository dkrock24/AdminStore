<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#sucursales").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $(".btn-crear").click(function(){
      		var url = $(this).attr('id');      
            $(".pages").load(url);        
        });


        $(".check").click(function(){
            $(".sk-three-bounce").show();
            var id_nodo_sucursal = $(this).attr("name");
            var estado_nodo_sucursal = $(this).attr("id");
            var id_sucursal = $(this).attr("alt");
            $.ajax({
            url: "../admin/Csucursales/checkNodosSucursal/"+id_nodo_sucursal+"/"+estado_nodo_sucursal,  
            type: "post",
            data: $('#editarDepartamento').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../admin/Csucursales/getNodosSucursal/"+id_sucursal);
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });//end


    });
</script>
<style>
.save{
	text-align: center;
}
.A .B{
	cursor: pointer;
}
#guardar{
	cursor: pointer;
}
#btn-emilinar{
    text-align: right;
    float: right;
    font-size: 20px;
}
#btn-emilinar:hover{
    color: black;   
}
#sucursales{
    cursor: pointer;
}
</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a id="sucursales" name="../admin/Csucursales/index"><i class='fa fa-arrow-left'></i>Regresar</a></li>
</ul>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-home'></i>Nombre Sucursal: 	
				    	
				  	</a>
				  	<a class="list-group-item save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
				  		<i class='fa fa-arrow-right'></i>
				  		<?php if(isset($sucursales[0]->nombre_sucursal)){echo $sucursales[0]->nombre_sucursal;} ?>	  		
				  	</a>				  	
				  	<a class="list-group-item active save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
				  				  		
				  	</a>
				</div>

		</div>

		<div class="col-md-4">
			<form action="#" method="POST" name="sucursal" id="updateSucursal">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-home'></i>Nodos Sucursal				    	
				  	</a>
				  	<?php
				  	if($nodos != "")
				  	{
				  		foreach ($nodos as $nodo_sucursal) 
				  		{
				  		?>
				  		<a class="list-group-item save check" id="<?php echo $nodo_sucursal->sucursal_estado_nodo; ?>" name="<?php echo $nodo_sucursal->id_nodo_sucursal; ?>" alt="<?php echo $nodo_sucursal->id_sucursal; ?>">
				  			<?php
				  			if($nodo_sucursal->sucursal_estado_nodo==1){
				  				?><i class='fa fa-check'></i> <?php
				  			}else{
				  				?><i class='fa fa-times'></i> <?php
				  			}
				  			?>
					  		
					  		<?php echo $nodo_sucursal->nombre_nodo; ?>		  		
				  		</a>
				  		<?php
				  		}
				  	}
				  	?>
				  	
				  	<a class="list-group-item active save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
				  		<i class='fa fa-refresh'></i>		  		
				  	</a>
				</div>
			</form>
			

		</div>
		<div class="col-md-5"></div>
	</div>
</div>