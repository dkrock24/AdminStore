
<?php
session_start();
 //include_once("../class_db/class_menus.php");
 
?>

<script>
  $(document).ready(function(){
  		$(".msg1").hide();
  		$(".msg2").hide();
  		$(".msg").hide();

    	$("li#menu_li").click(function(){
        	var texto = $(this).text();        
            if(texto=="Buscar")        
            {                 
                //$(".includ").load("pages/lista_accesos.php");             
            }
    	});	

    	$("#roles").change(function(){
        	var rol = $(this).val();
        	$(".includ").load("../../../pages/lista_accesos.php?id="+rol);
    	});

    	$(".delete").click(function(){
    		var id_rol = $(this).attr("id");
    		var name = $(this).attr("name");
    		$('.msj').html("<b>"+name+"</b>");

    		$("#deleteRol").click(function(){
    			var accion = "deleteRol";
    			var data = {
    				id_rol:id_rol,
    				accion:accion
    			}

    			deleteRol(data);
    		});
    	});

    	$(".delete2").click(function(){
    		var id_cargo = $(this).attr("id");
    		var name = $(this).attr("name");
    		$('.msj').html("<b>"+name+"</b>");

    		$("#deleteCargo").click(function(){
    			var accion = "deleteCargo";
    			var data = {
    				id_cargo:id_cargo,
    				accion:accion
    			}

    			deleteCargo(data);
    		});
    	});

    	function deleteCargo(data)
	   	{
	   		$.ajax({
	            url: "../acceso/Cacceso/deleteCargo",
	            type:"post",
	            data: data,
	            dataType: 'text',
            	cache: false,

	            success: function(result){  
	            	//if(result[0]==1){	            		
	            		alert("Se Elimino El Cargo ..");
	            	          	
	            },
	            error:function(){	            	
	                
	            }
	        });   
	   	}

    	function deleteRol(data)
	   	{
	   		$.ajax({
	            url: "../acceso/Cacceso/deleteRol",
	            type:"post",
	            data: data,
	            dataType: 'json',
            	cache: false,

	            success: function(result){  
	            	//if(result[0]==1){
	            		alert("Se Elimino El Rol ..");

	            	
	            	//$(".pages").load("pages/p_accesos.php");  
	            },
	            error:function(){	            	
	                //alert("Error.. No se Elimino El Rol. Existen Usuarios Asociados a El ");
	            }
	        });   
	   	}

	   	$(".editar").click(function(){
    		var id_rol = $(this).attr("id");
    		var name = $(this).attr("name");

    		$("#nombre").val(name);

    		//$('.msj').html("<b>"+name+"</b>");

    		$("#updateRol").click(function(){
    			var accion = "updateRol";
    			name = $("#nombre").val();
    			var data = {
    				id_rol:id_rol,
    				accion:accion,
    				nombre:name
    			}
    			updateRol(data);
    		});
    	});

    	$(".editar2").click(function(){
    		var id_cargo = $(this).attr("id");
    		var name = $(this).attr("name");

    		$("#cargo").val(name);

    		//$('.msj').html("<b>"+name+"</b>");

    		$("#updateCargo").click(function(){
    			var accion = "updateCargo";
    			name = $("#cargo").val();
    			var data = {
    				id_cargo:id_cargo,
    				accion:accion,
    				nombre:name
    			}
    			updateCargo(data);
    		});
    	});

    	function updateCargo(data)
	   	{
	   		$.ajax({
	            url: "../acceso/Cacceso/updateCargo",
	            type:"post",
	            data: data,
	            success: function(){  
	            	//$(".msg").show(); 	            	
	            	//$(".pages").load("pages/p_accesos.php");  
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });   
	   	}

    	function updateRol(data)
	   	{
	   		$.ajax({
	            url: "../acceso/Cacceso/updateRol",
	            type:"post",
	            data: data,
	            success: function(){  	            	
	            	
	            	$(".msg").show();
				        setTimeout(function() {
				        	$(".msg").slideUp(1000);
				        }, 3000);	            	
	            	//$(".pages").load("pages/p_accesos.php");  
	            	
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });   
	   	}

	    $("#btn-rol").click(function(){   		
	   		var nombre_rol 	= $('#nombre_menu').val();
	        var estado_rol 		= $('#estado_rol').val();
	        var accion	= "createRol";

	        var data = {
	        	nombre:nombre_rol,
	        	estado:estado_rol,
	        	accion:accion
	        }
	        if(nombre_rol != "")
	        {
	        	createRol(data);
	        }
	   	});

	    function createRol(data)
	   	{
	   		$.ajax({
	            url: "../../../class_db/infoMenu.php",
	            type:"post",
	            data: data,
	            success: function(){     
	            	
	            	$(".msg1").show();
				        setTimeout(function() {
				        	$(".msg1").slideUp(1000);
				        }, 3000);
	            	//$(".includ").load("pages/lista_menus.php");  
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });   
	   	}

	   	$("#btn-submenu").click(function(){   		
	   		var nombre_cargo 	=  $('#nombre_submenu').val();
	        var estado_cargo 	= $('#estado_cargo').val();
	        var accion	= "createCargo";

	        var data = {
	        	nombre:nombre_cargo,
	        	estado:estado_cargo,
	        	accion:accion
	        }
	        createCargo(data);
	   });

	   	function createCargo(data)
	   	{
	   		$.ajax({
	            url: "../../../class_db/infoMenu.php",
	            type:"post",
	            data: data,
	            success: function(){  
	            	$(".msg2").show();
				        setTimeout(function() {
				        	$(".msg2").slideUp(1000);
				        }, 3000);
	            	
	            	//$(".includ").load("pages/lista_menus.php");  
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });   
	   	}
	   	
    });
  </script>

<style>
	.de{
		border:0px solid black;
	}
	.fill{
		padding: 10px;
		top: 10px;

	}
	#menuPadre
	{
		width: 100%;
	}
	input{
		width: 100%;
	}
	#btn-rol,#btn-submenu{
		float: right;
	}
</style>
<style>
	.menu{
		
		border:0px solid black;
		padding: 10px;
		margin-bottom: 2px;
	}
	.msg1, .msg2{
		background: #337ab7;
		color:white;
	}

	.opciones{

		border:0px solid black;
		float: right;
		padding: 5px;
		display: inline-block;

	}
	.iconos{
		display: inline-block;
		float: right;
		margin-left: 10px;
	}

	.fa{
		font-size: 20px;
	}
	.line:hover{
		background: grey;
		color: white;
		cursor: pointer;
	}

	.titulos{
		text-align: right;
	}
	.tab{
		padding: 5px;
	}
	.delete{
		padding-right: 50px;
	}

</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="active" ><a href="#tab1_3" data-toggle="tab"><i class='fa fa-navicon'></i>Menus</a></li>
  <li id="menu_li"><a href="#tab1_2" data-toggle="tab"><i class='fa fa-search'></i>Buscar</a></li>
  <li id="menu_li"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-cogs'></i>Administrar</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade  in" id="tab1_1">
    	<div class="row alert-primary msg">
        	<div class="col-md-12">        	
        		<div class="msg" ><h3>Rol Actualizado</h3></div>
        	</div>
    	</div>
    	<div class="row alert-primary msg1">
        	<div class="col-md-12">        	
        		<div class="msg1" ><h3>Se Ingrego El Nuevo Rol Al Sistema....</h3></div>
        	</div>
    	</div>

	    <div class="row alert-primary msg2">
	        <div class="col-md-12">        	
	        	<div class="msg2" ><h3>Se Ingreso El Nuevo Cargo.......</h3></div>
	        </div>
	    </div>

	    <div class="row">
	    	<div class="col-md-6 de">
	    		<table class='table'>
	    			<tr>	    				
	    				<td colspan="2">
	    					<img src="../../../assets/images/various/menu.png" width='50px;'>
	    					Creacion de Roles
	    				</td>	  
	    				
	    			</tr>
	    			<tr >
	    				<td>Nombre del Rol</td>
	    				<td>
	    					<input type='text' name='nombre_menu' id='nombre_menu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Estado Del Rol</td>
	    				<td>
	    					<select name="estado" id="estado_rol">
	    					<option value='1'>Activo</option>
	    					<option value='0'>Inactivo</option>
	    					</select>
	    				</td>	    				
	    			</tr>
	    			
	    			<tr>
	    				
	    				<td colspan="2">
	    					<a href="#" id='btn-rol' class='btn btn-success'>Guardar</a>
	    				</td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-md-6 de">
	    		<table class='table'>
	    			<tr>
	    				<td colspan="2">
	    					<img src="../../../assets/images/various/submenu.png" width='50px;'>
	    					Creacion de Cargos
	    				</td>	   				
	    				
	    			</tr>
	    			<tr >
	    				<td>Nombre del Cargo</td>
	    				<td>
	    					<input type='text' name='nombre_submenu' id='nombre_submenu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Url del Archivo</td>
	    				<td>
	    					<select name="estado" id="estado_cargo">
	    					<option value='1'>Activo</option>
	    					<option value='0'>Inactivo</option>
	    					</select>
	    				</td>	     				
	    			</tr>
	    			<tr>
	    				
	    				<td colspan="2">
	    					<a href="#" id='btn-submenu' class='btn btn-success'>Guardar</a>
	    				</td>
	    			</tr>
	    		</table>
	    	</div>
	    </div>   
	</div>

	<div class="tab-pane fade in" id="tab1_2">
	    <div class="row de">
	    	 <div class="col-md-6 de">
				<div class="row">
				    <div class="col-md-12 ">
				    	Seleccionar Rol 
				    	<select name="roles" id="roles" class="form-control form-white" data-style="white">
					    <?php
					    foreach ($roles as $rol) {					    
					    ?>
					        <option value="<?php echo $rol->id_rol; ?>">
					        	<?php echo $rol->nombre_rol; ?>					        		
					        </option>        
				        <?php
				        }
				        ?>
				   		</select>
				  	</div>
				</div>

	    	 	<div class="includ"></div>
	    	 </div>
	    	 <div class="col-md-6 de">
	    	 	<div class="submenu"></div>
	    	 </div>   
	    </div>   
	</div>

	<div class="tab-pane fade active in" id="tab1_3">
		<div class='col-md-6'>
			<table>
				<tr>
					<div class="row line menu bg-dark">
						<div class="col-md-12 ">
							Configuracion de lo roles
					    </div>
					</div>
				</tr>
					<?php
					foreach ($roles as  $rol) {
						?>
						<tr>
						 <div class="row line">
						   	<div class="col-md-9">
						     	<div class="menu" id='<?php echo $rol->id_rol; ?>'>				
										<?php echo $rol->nombre_rol; ?>								
								</div>
						    </div>
						    <div class="col-md-3 opciones">
						     	<div class='opciones'>	    	 		   	 				
						     		<i class="fa fa-trash delete" data-toggle="modal" data-target="#colored-header2"  id='<?php echo $rol->id_rol; ?>' name='<?php echo $rol->nombre_rol; ?>' ></i>
	  
						     		<i class="fa fa-edit fa-5 editar" data-toggle="modal" data-target="#colored-header" id='<?php echo $rol->id_rol; ?>' name='<?php echo $rol->nombre_rol; ?>'></i>
						     	</div>
						     </div>
						 </div>
							
						</tr>
						
						<?php
					}
					?>
			</table>
		</div>
		<div class='col-md-6'>
			<table>
				<tr>
					<div class="row line menu bg-dark">
						<div class="col-md-12 ">
							Configuracion de Cargos
					    </div>
					</div>
				</tr>
					<?php
					foreach ($cargos as $cargo) {
						?>
						<tr>
						 <div class="row line">
						    	 <div class="col-md-9">
						    	 	<div class="menu" id='<?php echo $cargo->id_cargo; ?>'>
										<?php echo $cargo->nombre_cargo; ?>										
									</div>
						    	 </div>
						    	 <div class="col-md-3 opciones">
						    	 	<div class='opciones'>	    	 		
						    	 		<i class="fa fa-trash delete2" data-toggle="modal" data-target="#colored-header3"  id='<?php echo $cargo->id_cargo; ?>' name='<?php echo $cargo->nombre_cargo;?>' ></i>
						    	 		<i class="fa fa-edit fa-5 editar2" data-toggle="modal" data-target="#colored-header4" id='<?php echo $cargo->id_cargo; ?>' name='<?php echo $cargo->nombre_cargo; ?>'></i>	    	 				 								    	 			    	 		
						    	 	</div>
						    	 </div>
						 </div>
							
						</tr>
						
						<?php
					}
					?>
			</table>
		</div>
	</div>
</div>


<!-- BEGIN MODALS -->
          <div class="modal fade" id="colored-header" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Editar</strong>  Los Roles</h4>
                </div>
                <div class="modal-body">
                	<div class="row tab">
                		<div class="col-md-4 titulos">
                			
                		</div>
                		<div class="col-md-8">
                			Desea Actualizar el nombre del Rol ...
                		</div>
                		<br>
                		<br>
                		<div class="col-md-4 titulos">
                			<span>Nombre</span>	                			
                		</div>
                		<div class="col-md-8">
                			<input type="text" id="nombre" name="nombre">
                		</div>
                	</div>                	
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='updateRol' data-dismiss="modal">Cambiar Nombre</button>
                </div>
              </div>
            </div>
          </div>
<!-- END MODALS -->

<!-- BEGIN MODALS -->
          <div class="modal fade" id="colored-header2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Eliminar</strong> Roles</h4>
                </div>
                <div class="modal-body">                	
                	<div class="row tab">
                		<div class="col-md-3 titulos">
                			               			
                		</div>
                		<div class="col-md-9">
                			Desea Eliminar El Rol <span class='msj'></span>?
                			<p>Importante. Al eliminar un Rol. podria ser que <br>
                				que deje usuarios sin rol. Verificar antes que <br>
                				el Rol ya no se usa....
                			</p>
                		</div>

                	</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='deleteRol' data-dismiss="modal">Eliminar Rol</button>
                </div>
              </div>
            </div>
          </div>
<!-- END MODALS -->

<!-- BEGIN MODALS -->
          <div class="modal fade" id="colored-header3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Eliminar</strong> Cargo</h4>
                </div>
                <div class="modal-body">                	
                	<div class="row tab">
                		<div class="col-md-3 titulos">
                		</div>
                		<div class="col-md-9">
                			Desea Eliminar El Cargo <span class='msj'></span>?
                			<p>Importante. Al eliminar un Cargo. podria ser que <br>
                				que deje usuarios sin Cargo. Verificar antes que <br>
                				el Cargo ya no se usa....
                			</p>
                		</div>
                	</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='deleteCargo' data-dismiss="modal">Eliminar Cargo</button>
                </div>
              </div>
            </div>
          </div>
<!-- END MODALS -->

<!-- BEGIN MODALS -->
          <div class="modal fade" id="colored-header4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Editar</strong>  Cargos</h4>
                </div>
                <div class="modal-body">
                	<div class="row tab">
                		<div class="col-md-4 titulos">
                			
                		</div>
                		<div class="col-md-8">
                			Desea Actualizar el nombre del Cargo ...
                		</div>
                		<br>
                		<br>
                		<div class="col-md-4 titulos">
                			<span>Nombre</span>	                			
                		</div>
                		<div class="col-md-8">
                			<input type="text" id="cargo" name="cargo">
                		</div>
                	</div>                	
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='updateCargo' data-dismiss="modal">Cambiar Nombre</button>
                </div>
              </div>
            </div>
          </div>
<!-- END MODALS -->