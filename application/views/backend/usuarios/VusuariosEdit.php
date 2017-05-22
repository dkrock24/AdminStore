 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <!--
    <script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    -->
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="../../../assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="../../../assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="../../../assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="../../../assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="../../../assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="../../../assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="../../../assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="../../../assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
    <link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">

<?php





?>

<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
    $("#update_user").click(function()
    {
        $.ajax({
	        url: "../usuarios/Cusuarios/update_user",
	        type:"post",
	        data: $("#otro").serialize(),
	        
	        success: function(){	        

	        	$(".pages").load("../usuarios/Cusuarios/userAdmin");  
	        },
	        error:function(){
	            alert("failure");
	        }
	    });
    });

    $("#delete_user").click(function()    
    {       
    	var id = $(this).attr("name");
    	alert(id);
      $.ajax({
            url: "../usuarios/Cusuarios/eliminar_usuario/"+id,
            type:"post",
            success: function(){     
              $(".includ").load("backend/usuarios/Cusuarios/index");      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });   
    });


  });
</script>

<style>
  .table-dynamic{width: 100%;}
  .form-inline .form-control {
    width:85%;
    font-weight: 10px;
    padding: 4px;
  }

  .input__label-content{
    margin-top: -20px;
  }
  .line{
    
  }
  #anio{
    width: 100%;
  }
  .avatar{
    padding: 10px;
    display: inline-block;
  }
  .letra{
    font-size:12px;
  }
  #usuario{
    width: 100%;
  }
  #delete_user{
  	text-align: right;
  	float: right;
  }





</style>



<form action="../usuarios/Cusuarios/update_user" id="otro" name="otro">
	<input type="hidden" value="<?php echo $usuario[0]->id_usuario; ?>" name="id_usuario">
  <div class="tab-content">
    
      <div class="row">
        <div class="col-md-12">
          <div class="row line">
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="primer_nombre" required name="nombres" value="<?php echo $usuario[0]->nombres; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombres</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="primer_apellido" name="apellidos" required value="<?php echo $usuario[0]->apellidos; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Apellidos</span>
                      </label>
                  </span>
                </div>
                
          </div> 
          


          <div class="row line">
           <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="telefono" required name="telefono" value="<?php echo $usuario[0]->telefono; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Teléfono Fijo</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="celular" name="celular" value="<?php echo $usuario[0]->celular; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Teléfono Móvil</span>
                      </label>
                  </span>
                </div>
          </div> 

          <div class="row line">
             <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="direccion"  name="direccion" value="<?php echo $usuario[0]->direccion; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Dirección</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" name="dui" type="text" id="dui" required value="<?php echo $usuario[0]->dui; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">DUI</span>
                      </label>
                  </span>
                </div>
          </div>

          <div class="row">
            
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="usuario" required name="usuario" value="<?php echo $usuario[0]->usuario; ?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Usuario</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="password" required name="password" readonly="0" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Password</span>
                      </label>
                  </span>
                </div>
                  
          </div>

          <div class="row">
               
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="date" id="fecha_nacimiento" name="fecha" value="<?php echo $usuario[0]->fecha; ?>"  />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Fecha Nacimiento</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Genero</label><br><br>
                        <select class="form-control form-grey" name="genero" id="genero" data-style="white">
                        <?php
                        if($usuario[0]->genero == 'M')
                        {
                        	?>
                        	<option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        	<?php
                        }
                        else
                        {
                        	?>
                        	<option value="F">Femenino</option>
                        	<option value="M">Masculino</option>                            
                        	<?php
                        }
                        ?>
                            
                        </select>
                    </div>
                </div>            
          </div>

          <div class="row">
            <div class="col-md-12">      
              <div class="col-md-6">
                   <div class="form-group">
                        <label>Cargo</label><br><br>
                        <select class="form-control form-grey" name="cargo" id="cargo" data-style="white" >
                        <?php
                        foreach ($cargos as $value) {
                        	if($usuario[0]->cargo == $value->id_cargo){
                        		?>
                        		<option value="<?php echo $value->id_cargo ?>"><?php echo $value->nombre_cargo?>
                          		</option>
                        		<?php
                        	}
                          	?>
                        <?php
                        }
                        foreach ($cargos as $value) {
                        	if($usuario[0]->cargo != $value->id_cargo){
                        		?>
                        		<option value="<?php echo $value->id_cargo ?>"><?php echo $value->nombre_cargo?>
                          		</option>
                        		<?php
                        	}
                          	?>
                        <?php
                        }
                        ?>                      
                        </select>
                    </div> 
                </div>
              <div class="col-md-6">
                   <div class="form-group">
                    	<label>Rol</label><br><br>
                      	<select class="form-control form-grey" name="rol" id="rol" data-style="white">
                      	<?php
                      	foreach ($roles as $value) {
                        	if($usuario[0]->rol == $value->id_rol){
                        		?>
                        		<option value="<?php echo $value->id_rol ?>">
	                            <?php echo $value->nombre_rol ?>
	                          </option>
                        		<?php
                        	}       
	                    }
	                    foreach ($roles as $value) {
                        	if($usuario[0]->rol != $value->id_rol){
                        		?>
                        		<option value="<?php echo $value->id_rol ?>">
	                            <?php echo $value->nombre_rol ?>
	                          </option>
                        		<?php
                        	}       
	                    }
                      ?>  
                      </select>
                    </div>
                </div>            
            </div>  
          </div>

          
          <input type="button" id="update_user"  class="btn btn-primary" value="Guardar">
          <input type="button" id="delete_user"  class="btn btn-danger" name="<?php echo $usuario[0]->id_usuario; ?>" value="Borrar">
        </div>
      </div>
  </div>
</form>

