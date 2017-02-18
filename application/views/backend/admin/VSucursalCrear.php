<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $("a#usuarios").click(function(){        
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
        	$.ajax({
            url: "../admin/Csucursales/saveSucursal/",  
            type: "post",
            data: $('#crearSucursal').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Csucursales/index");
                },
                error:function(){
                }
            });
        });
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
</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" id="usuarios" name="../admin/Csucursales/index" data-toggle="tab"><i class='fa fa-home'></i>Lista</a></li>
    <li id="menu_li" class="B "><a href="#tab1_2" id="usuarios" name="../admin/Csucursales/index" data-toggle="tab"><i class='fa fa-user'></i>Usuario</a></li>  
</ul>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-4">
			<form action="#" method="POST" name="sucursal" id="crearSucursal">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-home'></i>Crear Nueva Sucursal
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Nombre :</td>
				  		<td> <input type="text" class="form-control" name="nombre" value=""></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Direccion :</td>
				  		<td> <input type="text" class="form-control" name="direccion" value=""></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Telefono :</td>
				  		<td> <input type="text" class="form-control" name="telefono" value=""></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Celular :</td>
				  		<td> <input type="text" class="form-control" name="celular" value=""></td>
				  	</a>
				  	<a class="list-group-item">
				  		<td>Seleccionar Pais :</td>
				  		<select name="pais" id="pais" class="form-control">
				  		<option value=""> - - -</option>
				  		<?php
				  		foreach ($paises as $paise) {
				  			?>
				  			<option value="<?php echo $paise->id_pais ?>"><?php echo $paise->nombre_pais ?></option>
				  			<?php
				  		}
				  		?>
				  		</select>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Departamento :</td>
				  		<select name="departamento" id="departamento" class="form-control">
				  					  		
				  		</select>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Zona Referencia :</td>
				  		<td> <input type="text" class="form-control" name="zona" value=""></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Cantidad de Mesas :</td>
				  		<td> <input type="number" class="form-control" name="mesas" value=""></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Estado :</td>
				  		<td> 
				  		<select name="estado" class="form-control">
				  			<option value="1">Activo</option>
				  			<option value="0">Inactivo</option>
				  		</select>
				  		</td>
				  	</a>
				  	<a class="list-group-item active save" id="guardar" alt="Guarda">
				  		<i class='fa fa-save'></i>Guarda		  		
				  	</a>
				</div>
			</form>
			

		</div>
		<div class="col-md-5"></div>
	</div>
</div>