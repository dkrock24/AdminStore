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

        $("#actualizar").click(function(){
        	$(".sk-three-bounce").show();
        	var id_departamento = $(this).attr("name");
        	$.ajax({
            url: "../admin/Cdepartamentos/saveUpdate/"+id_departamento,  
            type: "post",
            data: $('#editarDepartamento').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Cdepartamentos/index");
                	setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });//end

        $("#btn-emilinar").click(function(){
        	$(".sk-three-bounce").show();
        	var id_departamento = $(this).attr("name");
        	$.ajax({
            url: "../admin/Cdepartamentos/delete/"+id_departamento,  
            type: "post",
            data: $('#editarDepartamento').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Cdepartamentos/index");
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
#actualizar{
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

</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" id="usuarios" name="../admin/Cdepartamentos/index" data-toggle="tab"><i class='fa fa-map-marker'></i>Lista</a></li>
</ul>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-4">
			<form action="#" method="POST" name="sucursal" id="editarDepartamento">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-map-marker'></i>Actualizar Departamento
				    	<i id="btn-emilinar" name="<?php echo $departamento[0]->id_departamento;  ?>" class="fa fa-trash-o" alt="Eliminar"></i>
				  	</a>				  	

				  	<a class="list-group-item">
				  		<td>Seleccionar Pais :</td>
				  		<select name="pais" id="pais" class="form-control">
				  		<option value="<?php echo $departamento[0]->id_pais ?>"><?php echo $departamento[0]->nombre_pais ?></option>
				  		<?php
				  		foreach ($paises as $paise) {
				  			if($paise->id_pais != $departamento[0]->id_pais)
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
				  		<td>Nombre :</td>
				  		<td> <input type="text" class="form-control" name="nombre" value="<?php echo $departamento[0]->nombre_departamento ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Estado :</td>
				  		<td> 
				  		<select name="estado" class="form-control">
				  			<?php
	                        if($departamento[0]->estado_departamento == 1)
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
				  	<a class="list-group-item active save" id="actualizar" alt="actualizar" name="<?php echo $departamento[0]->id_departamento;  ?>">
				  		<i class='fa fa-refresh'></i>Actualizar		  		
				  	</a>
				</div>
			</form>
			

		</div>
		<div class="col-md-5">
			
		</div>
	</div>
</div>