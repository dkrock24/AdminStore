 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    
    <script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>    
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>    
    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="../../../assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="../../../assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="../../../assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->

<?php





?>

<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
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

   // Ir a Detalle de la Sucursal
   $(".detalle_sucursal").click(function(){
    $(".sk-three-bounce").show();
    var id_sucursal = $(this).attr("id");
        $.ajax({
            url: "../admin/Csucursales/editar",
            type:"post",
            success: function(){     
              $(".pages").load("../admin/Csucursales/editar/"+id_sucursal);      
              setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);  
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  
   });

   $(".nodo_detalle").click(function(){
    var id_nodo = $(this).attr("id");
        $.ajax({
            url: "../admin/Csucursales/editar",
            type:"post",
            success: function(){     
              $(".pages").load("../admin/Csucursales/editarNodo/"+id_nodo);      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  
   });

   // Ir a nodos por sucursal
   $(".nodo_sucursal").click(function(){
    var id_sucursal = $(this).attr("id");
        $.ajax({
            url: "../admin/Csucursales/getNodosSucursal/"+id_sucursal,
            type:"post",
            success: function(){     
              $(".pages").load("../admin/Csucursales/getNodosSucursal/"+id_sucursal);      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  
   });

   

   $(".btn-crear").click(function(){
      var url = $(this).attr('id');      
            $(".pages").load(url);        
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

  .titulos{
    font-size: 12px;
  }
  .btn-crear{
    text-align: right;
    float: right;
    display: inline-block;
    position: relative;
    margin-right: 3%;
  }



</style>


<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-home'></i>Lista</a></li>
    <li id="menu_li" class="B "><a href="#tab1_2" id="usuarios" name="../admin/Csucursales/acceso" data-toggle="tab"><i class='fa fa-user'></i>Usuarios</a></li>  
    <li id="menu_li" class="C "><a href="#tab1_3" id="nodos" name="../admin/Csucursales/nodos" data-toggle="tab"><i class='fa fa-desktop'></i>Nodos Sucursal</a></li>  
    <li id="menu_li" class="D "><a href="#tab1_4" id="getNodos" name="../admin/Csucursales/getNodos" data-toggle="tab"><i class='fa fa-th-list'></i>Lista Nodos</a></li> 
</ul>
<form action="../usuarios/Cusuarios/guardar_usuario" id="usuario" method="POST">
    <div class="tab-content">
        
        <div class="tab-pane fade active in" id="tab1_1">
            <a href="#" id="../admin/Csucursales/crear" class="btn btn-danger btn-crear" name="">Nueva</a><br>        
            <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Pais</th>
                        <th>Departamento</th>                        
                        <th>Creada</th>                                                
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($sucursales !=""){
                foreach ($sucursales as $sucursal) 
                {
                ?>
                    <tr>
                        <td><?php echo $sucursal->nombre_sucursal;  ?></td>
                        <td><?php echo $sucursal->nombre_pais;  ?></td>
                        <td><?php echo $sucursal->nombre_departamento;  ?></td>
                        <td><?php $date = date_create($sucursal->fecha_creacion); echo date_format($date,"Y/m/d");  ?></td>                         
                        <td>
                            <a class="detalle_sucursal" id="<?php echo $sucursal->id_sucursal; ?>" name='<?php echo $sucursal->nombre_sucursal; ?>' href="#">
                                <button type="button" class="btn btn-primary btn-transparent">Detalle</button>
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
    <div class="tab-pane includ fade" id="tab1_2">
        <table class="table table-hover table-dynamic ">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Pais</th>                                                                     
                        <th>Departamento</th>
                        <th>Detalle</th>                        
                    </tr>
                </thead>
                <tbody>
                <?php
                if($usuarios !=""){
                foreach ($usuarios as $usuario) 
                {
                ?>
                    <tr>
                        <td><?php echo $usuario->nickname ?></td>
                        <td><?php echo $usuario->nombre_rol;  ?></td>
                        <td><?php echo $usuario->nombre_pais;  ?></td>                        
                        <td><?php echo $usuario->nombre_departamento;  ?></td>   
                        <td>
                        <a href="#" name="../admin/Csucursales/acceso/<?php echo $usuario->id_usuario ?>" id="enlance" class="<?php echo $usuario->id_usuario; ?>" href="#">
                            <button type="button" class="btn btn-dark btn-transparent">Detalle</button>
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
              <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Pais</th>
                        <th>Departamento</th>                        
                        <th>Creada</th>                                                
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($sucursales !=""){
                foreach ($sucursales as $sucursal) 
                {
                ?>
                    <tr>
                        <td><?php echo $sucursal->nombre_sucursal;  ?></td>
                        <td><?php echo $sucursal->nombre_pais;  ?></td>
                        <td><?php echo $sucursal->nombre_departamento;  ?></td>
                        <td><?php $date = date_create($sucursal->fecha_creacion); echo date_format($date,"Y/m/d");  ?></td>                         
                        <td>
                            <a class="nodo_sucursal" id="<?php echo $sucursal->id_sucursal; ?>" name='<?php echo $sucursal->nombre_sucursal; ?>' href="#">
                                <button type="button" class="btn btn-primary btn-transparent">Detalle</button>
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

    <div class="tab-pane fade" id="tab1_4">
    <a href="#" id="../admin/Csucursales/crearNodo" class="btn btn-danger btn-crear" name="">Nuevo</a><br>        
              <table class="table table-hover table-dynamic ">
                <thead class='titulos'>
                    <tr>
                        <th>Nodo</th>
                        <th>Categoria</th>
                        <th>Enlace</th>                        
                        <th>Estado</th>                                                
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($nodos !=""){
                foreach ($nodos as $nodo) 
                {
                ?>
                    <tr>
                        <td><?php echo $nodo->nombre_nodo;  ?></td>
                        <td><?php echo $nodo->categoria_nodo;  ?></td>
                        <td><?php echo $nodo->url_nodo;  ?></td>
                        <td><?php if($nodo->estado_nodo==1){echo "Activo";}else{echo "Inactivo";}  ?></td>                         
                        <td>
                            <a class="nodo_detalle" id="<?php echo $nodo->id_nodo; ?>" name='<?php echo $nodo->nombre_nodo; ?>' href="#">
                                <button type="button" class="btn btn-primary btn-transparent">Detalle</button>
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


  </div>
</form>


