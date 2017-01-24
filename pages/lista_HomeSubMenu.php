
<script>
var f = new Date();
var fechadeldia = f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds();
$(document).ready(function(){
        //var id = $(this).attr('id');       
       // $(".submenu").load("pages/lista_submenus.php?id="+id);    

       
       // Edita los menus del frontend
      $("i.sub").click(function(){
          var id_sub_menu = $(this).attr("id");  
          var id_u = $(".id").text(); 

          var element = $(".sub").css("color","black");
          var element = $(this).css("color","#9AC835");
          //$(element).css("backend","red");
          $(".menu_edi").load("../../backend/menu/ChomePages/loadSubMenu/"+id_sub_menu+"/"+0);             
      });


  function msj(info){
    $('.alertt').html(info);
    $(".alertt").slideDown(200, function(){
      $(".alertt").show();
        setTimeout(function() {
          $(".alertt").slideUp(1000);
        }, 2000);
      });
  }    

  $(".buton-trash1").click(function()
  {
    var nameMenu = $(this).attr('name'); 
    $(".menu_eliminar").text(nameMenu);
    $("#idSubMenuEliminar").val($(this).attr('id'));
  });   

  $('#eliminarSubMenu').click(function(){
      id = $("#idSubMenuEliminar").val();  
      var idPadre = $("#idPadre").val();  

         
      var accion = 'deleteSubMenu';  
      var data = { id:id,accion:accion }           
      deletesubmenu(data,idPadre);
    });  

  function deletesubmenu(data,idPadre)
   {
      $.ajax({
            url: "../../../class_db/infoMenu.php",
            type:"post",
            data: data,

            success: function(){                   
              $(".submenu").load("../../../pages/lista_HomeSubMenu.php?id="+idPadre);  
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });   
   }
            
	var id;
    var sizeInMB;
   	$(".iconoss").click(function(){   		
   		id = $(this).attr('id');  		   		
   		var accion = 'HomeSubMenu';
   		var data = { id:id,accion:accion }     
   		infoMenu(data);
   	});

   	$('.iconos1').click(function(){
   		id = $(this).attr('id');  
   		var estado = $(this).attr('name');   		
   		var accion = 'activeHomeSubMenu';   		
   		var data = { id:id,accion:accion,estado:estado }       		
   		activeSubMenu(data);
      if(estado==1){
        var info = "Menu Desactivado";
      }else{
        var info = "Menu Activado";
      }
      msj(info);
   	});

    //Ingresar Contenido Por Menu    
    $('.menu2').click(function(){
        $("#entradas").css("width","100%");
        id = $(this).attr('id');  
        $("#menuNota").val(id);
        var estado = $(this).attr('name');          
        var accion = 'activeHomeSubMenu';       
          
        var data = { id:id,accion:accion,estado:estado }            
    });
    

    //Imagen de la noticia
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

    // Guardar Notas Por Menu
    $("#saveNota").click(function(){
            var filename = $("#fleImagen").val().replace(/C:\\fakepath\\/i, '');
            var fileDocument = $("#documento").val().replace(/C:\\fakepath\\/i, '');

            var formData = new FormData();
            formData.append('file', $('#fleImagen')[0].files[0]);
            formData.append('documento', $('#documento')[0].files[0]);
            formData.append('accion', 'subirImageNota');
            formData.append('nuevo_nombre', fechadeldia);

            $("#nombreImagen").val(fechadeldia+filename);
            $("#nombreDocumento").val(fechadeldia+fileDocument);
                if(sizeInMB ==null || sizeInMB <= 0.20)
                {
                    //alert(sizeInMB + 'MB');
                    subirImageNota(formData);
                    $.ajax({
                        url: "../menu/ChomePages/saveNota",
                        type:"post",
                        dataType: "json",
                        data: $('#notas').serialize(),               

                        success: function(){   

                            $('#notas').trigger("reset");
                            $('#preview').attr('src', '');
                            //$(".includ").load("pages/lista_menus.php"); 
                            //window.setTimeout('location.reload()', 1000);       
                        },
                        error:function(){
                           $('#notas').trigger("reset");
                           $('#preview').attr('src', '');
                            //alert("Error.. No se subio la imagen");
                        }
                    });
                }
                else
                {
                    alert("La Imagen Es Muy pesada");
                } 
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
                    //alert("sube");
                    $(".perfil").load("pages/avatar.php");
                },
                error:function(){
                    alert("Error.. No se subio la imagen");
                }
            });
        }

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
            	$(".submenu").load("../../../pages/lista_HomeSubMenu.php?id="+id_menu);  
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
        var accion	= "saveChangeHomeSubmenu";

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
            	$(".submenu").load("../../../pages/lista_HomeSubMenu.php?id="+id_menu); 
            	return false; 

            },
            error:function(){
                //alert("Error.. Submenu");
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

        		$("#icon2 option").each(function()
            {        			
        			if(nombre_menu == $(this).text())
        			{                
        				$("#icon2").find("option[value='"+$(this).attr('value')+"']").remove();  				
        				$('#icon2').prepend("<option value='"+id_menu+"' selected>"+nombre_menu+"</option>");        				
        				return false;
        			}   					
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

include_once("../class_db/class_menus.php");
$id = $_GET['id'];
$submenus = getHomeSubMenus($id);
$menuPadre = getMenuPadre($id);
$menusPadres = getSelectHomeMenus();

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
	    	 <div class="col-md-8">
	    	 	<div class="menu2" data-toggle="modal" data-target="#entradas" id='<?php echo $row['id_submenu']; ?>'>
					   <?php echo $row['nombre_submenu']; ?>
				  </div>
	    	 </div>
	    	 <div class="col-md-4 opciones">
	    	 	<div class='opciones'>	  
            <i class="fa fa-list-ul fa-5 iconoss sub" id='<?php echo $row['id_submenu']; ?>'></i>  	 		
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
             <i class="fa fa-trash-o buton-trash1" data-toggle="modal" data-target="#eliminar-submenu"  id='<?php echo $row['id_submenu']; ?>' name='<?php echo $row["nombre_submenu"] ?>'>
             <input type="hidden" name="idPadre" id="idPadre" value="<?php echo $row['id_menu']; ?>">
            </i>   	 		
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
                <div class="container">

                  <div class="row">
                    <div class="col-md-3">
                      <h3>Nota : USO DE PLANTILLAS</h3>
                    </div>
                    <div class="col-md-6">
                      <ul>
                        <li>1 Publicacion : uaip/Cinicio/index</li>
                        <li>3 Publicacion : uaip/Cinicio/valores</li>
                        <li>Lista de Publicaciones: uaip/Cproyecto/index</li>
                        <li>N Publicacion en Acordion</li>
                      </ul>
                    </div>

                   
                  </div>
                  

                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->



<style>
    .modal-content{
      margin-left: -50%;
      width: 100%;
      margin: 0 auto;      
      border:1px solid white;
    }
</style>

          <!-- BEGIN MODALS -->
<div class="modal fade" id="entradas" tabindex="-1" width="100%" role="dialog" aria-hidden="true">
    <div class="modal-dialog unoDemo">
        <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><i class="fa fa-file"></i><b>Nueva</b> Entrada</h4>
                </div>
                <form action="#" id="notas" method="post">
                <div class="modal-body">
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Nombre del Título</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="titulo" name="titulo">
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Nombre del Subtítulo</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="subtitulo" name="subtitulo">
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Contenido de la Entrada</span>                       
                        </div>
                        <div class="col-md-8">
                            <textarea name="contenido" cols="56%" rows="5px"></textarea>
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Imagen de la Entrada</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="fleImagen" id="fleImagen" multiple>
                            <img src="" id="preview" width='100px'>
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Documento de la Entrada</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="documento" id="documento" multiple>
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Video de la Entrada</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="video" id="video">
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Referencia de la Entrada</span>                       
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="referencia" id="referencia">
                        </div>
                    </div>
                    <div class="row tab">
                        <div class="col-md-4 titulos">
                            <span>Estado</span>                       
                        </div>
                        <div class="col-md-8">
                            <select name="estado">
                                    <option value="1">Activo</option>
                                    <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    
                  
                  
                </div>
                <input type="hidden" name="menuNota" id="menuNota" value="">
                <input type="hidden" name="nombreImagen" id="nombreImagen" value="">
                <input type="hidden" name="nombreDocumento" id="nombreDocumento" value="">
                <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['idUser'] ?>">
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" id='cancelar' data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='saveNota' data-dismiss="modal">Guardar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->

          <!-- BEGIN MODALS -->
          <style>
              .modal-content{
                width: 100%;
              }
          </style>
          <div class="modal fade" id="eliminar-submenu" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Eliminar</strong> Sub-Menu</h4>
                </div>
                <div class="modal-body">
                <b>Desea Eliminar el Menu :</b> <span class="menu_eliminar"></span>
                <input type="hidden" name="idSubMenuEliminar" id="idSubMenuEliminar" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='eliminarSubMenu' data-dismiss="modal">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->




          




