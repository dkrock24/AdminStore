<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $("a#sucursales").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
            $(".A").removeClass("active");
            $(".B").addClass("active");
        });

        //Mostrar Departamentos mediante el pais
        $("#pais").change(function(){
        	$("#departamento").empty();
        	var id = $(this).val();
        	$.ajax({
            url: "../admin/Csucursales/getDepartamento/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){                              	                	
                	$.each(JSON.parse(data), function(i, item) {                		
                		$("#departamento").append('<option value='+item.id_departamento+'>'+item.nombre_departamento+'</option>');
					});
                },
                error:function(){
                }
            });
        });

        $("#guardar").click(function(){
        	var id_sucursal = $(this).attr("name");
        	$.ajax({
            url: "../admin/Csucursales/saveUpdate/"+id_sucursal,  
            type: "post",
            data: $('#updateSucursal').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Csucursales/index");
                },
                error:function(){
                }
            });
        });

        $("#btn-emilinar").click(function(){
            $(".sk-three-bounce").show();
            var id_sucursal = $(this).attr("name");
            $.ajax({
            url: "../admin/Csucursales/delete/"+id_sucursal,  
            type: "post",
            data: $('#editarDepartamento').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../admin/Csucursales/index");
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
    <li id="menu_li" class="A active"><a href="#tab1_1" id="sucursales" name="../admin/Csucursales/index" data-toggle="tab"><i class='fa fa-arrow-left'></i>Regresar</a></li>   
</ul>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-4">
			<form action="#" method="POST" name="sucursal" id="updateSucursal">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-home'></i>Actualizar Sucursal
				    	<i id="btn-emilinar" name="<?php echo $sucursales[0]->id_sucursal;  ?>" class="fa fa-trash-o" alt="Eliminar"></i>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Nombre :</td>
				  		<td> <input type="text" class="form-control" name="nombre" value="<?php echo $sucursales[0]->nombre_sucursal; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Direccion :</td>
				  		<td> <input type="text" class="form-control" name="direccion" value="<?php echo $sucursales[0]->direccion; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Telefono :</td>
				  		<td> <input type="text" class="form-control" name="telefono" value="<?php echo $sucursales[0]->telefono; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Celular :</td>
				  		<td> <input type="text" class="form-control" name="celular" value="<?php echo $sucursales[0]->celular; ?>"></td>
				  	</a>
				  	<a class="list-group-item">
				  		<td>Seleccionar Pais :</td>
				  		<select name="pais" id="pais" class="form-control">
				  		<option value="<?php echo $sucursales[0]->id_pais; ?>">
				  			<?php echo $sucursales[0]->nombre_pais; ?>
				  		</option>
				  		<?php				  		
					  		foreach ($paises as $paise) 
					  		{
					  			if($paise->id_pais != $sucursales[0]->id_pais)
				  				{
					  			?>
					  			<option value="<?php echo $paise->id_pais ?>"><?php echo $paise->nombre_pais ?></option>
					  			<?php
					  			}
				  			}
				  		?>
				  		</select>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Departamento :</td>
				  		<select name="departamento" id="departamento" class="form-control">
				  			<option value="<?php echo $sucursales[0]->id_departamento; ?>">
				  				<?php echo $sucursales[0]->nombre_departamento; ?>
				  			</option>	  		
				  		</select>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Zona Referencia :</td>
				  		<td> <input type="text" class="form-control" name="zona" value="<?php echo $sucursales[0]->referencia_zona; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Cantidad de Mesas :</td>
				  		<td> <input type="number" class="form-control" name="mesas" value="<?php echo $sucursales[0]->numero_mesas; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Estado :</td>
				  		<td> 
				  		<select name="estado" class="form-control">
				  		<?php
				  		if($sucursales[0]->estado == 1)
				  		{
				  			?>
				  			<option value="1">Activo</option>
				  			<option value="0">Inactivo</option>
				  			<?php
				  		}
				  		else
				  		{
				  			?>
				  			<option value="0">Inactivo</option>
				  			<option value="1">Activo</option>				  			
				  			<?php
				  		}
				  		?>				  			
				  		</select>
				  		</td>
				  	</a>
				  	<a class="list-group-item active save" id="guardar" name="<?php echo $sucursales[0]->id_sucursal; ?>" alt="Actualizar">
				  		<i class='fa fa-refresh'></i>Actualizar		  		
				  	</a>
				</div>
			</form>
			

		</div>
		<div class="col-md-5"></div>
	</div>
</div>