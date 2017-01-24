<script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<?php
//session_start();

?>

<script>
var f = new Date();
var fechadeldia = f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds();
  $(document).ready(function(){

  	$("i#icono-submenu").click(function(){  		
  		$("#icon").val($(this).attr('class'));
  	});

    	$("li#menu_li").click(function(){
        	var texto = $(this).text();        
            if(texto=="CONFIGURAR")        
            {                 
                $(".includ").load("../../../pages/lista_HomeMenu.php");             
            }
    	});	

	    $("#btn-menu").click(function(){   

	    	var filename = $("#fleImagen").val().replace(/C:\\fakepath\\/i, '');		
	    	var formData = new FormData();
            formData.append('file', $('#fleImagen')[0].files[0]);
            formData.append('accion', 'subirImageNota');
            formData.append('nuevo_nombre', fechadeldia);
            if(filename!=""){
                $("#nombreImagen").val(fechadeldia+filename);
                subirImageNota(formData);
            }

	        $.ajax({
	            url: "../menu/ChomePages/saveHomeMenu",
	            type:"post",
	            dataType: "json",
	            data: $('#home_menu').serialize(),

	            success: function(data){    
	            	var info = "<strong>Menu Creado</strong> Correctamente...";
	            	var formulario = "#home_menu";
	            	msj(data,info,formulario);  
	            	$("#home_menu").trigger('reset');  	            	
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        }); 
	   });

	   	$("#btn-submenu").click(function(){   
	   		$.ajax({
	            url: "../menu/ChomePages/saveHomeSubMenu",
	            type:"post",
	            dataType: "json",
	            data: $('#home_submenu').serialize(),

	            success: function(data){  
	            	var info = "<strong>Sub Menu Creado</strong> Correctamente...";
	            	var formulario = "#home_submenu";
	            	msj(data,info,formulario);  
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });		
	   }); 	

	   	function msj(valor,info,formulario){
	   		if(valor==1)
	   		{
	   			$('.alertt').html(info);
	   			$(".alertt").slideDown(200, function(){
			        	$(".alertt").show();
				        setTimeout(function() {
				        	$(".alertt").slideUp(1000);
				        	$(formulario).each (function(){
  								this.reset();
							});
				        }, 2000);
			        });
	   		}
	   	}
	   	$('.alertt').hide();

	   	//Tratamiento de Imagen

	   	$('#fleImagen').change(function(){ 
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $("#preview").fadeIn("low").attr('src',URL.createObjectURL(event.target.files[0]));

                var file = this.files[0];
                var fileName = file.fileName;                
                var fileSize = file.size;                    

                sizeInMB = (fileSize / (1024*1024)).toFixed(2);
                 var fileType = this.files[0].type;
                 //alert(fileType);
        });

	   	function subirImageNota(formData)
        {
            $.ajax({
            url: "../../../class_db/saveUsuario.php",
            type:"post",
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            data: formData,

                success: function(){
                },
                error:function(){
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
#menuPadre,#estado_submenu
{
	width: 100%;
}
input{
	width: 100%;
}
#btn-menu,#btn-submenu{
	float: right;
}
.alertt{
	text-align: center;
}
</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="active"><a href="#tab1_1" data-toggle="tab">CREAR</a></li>
  <li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">CONFIGURAR</a></li>
  
</ul>
<div class="alert alert-success alertt" role="alert">
  
</div>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
	    <div class="row">	    	
	    	<div class="col-md-6 de">
	    	<form action="post" name="home_menu" id="home_menu">
	    		<table class='table'>
	    			<tr>	    				
	    				<td colspan="2">
	    					<img src="../../../assets/images/various/menu.png" width='50px;'>
	    					Creacion de Menu
	    				</td>	  
	    				
	    			</tr>
	    			<tr >
	    				<td>Nombre Menu</td>
	    				<td>
	    					<input type='text' name='nombre_menu' id='nombre_menu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Url Menu</td>
	    				<td>
	    					<input type='text' name='url_menu' id='url_menu'>
	    				</td>	    				
	    			</tr>	    			
	    			<tr >
	    				<td>Class Menu</td>
	    				<td>
	    					<input type='text' name='class_menu' id='class_menu'>
	    				</td>
	    				
	    			</tr>
	    			<tr >
	    				<td>Seccion Menu</td>
	    				<td>
	    					<select name='seccion' id='menuPadre'>
	    						<option value="superior">Superior</option>
	    						<option value="centro">Central</option>
	    						<option value="inferior">Inferior</option>
	    					</select>
	    				</td>
	    				
	    			</tr>
	    			<tr >
	    				<td>Pagina</td>
	    				<td>	 
	    					<input type='text' name='pages' id='pages'>  					
	    				</td>
	    				
	    			</tr>
	    			<tr >
	    				<td>Estado</td>
	    				<td>
	    					<select name='estado_menu' id='menuPadre'>
	    						<option value="1">Activo</option>
	    						<option value="0">Inactivo</option>	    						
	    					</select>	    					
	    				</td>
	    			</tr>
	    			<tr>
	    				<td>Imagen</td>
	    				<td>
	    					<input type="file" name="fleImagen" id="fleImagen" multiple>
	    				</td>
	    			</tr>
	    			<tr>
	    				<td>Vista Previa</td>
	    				<td>
	    					<img src="" id="preview" width='100px'>
	    					<input type="hidden" name="nombreImagen" id="nombreImagen" value="">
	    				</td>
	    			</tr>

	    			<tr>
	    				<td colspan="2">
	    					<a href="#" id='btn-menu' class='btn btn-success'>Guardar</a>
	    				</td>
	    			</tr>
	    		</table>
	    		</form>
	    	</div>
	    	<div class="col-md-6 de">
	    	<form action="post" name="home_submenu" id="home_submenu">
	    		<table class='table'>
	    			<tr>
	    				<td colspan="2">
	    					<img src="../../../assets/images/various/submenu.png" width='50px;'>
	    					Creacion de Sub-Menu
	    				</td>	   				
	    				
	    			</tr>
	    			<tr >
	    				<td>Nombre Sub-Menu</td>
	    				<td>
	    					<input type='text' name='nombre_submenu' id='nombre_submenu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Url del Archivo</td>
	    				<td>
	    					<input type='text' name='url_submenu' id='url_submenu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Titulo Sub-Menu</td>
	    				<td>
	    					<input type='text' name='icon_submenu' id='icon_submenu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Icon Sub-Menu</td>
	    				<td>
	    					<input type='text' name='icon' id='icon'>
	    					<i class="fa fa-check-square" id="selectIcon" data-toggle="modal" data-target="#icon-font"></i>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Menu Padre</td>
	    				<td>
	    					<select name='menuPadre' id='menuPadre'>
	    					<?php
	    					foreach ($menu as $menus) {
	    							?>
	    								<option value='<?php echo $menus->id_menu; ?>'>
	    									<?php echo $menus->nombre_menu; ?>
	    								</option>
	    							<?php
	    						}
	    					?>	    						
	    					</select>
	    				</td>
	    				
	    			</tr>
	    			<tr >
	    				<td>Estado Sub-Menu</td>
	    				<td>	    					
	    					<select name='estado_menu' id='estado_submenu' class="form-control">
	    						<option value="1">Activo</option>
	    						<option value="0">Inactivo</option>	    						
	    					</select>
	    				</td>
	    			</tr>
	    			<tr>
	    				<td colspan="2">
	    					<a href="#" id='btn-submenu' class='btn btn-success'>Guardar</a>
	    				</td>
	    			</tr>
	    		</table>
	    		</form>
	    	</div>
	    </div>   
	</div>

	<div class="tab-pane fade in" id="tab1_2">
	    <div class="row de">
	    	 <div class="col-md-6 de">
	    	 	<div class="includ"></div>
	    	 </div>
	    	 <div class="col-md-6 de">
	    	 	<div class="submenu"></div>
	    	 </div>   
	    </div>  
	    <hr> 
	    <div class="row de">
	    	<div class="col-md-12 de">
	    	 	<div class="menu_edi"></div>
	    	 </div>
	    </div>
	</div>
</div>

<style type="text/css">
        .unoDemo{
        	margin-top: 20px;
        	width: 50%;        
    	}

    #icono-submenu{
	    color: #5B5B5B;    
	    font-size: 1.2em;
	    border:0px solid black;	    
	    position: relative;
	    display: inline-block;   
	    padding-top: 2px; 
	}
	.icono1{
	    color: #5B5B5B;    
	    font-size: 1.2em;
	    border:0px solid black;	    
	    position: relative;
	    display: inline-block;   
	    
	}
 	
 	#icono-submenu:hover{
 		color:black;
 		background-color: #319db5;
    };

</style>

<div class="modal fade" id="icon-font" tabindex="-1" width="100%" role="dialog" aria-hidden="true">
    <div class="modal-dialog unoDemo">
        <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-file"></i><b>Seleccionar</b> Iconos</h4>
                </div>
                <form action="#" id="notas" method="post">
                <div class="modal-body">
                    <div class="row tab">
                    <?php
                    foreach ($icono as $iconos) {
                    	?>                    	
                            <span class="icono1">
                            	<i id="icono-submenu" class="<?php echo $iconos->class; ?>">
                            		<?php echo $iconos->nombre; ?><br>
                            	</i>
                            </span>    
                                             
                    	<?php
                    }
                    ?>                    	
                                                
                    </div>
            	</div>              
            </form>        
        </div>
    </div>
</div>