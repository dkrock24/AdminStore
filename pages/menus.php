<script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<?php
session_start();
 include_once("../class_db/class_menus.php");
 $menus = selectMenus();

?>

<script>
  $(document).ready(function(){
    	$("li#menu_li").click(function(){
        	var texto = $(this).text();        
            if(texto=="Buscar")        
            {                 
                $(".includ").load("pages/lista_menus.php");             
            }
    	});	

	    $("#btn-menu").click(function(){   		
	   		var nombre_menu 	= $('#nombre_menu').val();
	        var url_menu 		= $('#url_menu').val();
	        var icon_menu 		= $('#icon_menu').val();
	        var class_menu 		= $('#class_menu').val();
	        var estado_menu 	= $('#estado_menu').val();
	        var accion	= "createMenu";

	        var data = {
	        	nombre:nombre_menu,
	        	url:url_menu,
	        	icon:icon_menu,
	        	clas:class_menu,
	        	estado:estado_menu,
	        	accion:accion
	        }
	        createMenu(data);
	   });

	    function createMenu(data)
	   	{
	   		$.ajax({
	            url: "class_db/infoMenu.php",
	            type:"post",
	            data: data,

	            success: function(){     
	            	//$(".includ").load("pages/lista_menus.php");  
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });   
	   	}

	   	$("#btn-submenu").click(function(){   		
	   		var nombre_menu 	= $('#nombre_submenu').val();
	        var url_menu 		= $('#url_submenu').val();
	        var icon_menu 		= $('#icon_submenu').val();
	        var class_menu 		= $('#menuPadre').val();
	        var estado_menu 	= $('#estado_submenu').val();
	        var accion	= "createSubMenu";

	        var data = {
	        	nombre:nombre_menu,
	        	url:url_menu,
	        	icon:icon_menu,
	        	clas:class_menu,
	        	estado:estado_menu,
	        	accion:accion
	        }
	        createSubMenu(data);
	   });


	   	function createSubMenu(data)
	   	{
	   		$.ajax({
	            url: "class_db/infoMenu.php",
	            type:"post",
	            data: data,

	            success: function(){     
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
#btn-menu,#btn-submenu{
	float: right;
}
</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="active"><a href="#tab1_1" data-toggle="tab">Menus</a></li>
  <li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">Buscar</a></li>
  <li id="menu_li"><a href="#tab1_3" data-toggle="tab">Configurar</a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
	    <div class="row">
	    	<div class="col-md-6 de">
	    		<table class='table'>
	    			<tr>	    				
	    				<td colspan="2">
	    					<img src="assets/images/various/menu.png" width='50px;'>
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
	    				<td>Url del Archivo</td>
	    				<td>
	    					<input type='text' name='url_menu' id='url_menu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Icon Menu</td>
	    				<td>
	    					<input type='text' name='icon_menu' id='icon_menu'>
	    				</td>	    				
	    			</tr>
	    			<tr >
	    				<td>Class Menu</td>
	    				<td>
	    					<input type='text' name='class_menu' id='class_menu'>
	    				</td>
	    				
	    			</tr>
	    			<tr >
	    				<td>Estado Menu</td>
	    				<td>
	    					<input type='text' name='estado_menu' id='estado_menu'>
	    				</td>
	    			</tr>
	    			<tr>
	    				<td colspan="2">
	    					<a href="#" id='btn-menu' class='btn btn-success'>Guardar</a>
	    				</td>
	    			</tr>
	    		</table>
	    	</div>
	    	<div class="col-md-6 de">
	    		<table class='table'>
	    			<tr>
	    				<td colspan="2">
	    					<img src="assets/images/various/submenu.png" width='50px;'>
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
	    				<td>Menu Padre</td>
	    				<td>
	    					<select name='menuPadre' id='menuPadre'>
	    					<?php
	    						while ($row = mysql_fetch_array($menus)) {
	    							?>
	    								<option value='<?php echo $row['id_menu']; ?>'>
	    									<?php echo $row['nombre_menu']; ?>
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
	    					<input type='text' name='estado_menu' id='estado_submenu'>
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
	    	 	<div class="includ"></div>
	    	 </div>
	    	 <div class="col-md-6 de">
	    	 	<div class="submenu"></div>
	    	 </div>   
	    </div>   
	</div>
</div>