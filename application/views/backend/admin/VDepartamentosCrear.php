<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $("a#usuarios").click(function(){       
        	$(".sk-three-bounce").show(); 
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
            $(".A").removeClass("active");
            $(".B").addClass("active");

            setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000); 
        });

        $("#guardar").click(function(){
        	$(".sk-three-bounce").show();
        	$.ajax({
            url: "../admin/Cdepartamentos/saveDepartamento/",  
            type: "post",
            data: $('#crearSucursal').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Cdepartamentos/index");
                	setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
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
#usuarios{
	cursor: pointer;
}
</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" id="usuarios" name="../admin/Cdepartamentos/index" data-toggle="tab"><i class='fa fa-map-marker'></i>Lista</a></li>
</ul>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-4">
			<form action="#" method="POST" name="sucursal" id="crearSucursal">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-map-marker'></i>Crear Nuevo Departamento
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
				  		<td>Nombre :</td>
				  		<td> <input type="text" class="form-control" name="nombre" value=""></td>
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