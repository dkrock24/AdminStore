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

   $(".btn-crear").click(function()
    {
        $(".sk-three-bounce").show();
        var url = $(this).attr('id');      
        $(".pages").load(url);  
        setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);      
    });

   $(".detalle_impuesto").click(function(){
      $(".sk-three-bounce").show();
      var id_impuesto = $(this).attr("id");
        $.ajax({
            url: "../admin/Cimpuesto/editar",
            type:"post",
            success: function(){     
              $(".pages").load("../admin/Cimpuesto/editar/"+id_impuesto);      
                setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  
   });

   $(".detalle_impuesto2").click(function(){
      $(".sk-three-bounce").show();
      var id_impuesto = $(this).attr("id");
        $.ajax({
            url: "../admin/Cimpuesto/editarImpuestoPais",
            type:"post",
            success: function(){     
              $(".pages").load("../admin/Cimpuesto/editarImpuestoPais/"+id_impuesto);      
                setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
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
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-home'></i>Sucursal</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-home'></i>Pais</a></li>  
</ul>
<form action="../usuarios/Cusuarios/guardar_usuario" id="usuario" method="POST">
  <div class="tab-content">
    
    <div class="tab-pane fade active in" id="tab1_1">
      <a href="#" id="../admin/Cimpuesto/crear" class="btn btn-danger btn-crear" name="">Nuevo</a><br>
      <table class="table table-hover table-dynamic filter-head">
                    <thead class='titulos'>
                      <tr>
                        <th>Pais</th> 
                        <th>Departamento</th>
                        <th>Sucursal</th>                        
                        <th>Impuesto</th>                     
                        <th>Valor</th>                          
                        <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($impuestos!="")
                    {
                    foreach ($impuestos as $impuesto) 
                    {
                      
                            ?>
                             <tr>
                                <td><?php echo $impuesto->nombre_pais;  ?></td>
                                <td><?php echo $impuesto->nombre_departamento;  ?></td>
                                <td><?php echo $impuesto->nombre_sucursal;  ?></td>
                                <td><?php echo $impuesto->nombre_impuesto;  ?></td>                                
                                <td><?php echo $impuesto->monto_impuesto;  ?></td>
                                
                                
                                <td>
                                    <a class="detalle_impuesto" id="<?php echo $impuesto->id_impuesto; ?>" name='<?php echo $impuesto->nombre_sucursal; ?>' href="#">
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
    <a href="#" id="../admin/Cimpuesto/crearImpuestoPais" class="btn btn-danger btn-crear" name="">Nuevo</a><br>
      <table class="table table-hover table-dynamic">
                    <thead class='titulos'>
                      <tr>
                        <th>Pais</th>                        
                        <th>Impuesto</th>                     
                        <th>Valor</th>                          
                        <th>Detalle</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($impuestosPais!="")
                    {
                    foreach ($impuestosPais as $impuesto) 
                    {
                      
                            ?>
                             <tr>
                                <td><?php echo $impuesto->nombre_pais;  ?></td>
                                <td><?php echo $impuesto->nombre_impuesto;  ?></td>
                                <td><?php echo $impuesto->monto_impuesto;  ?></td>
                                <td>
                                    <a class="detalle_impuesto2" id="<?php echo $impuesto->id_impuesto; ?>" name='<?php echo $impuesto->nombre_sucursal; ?>' href="#">
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
    </div><!-- END TAB2-->

  </div>
</form>


