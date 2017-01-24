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
            var id = $(this).attr("name");
        	$.ajax({
            url: "../admin/Csucursales/updateNodo/"+id,  
            type: "post",
            data: $('#editarNodo').serialize(),                           

                success: function(data){                              	                	
                	$(".pages").load("../admin/Csucursales/index");
                },
                error:function(){
                }
            });
        });

        $("#btn-emilinar").click(function(){
            $(".sk-three-bounce").show();
            var id_nodo = $(this).attr("name");
            $.ajax({
            url: "../admin/Csucursales/deleteNodo/"+id_nodo,  
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
			<form action="#" method="POST" name="sucursal" id="editarNodo">
				<div class="list-group">
				 	<a href="#" class="list-group-item active">
				    	<i class='fa fa-home'></i>Editar Nodo
                        <i id="btn-emilinar" name="<?php echo $nodos[0]->id_nodo;  ?>" class="fa fa-trash-o" alt="Eliminar"></i>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Nombre :</td>
				  		<td> <input type="text" class="form-control" name="nombre" value="<?php echo $nodos[0]->nombre_nodo; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>Categoria :</td>
				  		<td> <input type="text" class="form-control" name="categoria" value="<?php echo $nodos[0]->categoria_nodo; ?>"></td>
				  	</a>
				  	<a  class="list-group-item">
				  		<td>URL :</td>
				  		<td> <input type="text" class="form-control" name="url" value="<?php echo $nodos[0]->url_nodo; ?>"></td>
				  	</a>				  	
				  	<a  class="list-group-item">
				  		<td>Estado :</td>
				  		<td> 
				  		<select name="estado" class="form-control">
				  			<?php
                        if($nodos[0]->estado_nodo == 1)
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
				  	<a class="list-group-item active save" id="guardar" name="<?php echo $nodos[0]->id_nodo; ?>" alt="Guarda">
				  		<i class='fa fa-save'></i>Guarda		  		
				  	</a>
				</div>
			</form>
			

		</div>
		<div class="col-md-5"></div>
	</div>
</div>