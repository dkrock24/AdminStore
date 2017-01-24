
<script>
$(document).ready(function(){
        //var id = $(this).attr('id');       
       // $(".submenu").load("pages/lista_submenus.php?id="+id);             
            
	var id;
   	$(".iconoss").click(function(){   		
   		id = $(this).attr('id');  		   		
   		var accion = 'submenu';
   		var data = { id:id,accion:accion }     
   		infoMenu(data);
   	});

   	$('.iconos1').click(function(){
   		id = $(this).attr('id');  
   		var estado = $(this).attr('name');   		
   		var accion = 'activeSubMenu';   		
   		var data = { id:id,accion:accion,estado:estado }       		

   		activeSubMenu(data);
   	});

   	function activeSubMenu(data)
   {   		
   		$.ajax({
            url: "../../../class_db/infoMenu.php",
            type:"post",
            data: data,
            dataType: 'json',
            cache: false,

            success: function(result){             	
            	//$(".includ").load("pages/lista_menus.php"); 
            	var id_menu = result[0];             	
            	$(".submenu").load("../../../pages/lista_submenu.php?id="+id_menu);  
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });   
   }

   	$("#saveChangeSubmenu").click(function(){   
   		var nombre 	= $('#nombre2').val();
        var url 	= $('#url2').val();
        var icon 	= $('#icon2').val();
        var accion	= "saveChangeSubmenu";

        var data = {
        	nombre:nombre,
        	url:url,
        	icon:icon,
        	id:id,
        	accion:accion
        }
        saveChangeSubmenu(data,id);
   });

   	function saveChangeSubmenu(data)
   	{
   		
   		$.ajax({
            url: "../../../class_db/infoMenu.php",
            type:"post",
            data: data,
            dataType: 'json',
            cache: false,

            success: function(result){ 

            	var id_menu = result[0];              	
            	$(".submenu").load("../../../pages/lista_submenu.php?id="+id_menu); 
            	return false; 

            },
            error:function(){
                //alert("Error.. Submenu");
            }
        });   	
   	}

    $(".buton-trash").click(function()
  {
    var nameMenu = $(this).attr('name'); 
    $(".menu_eliminar").text(nameMenu);
    $("#idMenuEliminar").val($(this).attr('id'));
  });

    $('#eliminarSubMenu').click(function(){
      id = $("#idMenuEliminar").val();  
         
      var accion = 'deleteSubMenuSistema';  
      var data = { id:id,accion:accion }           
      activemenu(data);
    });

    function activemenu(data)
    {
        var id_padre = $("id_padre1").attr("id");
      $.ajax({
            url: "../../../class_db/infoMenu.php",
            type:"post",
            data: data,

            success: function(){     
              //$(".includ").load("../../../pages/lista_menus.php");                
              $(".submenu").load("../../../pages/lista_submenu.php?id="+id_padre);    
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });   
   }

   	function infoMenu(data)
   	{
   		$.ajax({
            url: "../../../class_db/infoMenu.php",
            type:"post",
            data: data,
            dataType: 'json',
            cache: false,

            success: function(result){            	
        		var titulo 	= result[1];
        		var url 	= result[2];
        		var nombre_menu = result['nombre_menu'];
        		var id_menu = result['id_menu'];

        		$("#icon2 option").each(function(){
        			//alert($(this).text());
        			if(nombre_menu == $(this).text())
        			{
        				//alert($(this).text());   
        				//$("#icon2 option[value='"+$(this).attr('value')+"']").remove();   
        				//$("select#icon2 option[value='"+$(this).attr('value')+"']").remove(); 
        				$("#icon2").find("option[value='"+$(this).attr('value')+"']").remove();  				
        				$('#icon2').prepend("<option value='"+id_menu+"' selected>"+nombre_menu+"</option>");        				
        				return false;
        			}
   					//alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'))
				});
        		
        		$('#nombre2').val(titulo);
        		$('#url2').val(url);   
        		
                //$(".perfil").load("pages/avatar.php");
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });   		
   }
});


</script>

<?php
//session_start();
include_once("../class_db/class_menus.php");
$id = $_GET['id'];
$submenus = selectSubMenus($id);
$menuPadre = menuPadre($id);
$menusPadres = selectMenus();



?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
	.menu2{
		
		border:0px solid black;
		padding: 10px;
		margin-bottom: 2px;
	}
	.iconoss{
		display: inline-block;
		float: right;
		margin-left: 10px;
	}
	.submenu_titulo{
		padding: 0px;
		margin-bottom: 2px;
		height: 10px;
	}

</style>
<table>

<tr>
	<div class="row line menu bg-dark">
		<div class="col-md-12">
		<?php
			while($menu = mysqli_fetch_array($menuPadre))
			{
				echo $menu['nombre_menu'];
			}
		?>
	    </div>
	</div>
</tr>

<?php
while ($row = mysqli_fetch_array($submenus)) {
	?>
	<tr>	
		<div class="row line">
	    	 <div class="col-md-9">
	    	 	<div class="menu2" id='<?php echo $row['id_submenu']; ?>'>
					
					<?php echo $row['nombre_submenu']; ?>
				</div>
	    	 </div>
	    	 <div class="col-md-3 opciones">
	    	 	<div class='opciones'>

	    	 		<i class="fa fa-edit fa-5 iconoss" data-toggle="modal" data-target="#colored-header2" id='<?php echo $row['id_submenu']; ?>'>	    	 			
	    	 		</i>

	    	 		<?php 
	    	 			if($row['estado_submen']==1)
	    	 			{
	    	 				?><i class="fa fa-dot-circle-o iconos1" id='<?php echo $row['id_submenu']; ?>' name='<?php echo $row["estado_submen"] ?>'></i><?php
	    	 			}
	    	 			else
	    	 			{
	    	 				?><i class="fa fa-circle-o iconos1" id='<?php echo $row['id_submenu']; ?>' name='<?php echo $row["estado_submen"] ?>'></i><?php
	    	 			}	

	    	 		 ?>  
             <i class="fa fa-trash-o buton-trash" data-toggle="modal" data-target="#eliminar-submenu"  id='<?php echo $row['id_submenu']; ?>' name='<?php echo $row["nombre_submenu"] ?>'>
            </i> 	 		
            <input type="hidden" value="" name="id_padre1" id="<?php echo $row["id_menu"] ?>">
	    	 	</div>
	    	 </div>
	 </div>
	</tr>	
	<?php
}
?>

</table>

          <!-- BEGIN MODALS -->
          <div class="modal fade" id="colored-header2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Editar</strong> Menus Principales2</h4>
                </div>
                <div class="modal-body">
                  <div class="row tab">
                    <div class="col-md-4 titulos">
                      <span>Nombre SubMenu</span>                       
                    </div>
                    <div class="col-md-8">
                      <input type="text" id="nombre2" name="nombre2">
                    </div>
                  </div>
                  <div class="row tab">
                    <div class="col-md-4 titulos">
                      <span>URL SubMenu</span>                        
                    </div>
                    <div class="col-md-8">
                      <input type="text" id="url2" name="url2">
                    </div>
                  </div>
                  <div class="row tab">
                    <div class="col-md-4 titulos">
                      <span>Menu Padre</span>                       
                    </div>
                    <div class="col-md-8">                      
                      <select name='menuPrincipal' id='icon2'>
                        <?php
                        while ($row = mysqli_fetch_array($menusPadres)) {
                          ?>
                          <option value='<?php echo $row['id_menu']; ?>'><?php echo $row['nombre_menu']; ?></option>
                          <?php    
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" id='cancelar' data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='saveChangeSubmenu' data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->

          <!-- BEGIN MODALS -->
          <div class="modal fade" id="eliminar-submenu" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Eliminar</strong> Sub Menu </h4>
                </div>
                <div class="modal-body">
                <b>Desea Eliminar el Menu :</b> <span class="menu_eliminar"></span>
                <input type="hidden" name="idMenuEliminar" id="idMenuEliminar" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='eliminarSubMenu' data-dismiss="modal">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->




