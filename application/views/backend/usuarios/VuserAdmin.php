 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    
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
      $("li#menu_li").click(function(){        
        var texto = $(this).text();        
            if(texto=="Buscar")        
            {     
              $(".includ").load("backend/usuarios/Cusuarios/index");             
            }
        });

      $(".femenino").hide();

      $("#genero").change(function (){
        var genero = $("#genero").val();
          if(genero == "F")
          {
            $(".femenino").show();
            $(".masculino").hide();
          }
          else
          {
            $(".femenino").hide();
            $(".masculino").show();
          }
      });

  });

  $("#abc").click(function(){
    saveData1();
  });

  function saveData1()
  {
    
    $.ajax({
        url: "../usuarios/Cusuarios/guardar_usuario",
        type:"post",
        data: $("#usuario").serialize(),
        
        success: function(){
          //alert("Se Guardo Correctamente El usuario");
          $(".A").removeClass("active");
          $(".B").addClass("active");
          $("#tab1_1").removeClass("active");
            
          $("#tab1_2").addClass("active in");
          $("#tab1_2").load("pages/lista_usuarios.php");  
        },
        error:function(){
            alert("failure");
        }
    });
  }

  $("a.eliminar").click(function()
  {
    $(".usuario_eliminar").text($(this).attr("name"));    
    $("#idUsuarioEliminar").val($(this).attr('id'));
  });

   $('#eliminarUsuario').click(function(){
      id = $("#idUsuarioEliminar").val();  
            
      delete_usuario(id);
    });

    function delete_usuario(id)
    {
        
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
   }




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

  .upper{
    padding: -10px;
    margin: 0px;

  }



</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-user'></i>Nuevo</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-search'></i>Buscar</a></li>  
</ul>
<form action="../usuarios/Cusuarios/guardar_usuario" id="usuario" method="POST">
  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
      <div class="row">
        <div class="col-md-12">
          <div class="row line">
                <div class="col-md-6">
                  <span class="input input--hoshi ">
                      <input class="input__field input__field--hoshi" type="text" id="primer_nombre" required name="nombres" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombres</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="primer_apellido" name="apellidos" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Apellidos</span>
                      </label>
                  </span>
                </div>
                
          </div> 
          


          <div class="row line">
           <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="telefono" required name="telefono" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Teléfono Fijo</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="celular" name="celular" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Teléfono Móvil</span>
                      </label>
                  </span>
                </div>
          </div> 

          <div class="row line">
             <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="direccion"  name="direccion" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Dirección</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" name="dui" type="text" id="dui" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">DUI</span>
                      </label>
                  </span>
                </div>
          </div>

          <div class="row">
            
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="usuario" required name="usuario" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Usuario</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="password" required name="password" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Password</span>
                      </label>
                  </span>
                </div>
                  
          </div>

          <div class="row">
               
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="date" id="fecha_nacimiento" name="fecha"  />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Fecha Nacimiento</span>
                      </label>
                  </span>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Genero</label><br><br>
                        <select class="form-control form-grey" name="genero" id="genero" data-style="white" data-placeholder="Select a country...">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                </div>            
          </div>

          <div class="row">
            <div class="col-md-12">      
              <div class="col-md-6">
                   <div class="form-group">
                        <label>Cargo</label><br><br>
                        <select class="form-control form-grey" name="cargo" id="cargo" data-style="white" data-placeholder="Select a country...">
                        <?php
                        foreach ($cargos as $value) {
                          if($value->id_cargo !=1)       
                          {
                          ?>
                          <option value="<?php echo $value->id_cargo ?>"><?php echo $value->nombre_cargo?>
                          </option>
                          <?php
                        }
                        }
                        ?>                      
                        </select>
                    </div> 
                </div>
              <div class="col-md-6">
                   <div class="form-group">
                        <label>Rol</label><br><br>
                      <select class="form-control form-grey" name="rol" id="rol" data-style="white" data-placeholder="Select a country...">
                      <?php
                      foreach ($roles as $value) {
                        if($value->id_rol !=1)       
                        {
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






          <div class="row">
            <div class="col-md-6">Avatar Masculinos</div>
            <div class="col-md-6">Avatar Femeninos</div>
          </div>
          <div class="row line">            
               <div class="col-md-6">
                  <span class="input input--hoshi masculino">
                     <table>
                     <tr>
                     <?php
                     $path = '../../../assets/images/avatars/';
                     foreach ($avatar as $value) {
                      if($value->usuario_id == '' and $value->genero_avatar=='m')
                      {
                      ?>
                        <div class='avatar'>
                          <img src="<?php echo $path.$value->url_avatar ?>" width="70px">
                          <input type="radio" class="avatar" name="avatar" value="<?php echo $value->url_avatar ?>">
                        </div>
                      <?php                      
                      }
                     }
                     ?>
                     </tr>
                     </table>
                  </span>
                </div>
                <div class="col-md-6">
                  <span class="input input--hoshi femenino">
                    <table>
                      <tr>
                       <?php
                         $path = '../../../assets/images/avatars/';

                         foreach ($avatar as $value) {
                          if($value->usuario_id == '' and $value->genero_avatar=='f')
                          {
                            ?>
                              <div class='avatar'>
                                <img src="<?php echo $path.$value->url_avatar ?>" width="70px">
                                <input type="radio" class='avatar' name="avatar" value="<?php echo $value->url_avatar ?>">
                              </div>
                            <?php                      
                          }
                         }
                       ?>
                      </tr>
                    </table>
                  </span>
                </div>
                  
          </div>




          <input type="button" id="abc"  class="btn btn-primary" value="Guardar">
        </div>
      </div>
    </div>

    <div class="tab-pane includ fade" id="tab1_2">
      <table class="table table-hover table-dynamic filter-head">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Rol</th>                        
                        <th>Estado</th>                        
                        <th>Detalle</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    session_start();
                    foreach ($usuario as $usuarios) {
                      if($usuarios->id_rol!=1){


                            ?>
                             <tr>
                                <td><?php echo $usuarios->nickname;  ?></td>
                                <td><?php echo $usuarios->nombre_cargo;  ?></td>
                                <td><?php echo $usuarios->nombre_rol;  ?></td>
                                <td><?php echo $usuarios->estado;  ?></td>
                                <td>

                                    <a id="enlance" class="<?php echo 1; ?>" href="#">
                                    <button type="button" class="btn btn-dark btn-transparent">Detalle</button>
                                     </a>
                                     
                                </td>  
                                <td>
                                    <a data-toggle="modal" data-target="#eliminar-usuario" class="eliminar" id="<?php echo $usuarios->id_usuario; ?>" name='<?php echo $usuarios->nickname; ?>' href="#">
                                    <button type="button" class="btn btn-primary btn-transparent">Eliminar</button>
                                     </a>
                                </td>

                            
                             </tr>
                            
                            <?php  
                            }                    
                        }
                    ?>                      
                    </tbody>
    </table>
    </div>

    <div class="tab-pane fade" id="tab1_3">
      <p></p>
    </div>
  </div>
</form>

  <!-- BEGIN MODALS -->
          <div class="modal fade" id="eliminar-usuario" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Eliminar</strong> Usuario </h4>
                </div>
                <div class="modal-body">
                <b>Desea Eliminar el Usuario :</b> <span class="usuario_eliminar"></span>
                <input type="hidden" name="idUsuarioEliminar" id="idUsuarioEliminar" value="">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-embossed" id='eliminarUsuario' data-dismiss="modal">Eliminar</button>
                </div>
              </div>
            </div>
          </div>
          <!-- END MODALS -->

