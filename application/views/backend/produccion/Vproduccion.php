<?php
   session_start()
?>
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
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

<script>    
  //-----------------Jquery insercion de  productos----------------
  $(".viewDataEmpleao").click(function()
  {
    $(".load-table").hide();
    $(".load-dataDinamic").show();
    $(".load-dataDinamic").load("../produccion/Cproduccion/listEmpleadosCP/");
  });
  //-------------------------Fin -----------------------------------  

   //----------------Load second index with ID centroP ----
    $(".back").click(function()
    {
      $(".pages").load("../produccion/Cproduccion/index"); 
    });
    //-------------------------Fin ------------------

    //----------------Realizar envio de materiales ----
    $(".realizarEnvio").click(function()
    {
      var idSucursalMaterial = $(this).find('.IdSucursalInventario').val();
      var tipoUnidad = $(this).find('.tipoUnidad').val();
      var codigoMaterial = $(this).find('.codigoMaterial').val();
      //var cpID = $(this).find('.cpID').val();
      $(".tableInventario").hide();
      $(".loadEnvio").show();
      $(".loadEnvio").load("../produccion/Cproduccion/envioMateriales/"+idSucursalMaterial+"/"+tipoUnidad+"/"+codigoMaterial);

    });
    //-------------------------Fin ------------------

  //----------------- Open modal view data-------------------
  $(".viewDataEmpleado").click(function()
  {
     $(".ModaViewdataEmpleado").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var empleadoID = $(this).find('.idEmpleadoV').val();
    ///alert(empleadoID);
    $(".modalViewCOntentEmpleado").load("../produccion/Cproduccion/viewEmpleado/"+empleadoID);
  });

  //----------------- Open modal view data-------------------
  $(".deleteEmpleado").click(function()
  {
    var r = confirm("Desea quitar empleado de centro produccion?");
    if (r == true) 
    {
        var empleadoID = $(this).find('.idEmpleadoE').val();
        $.ajax
           ({
            url: "../produccion/Cproduccion/delete_empleado",
            type:"post",
            data: {empleadoID:empleadoID},
            success: function()
            {
              alert("Empleado eliminado correctamente");
              $(".pages").load("../produccion/Cproduccion/index"); 
            },
            error:function(){
                alert("failure");
            }
          });
    }

   
  });

  //----------------- Open modal view dataEnvio-------------------
  $(".viewDataEnvio").click(function()
  {
     $(".ModaViewdataEnvio").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var envioID = $(this).find('.idEnvioMaterial').val();
    $(".modalViewCOntentEnvio").load("../produccion/Cproduccion/viewEnvio/"+envioID);
  });

  //-----------------Cambiar estatus del envio-------------------
  $(".viewDataEnvio").click(function()
  {
     $(".ModaViewdataEnvio").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var envioID = $(this).find('.idEnvioMaterial').val();
    $(".modalViewCOntentEnvio").load("../produccion/Cproduccion/viewEnvio/"+envioID);
  });
</script>



<ul class="nav nav-tabs">
 <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-users'></i>Ver Empleados</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-list-ol'></i>Inventario</a></li> </li> 
  <li id="menu_li" class="C "><a href="#tab1_3" data-toggle="tab"><i class='fa fa-paper-plane-o'></i>Lista de Envios</a></li> </li>
  <li id="menu_li" class="D "><a href="#tab1_4" data-toggle="tab"><i class='fa fa-area-chart'></i>Reporte de envios</a></li> </li>    
<div id="actions-bar">
<span  style="float:right;background-color: #c75757;" class="btn btn-success back">Regresar</span>
</div>
</ul>

<div class="tab-content">  
  <div class="tab-pane fade active in" id="tab1_1">
  
  <div class="load-dataDinamic" style="display: none;"></div>  

    <div  class="load-table">
    <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Direccion</th>                                                                 
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                //var_dump($empleados);
                      foreach ($empleados as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombres;  ?></td>
                        <td><?php echo $value->apellidos;  ?></td>
                        <td><?php echo $value->celular;  ?></td>  
                        <td><?php echo $value->direccion;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary btn-sm deleteEmpleado">
                            <input type="hidden" name="idEmpleadoE" class="idEmpleadoE" value="<?php echo $value->id ?>">eliminar
                          </button>
                          <button type="button" class="btn btn-primary btn-sm viewDataEmpleado">
                            <input type="hidden" name="idEmpleadoV" class="idEmpleadoV" value="<?php echo $value->id_usuario ?>">ver Info
                          </button>
                         
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
      ?> 
                   
    </tbody>   
    </table>
    </div>               
  </div>


  <div class="tab-pane includ fade" id="tab1_2">
  <div class="loadEnvio" style="display: none;"></div>
  <div class="tableInventario">
   <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th>Codigo</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Total Existencia</th> 
                        <th>Minimo Existencia</th>                                                                      
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($materiales)) 
                    {
                      //var_dump($materiales);
                      foreach ($materiales as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->codigo_material;  ?></td>
                        <td><?php echo $value->nombre_matarial;  ?></td>
                        <td><?php echo $value->nombre_categoria_materia; ?></td>
                        <td><?php echo $value->total_existencia; ?></td>
                        <td>
                        <p class="inpuExist" style="display: none;"> 
                          <input type="text" name="firstname">
                        </p>
                        <p class="valCelda">
                          <?php echo $value->minimo_existencia; ?></td>                         
                        </p>
                        <td>
                        
                    <button type="button" class="btn btn-primary  btn-sm realizarEnvio">
                    <input type="hidden" name="IdSucursalInventario" class="IdSucursalInventario" value="<?php echo $value->id_inventario_sucursal ?>">
                    <input type="hidden" name="tipoUnidad" class="tipoUnidad" value="<?php echo $value->id_tipo_unidad_medida ?>">
                    <input type="hidden" name="codigoMaterial" class="codigoMaterial" value="<?php echo $value->codigo_material ?>">
                  
                    Realizar Envio
                            </button>         

                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
           
      ?> 
                   
    </tbody>   
  </table>
  </div>
    </div>               



  <div class="tab-pane includ fade" id="tab1_3">
   <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Unidad Medida</th>
                        <th>Fecha registro</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($envios)) 
                    {
                      //var_dump($envios);
                      foreach ($envios as $value) 
                      {
                        $tagStatus = ($value->estatus ==3) ? "<i class='fa fa-exclamation-triangle' aria-hidden='true' style='color:#FFEB2B; font-size: 19px;'></i>" : "<i class='fa fa-check-circle-o' aria-hidden='true'></i>" ;

                        $tagStatusLabel = ($value->estatus ==3) ? "Recibido" : "Completado" ;
                      ?>
                    <tr>
                        <td><?php echo $value->codigo_material;  ?></td>
                        <td><?php echo $value->nombre_matarial; ?></td>
                        <td><?php echo $value->cantidad;  ?></td>
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>
                        <td><?php echo $value->fecha_registro; ?></td>
                        <td>
                        
                        <button type="button" class="btn btn-primary  btn-sm viewDataEnvio">
                    <input type="hidden" name="idEnvioMaterial" class="idEnvioMaterial" value="<?php echo $value->id_envio_materiales ?>">Ver info de Envio
                            </button>

                           <!-- <button type="button" class="btn btn-primary  btn-sm datoEnvio">
                    <input type="hidden" name="idEnvioMaterial" class="idEnvioMaterial" value="<?php echo $value->id_envio_materiales ?>">-->
                   
                       <?php //echo $tagStatusLabel; ?>
                       <?php //echo $tagStatus; ?>
                            <!--</button>-->         

                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
           
      ?> 
                   
    </tbody>   
  </table>
    </div>

<div class="tab-pane includ fade" id="tab1_4">
Test tab 4
</div>


  
</div>



<!-- Codigo para ver informacion del empleado -->
<div class="modal fade ModaViewdataEmpleado" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Informacion de envio
          </h4>
          <hr>
        <div class="modal-body modalViewCOntentEmpleado">

        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo -->  


<!-- Codigo para ver informacion del empleado -->
<div class="modal fade ModaViewdataEnvio" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Informacion de proveedor
          </h4>
          <hr>
        <div class="modal-body modalViewCOntentEnvio">

        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo -->  




