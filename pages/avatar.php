 <?php
 session_start();
 include_once("../class_db/class_usuarios.php");
 include_once("../class_db/cargar_perfil.php");

  $dataInfo = id();
  $genero = strtolower ($dataInfo['genero']);  
  $avatar = avatar_genero($genero);
  $avatar_personales = avatatar_personal($dataInfo['id_usuario']);
 ?>

 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
    <link href="assets/plugins/input-text/style.min.css" rel="stylesheet">

    <script>
    	$(document).ready(function(){
            var sizeInMB;
            $(".msg1").hide();
            $(".msg2").hide();
            $(".msg3").hide();

            $("#cambiarAvatar").click(function(){  
                var avatar = $('input:radio[name=avatar]:checked').attr("id");		
                var usuario = $('#id_usuario').val();
                var accion = 'cambiarAvatar';

                var dataAvatar = {
                  avatar:avatar,
                  usuario:usuario,
                  accion:accion
                }                                
                cambiarAvatar(dataAvatar);
                var a = $('.ava').attr('src','assets/images/avatars/'+avatar);
	 		});

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

            

            $("#subirAvatar").click(function(){ 

                var formData = new FormData();
                formData.append('file', $('#fleImagen')[0].files[0]);
                formData.append('accion', 'subirAvatar');
                formData.append('usuario', $('#id_usuario').val());
                formData.append('genero', $('#genero').val());

                if(sizeInMB <= 0.20)
                {
                    //alert(sizeInMB + 'MB');
                    subirAvatar(formData);
                    
                }
                else
                {
                    alert("La Imagen Es Muy pesada");
                }               
                
            });
    	});

        function subirAvatar(formData)
        {
            $.ajax({
            url: "class_db/saveUsuario.php",
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

	 	function cambiarAvatar(dataAvatar)
	 	{
	 		$.ajax({
	        url: "class_db/saveUsuario.php",
	        type:"post",
	        data: dataAvatar,
	        
		        success: function(){
		        	$(".msg2").slideDown(200, function(){
			        	$(".msg2").show();
				        setTimeout(function() {
				        	$(".msg2").slideUp(1000);
				        }, 3000);
				        
			        });	 
                    
			        
		        },
		        error:function(){
		            $(".msg3").slideDown(200, function(){
			        	$(".msg3").show();
				        setTimeout(function() {
				        	$(".msg3").slideUp(1000);
				        }, 3000);
			        });
		        }
	  		});	
	 	}
    </script>
    <style>
  
  .avatar{
    padding: 3px;
    display: inline-block;

  }

</style>
<input type="hidden" value="<?php echo $_SESSION['data'][0]; ?>" name="idusuario" id="id_usuario">
<input type="hidden" value="<?php echo $genero ?>" name="genero" id="genero">
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">

    <div class="row">
    	
    	<div class="col-md-12">
    	<div class="panel bg-dark">
                <div class="panel-header">
                  <h3>Subir! - <strong>Avatar</strong></h3>
                  <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i></a>
                    <a href="#" class="panel-close"><i class="icon-trash"></i></a>
                  </div>
                </div>
                <div class="panel-content" style="display: none;">
                	<div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <button class='btn btn-success' id="subirAvatar">Subir Avatar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <img src="" id="preview" width='300px'>
                            </div>
                            <div class="col-md-6">
                                <input type="file" name="fleImagen" id="fleImagen">
                            </div>
                        </div>
                    </div>
                </div>
              </div>
    	</div>
    </div>
    <div class="row alert-danger msg1">
        <div class="col-md-12">        	
        	<div class="msg" ><h3>La Contraseña Introducida Es Distinta... Vuelva a Intentarlo</h3></div>
        </div>
    </div>
    <div class="row alert-success msg2">
        <div class="col-md-12">        	
        	<div class="msg2" ><h3>Se Cambio El Avatar</h3></div>
        </div>
    </div>
    <div class="row alert-warning msg3">
        <div class="col-md-12">        	
        	<div class="msg3" ><h3>No se Cambio La Contraseña. Problemas de Acceso.. </h3></div>
        </div>
    </div>

    

    <div class="row">
        <div class="col-md-12">
          <div class="row line">
                <div class="col-md-6">
                  <span class="input input--hoshi">
                    <h3>Avatar de Sistema</h3>
                    <table>
                    
                     <?php
                     $path = 'assets/images/avatars/';

                     while($row = mysql_fetch_array($avatar))
                     {

                      ?>
                        <div class='avatar'>
                          <img class='ddd' src="<?php echo $path.$row['url_avatar']; ?>" width="100px">
                          <input type="radio" class="avatar" name="avatar" id="<?php echo $row['url_avatar']; ?>">
                        </div>
                      <?php                      
                      }

                     ?>
                     
                     </table>
                  </span>
                </div>
                <div class="col-md-6">
                <span class="input input--hoshi">
                <?php
                      $path = 'assets/images/avatars/';
                    ?>
                    <h3>Avatar Personales</h3>
                  <table>
<!--
                    <tr>                    
                      <td><img src="<?php echo $path.$dataInfo['avatar']; ?>" width="100px"></td>
                    </tr>
                    -->

       
                      <?php
                        $path = 'assets/images/avatars/';
                        while($row = mysql_fetch_array($avatar_personales))
                        {
                      ?>
                        <div class='avatar'>
                          <img src="<?php echo $path.$row['url_avatar']; ?>" width="100px">
                          <input type="radio" class="avatar" name="avatar" id="<?php echo $row['url_avatar']; ?>">
                        </div>
                      <?php                      
                      }
                     ?>
            
                    </table>              
                    </span>
                </div>
          </div> 
        </div>
    </div>
    <div class="row">

    </div>
        <div class="col-md-10"></div>
        <div class="col-md-2">
            <button class='btn btn-success' id="cambiarAvatar">Cambiar Avatar</button>
        </div>
    </div>
</div>

