<?php
   session_start();
?>
 <!-- END PRELOADER -->
 <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
<script>
    $(".agregarUnidaMedida").click(function()
    {
        $(".AddUnidadMedida").modal({
           backdrop: 'static', 
           keyboard: false 
        });

    });

  //-----------------Jquery insercion de  productos----------------
  $("#saveUnidadMedida").click(function()
  {
    //var dataString = $('#unidadMedidaAdd').serialize();
    $.ajax
    ({
        url: "../productos/Cproductos/save_unidadMedida",
        type: "post",
        data: $('#unidadMedidaAdd').serialize(),                           
      
        success: function(data)
        {                                                  
         
          $('.AddUnidadMedida').modal('toggle');
          $(".pages").load("../productos/Cproductos/unidadMedida"); 
        },
        error:function()
        {

        }
    });

  });
  //-------------------------Fin -----------------------------------   

    //-----------------Jquery ver tipos de unidad de medida-------
  $(".verTipoUnidades").click(function()
  {
    
    $(".pages").load("../productos/Cproductos/tipoUnidadMedida"); 

  });
  //-------------------------Fin -----------------------------------    

  //-----------------Jquery ver div tipo UNidad--------------
  $("#saveTipoUnidadMedida").click(function()
  {
    $(".form-tipoUnidad").show();
    $(".form-principal").hide();

  });
  //-------------------------Fin -----------------------------------    

  //-----------------Jquery ocultar div tipo Unidad----------------
  $("#CancelTipoUnidadAdd").click(function()
  {
    $(".form-tipoUnidad").hide();
    $(".form-principal").show();

  });
  //-------------------------Fin -----------------------------------    


  //-----------------Jquery insercion de tipo unidad medida-------
  $("#TipoUnidadAdd").click(function()
  {

    $.ajax
    ({
        url: "../productos/Cproductos/save_TipounidadMedida",
        type: "post",
        data: $('#TipoUnidadMedidaAdd').serialize(),                           
      
        success: function(data)
        {                                                  
         
          $('.AddUnidadMedida').modal('toggle');
          $(".pages").load("../productos/Cproductos/unidadMedida"); 
        },
        error:function()
        {

        }
    });

  });
  //-------------------------Fin -----------------------------------    

//-----Cargar modale para agregar materiales----------------------
  $(".agregarMateria").click(function()
  {
     $(".modelAddMaterial").modal({
           backdrop: 'static', 
           keyboard: false 
        });

    var sucursalID = $(this).find('.sucursalID').val();

    $(".laod-material-view").show(); 
    $(".laod-material-view").load("../inventario/Cinventario/viewAddMetarialSucursal/"+sucursalID);
  });
//------------------Fin codigo para agregar materiales------------------- 
//-----Cargar modale para ver adicionales---------------------------------
  $(".agregarAdicionales").click(function()
  {
     $(".modelAdicionales").modal({
           backdrop: 'static', 
           keyboard: false 
        });

    var sucursalID = $(this).find('.sucursalID').val();

    $(".load-adcionales-view").show(); 
    $(".load-adcionales-view").load("../inventario/Cinventario/viewListAdicionales/"+sucursalID);
  });
//------------------Fin codigo-------------------------------------- 

//-------------Funcionalida pare regresar pantalla previa-----------------
  $(".backto").click(function()
  {
      $(".conten-sucursales").show();
      $(".load-inventario").hide();
  });
//------------Fin--------------------------------------------------------
 //-------- Quitar Material de la lista de la sucursal -------------------

  $(".quitarMaterial").click(function()
  //$(document).on('click','.quitarMaterial',function() 
  {
    
    var sucursalID = $('.sucursalID').val();
    var idInventarioSucursal=  $(this).find(".inventarioSucursalQ").val();

     $.ajax
      ({
          url: "../inventario/Cinventario/quitar_material_sucursal",
          type: "post",
          data: {idInventarioSucursal:idInventarioSucursal},                           
        
          success: function(data)
          {                                                  
           
            $(".load-inventario").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);
          },
          error:function()
          {

          }
      });
  });
   //-------- ENND Quitar Material de la lista de la sucursal------------------


  //-------- mostrar la configuracion del material-------------------
  $(".configMateriales").click(function()
  //$(document).on('click','.configMateriales',function()   
  {
      var inventarioSucursal = $(this).find(".IdCatalogoInventario").val();
      //alert(inventarioSucursal);
    
      $(".data-materiales").hide();
      $(".load-config-material").show();
      $(".load-config-material").load("../inventario/Cinventario/config_meteriales/"+inventarioSucursal);

  });
  //-------------------------Fin -----------------------------------


//-------- mostrar la configuracion del material-------------------
  $(".addPeidos").click(function()
  //$(document).on('click','.addPeidos',function() 
  {
      var inventarioSucursal = $(this).find(".IdCatalogoInventario").val();
      //var sucursalID = $(this).find(".IdSucursalInventario").val();
      //alert(inventarioSucursal);
    
      $(".data-materiales").hide();
      $(".load-config-material").show();
      $(".load-config-material").load("../inventario/Cinventario/add_pedidoMateriales/"+inventarioSucursal);

  });
  //-------------------------Fin -----------------------------------

//----------------- Open modal view data-------------------
  $(".viewDataM").click(function()
  //$(document).on('click','.viewDataM',function()
  {
     $(".ViewdataModalS").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var inventarioID = $(this).find('.viewDataIDM').val();
    $(".ViewCOntent").load("../inventario/Cinventario/viewInventario/"+inventarioID);
  });
 //--------------Modificar Existencia-------------
 
//----------------- Open modal view data-------------------
  $(".ModificarExist").click(function()
  {
    $(".valCelda").hide();
    $(".inpuExist").show();   
    var inventarioID = $(this).find('.inventarioID').val();
    $(".ViewCOntent").load("../inventario/Cinventario/modificar_existencia/"+inventarioID);
  });
//------ FIn codigo-----------------------------------------

//----------------- vista para agregar adicionales-------------------
  $(".addAdicionales").click(function()
  //$(document).on('click','.addAdicionales',function()   
  {
    var inventarioID = $(this).find('.IdCatalogoInventario').val();
    $(".pages").load("../inventario/Cinventario/add_adicionales/"+inventarioID);
  });   
//-------Fin codigo------------------------------------------

//-----Vista para actualizar info adicionales---------------
  $(".updateAdicional").click(function()
  //$(document).on('click','.updateAdicional',function()   
  {
    var adicionalID = $(this).find('.IdCatalogoInventario').val();
    $(".pages").load("../inventario/Cinventario/Vupdate_adicionales/"+adicionalID);
  });   
//-------Fin codigo------------------------------------------
     
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

</style>

<div class="cont-table-detalle">
  <h1><b>Inventario sucursal  <?php echo $nameSucursal[0]['nombre_sucursal'];?></b></h1>
       <div id="actions-bar">
 <span type="button" style="float:right;background-color: #c75757;" class="btn btn-success agregarMateria">
 <input type="hidden" name="sucursalID" class="sucursalID" value="<?php echo $nameSucursal[0]['id_sucursal'] ?>">
 Agregar material
 </span>  
<span type="button" style="float:right;background-color: #c75757;" class="btn btn-success agregarAdicionales">
 <input type="hidden" name="sucursalID" class="sucursalID" value="<?php echo $nameSucursal[0]['id_sucursal'] ?>">
 Ver Adicionales
 </span>  
<span type="button" style="float:right;background-color: #c75757;" class="btn btn-success backto">
   Regresar
</span>  
    </div> 
<div class="data-materiales">    
<table class="table table-hover table-dynamic" id="inventarioSucursal">
                <thead class='titulos'>
                    <tr>
                        <th>Codigo</th>
                        <th>Material</th>
                        <th>Categoria</th>
                        <th>Existencia</th>                                                                      
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($materiales)) 
                    {

                      foreach ($materiales as $value) 
                      {
                      ?>
                    <tr>
            
                        <td><?php echo $value->codigo_material;  ?></td>
                        <td><?php echo $value->nombre_matarial;  ?></td>
                        <td><?php echo $value->nombre_categoria_materia; ?></td>
                        
                        <?php if($value->total_existencia < $value->minimo_existencia)
                        {
                        ?>
                        <td style="background-color: rgba(199, 87, 87, 0.67);">
                          <p class="valCelda" style="font-size: 20px;text-align: center;">
                          <?php echo $value->total_existencia; ?>
                          </p>
                        </td>  

                        <?php
                        }
                        else{
                        ?>

                        <td>
                          <p class="valCelda" style="font-size: 20px;text-align: center;">
                          <?php echo $value->total_existencia." (". $value->nombre_unidad_medida.")"; ?>
                          </p>
                        </td>                         
                        <?php } ?>  

                        <td>
                        <?php if($value->minimo_existencia != 0)
                        {
                        ?>
                         <button type="button" class="btn btn-primary  btn-sm configMateriales">
                        <input type="hidden" name="IdCatalogoInventario" class="IdCatalogoInventario" value="<?php echo $value->id_inventario_sucursal ?>">
                        <input type="hidden" name="IdSucursalInventario" class="IdSucursalInventario" value="<?php echo $value->id_sucursal ?>">config
                        <li class='fa fa-check-circle-o' style="font-size: 16px;"></li>
                        </button>

                        <?php
                        }
                        else{
                        ?>

                         <button type="button" class="btn btn-primary  btn-sm configMateriales">
                        <input type="hidden" name="IdCatalogoInventario" class="IdCatalogoInventario" value="<?php echo $value->id_inventario_sucursal ?>">
                        <input type="hidden" name="IdSucursalInventario" class="IdSucursalInventario" value="<?php echo $value->id_sucursal ?>">config
                        </button>                     
                        <?php } ?>  
                       
                                  
                            
                            <button type="button" class="btn btn-primary  btn-sm viewDataM">
                            <input type="hidden" name="viewDataIDM" class="viewDataIDM" value="<?php echo $value->id_inventario_sucursal ?>">Ver
                            </button>


                            <button type="button" class="btn btn-primary  btn-sm quitarMaterial">
                            <input type="hidden" name="inventarioSucursalQ" class="inventarioSucursalQ" value="<?php echo $value->id_inventario_sucursal ?>">Quitar
                            </button>


                            <button type="button" class="btn btn-primary  btn-sm addPeidos">
                            <input type="hidden" name="IdCatalogoInventario" class="IdCatalogoInventario" value="<?php echo $value->id_inventario_sucursal ?>">Agregar
                            <input type="hidden" name="IdSucursalInventario" class="IdSucursalInventario" value="<?php echo $value->id_sucursal ?>">
                            </button>

                          <?php if(is_null($value->id_materiales_adicionales))
                        {
                        ?>
                        <button type="button" class="btn btn-primary  btn-sm addAdicionales">
                            <input type="hidden" name="IdCatalogoInventario" class="IdCatalogoInventario" value="<?php echo $value->id_inventario_sucursal ?>">
                            Adicional
                            </button>

                        <?php
                        }
                        else{
                        ?>

                        <button type="button" class="btn btn-primary  btn-sm updateAdicional">
                            <input type="hidden" name="IdCatalogoInventario" class="IdCatalogoInventario" value="<?php echo $value->id_materiales_adicionales ?>">
                            Adicional
                            <li class='fa fa-check-circle-o' style="font-size: 16px;"></li>
                            </button>                  
                        <?php } ?>  
                            
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

  <div class="load-config-material" style="display:none;"></div>    
</div>




<!-- Codigo de funcionalidad de Modals agregar material de trabajo-->
<div class="modal fade modelAddMaterial" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content deleModal">
       <span type="button" style="font-size: 50px;pacity: 1; color: #fff;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Agregar Material a sucursal
          </h4>
          <hr>
            <div class="laod-material-view" style="display:none;padding: 12px;"></div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  

<!-- Codigo de funcionalidad de Modal para ver lista adicionales-->
<div class="modal fade modelAdicionales" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content deleModal">
       <span type="button" style="font-size: 50px;pacity: 1; color: #fff;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Ver Adicionales
          </h4>
          <hr>
            <div class="load-adcionales-view" style="display:none;padding: 12px;"></div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals -->  



<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ViewdataModalS" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
            Ver material
          </h4>
          <hr>
        <div class="modal-body ViewCOntent">

            
          
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  
