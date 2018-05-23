 <!-- END PRELOADER -->

    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
 <link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
    <!-- BEGIN PAGE SCRIPT -->
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

<script>
  
  $(".backSucursales").click(function()
  {
    
    $(".conten-sucursales").show();
    $(".load-productoBySucursal").hide();

  });
  

  $("#cancelarAsignacion").click(function()
  {

      $('.modalAsignarPrecio').modal('toggle');

  });

   $("#cancelarAsignacionNodo").click(function()
    {

        $('.modalAsignarNodo').modal('toggle');

    });

  //----------------------Asginacion de precio a productos
  $(".assignarPrecio").click(function()
  {

    $(".modalAsignarPrecio").modal({
           backdrop: 'static', 
           keyboard: false 
        });

     $(".sucursalProdcutoID").val($(this).find(".idIntermedia").val()); 

  });


  //------------------Asignacion de nodo a productos

   $(".assignarNodo").click(function()
  {
  
    $(".modalAsignarNodo").modal({
           backdrop: 'static', 
           keyboard: false 
        });

     $(".sucursalProdcutoID").val($(this).find(".idIntermedia").val()); 

  });

//-----------------Jquery insercion de  precio----------------
  $("#savePrecio").click(function()
  {
      var sucursalProdcutoIdSend = $(".sucursalProdcutoID").val();
      var precio = $("#precio").val();
      //alert(sucursalProdcutoIdSend+precio)
      $.ajax
      ({
        url: "../productos/Cproductos/save_precio",
        type: "post",
        data: {sucursalProdcutoIdSend:sucursalProdcutoIdSend, precio:precio},                           
      
        success: function(data)
        {                                                  
         
          $('.modalAsignarPrecio').modal('toggle');
          $(".pages").load("../productos/Cproductos/index/"); 
        },
       
      });
  });
  //-------------------------Fin -----------------------------------


  //-----------------Jquery insercion de  precio----------------
  $("#saveNodo").click(function()
  {
      var sucursalProdcutoIdSend = $(".sucursalProdcutoID").val();
      var nodoID = $("#nodoID").val();
      //alert(sucursalProdcutoIdSend+nodoID)
      $.ajax
      ({
        url: "../productos/Cproductos/save_nodo",
        type: "post",
        data: {sucursalProdcutoIdSend:sucursalProdcutoIdSend, nodoID:nodoID},                           
      
        success: function(data)
        {                                                  
         
          $('.modalAsignarNodo').modal('toggle');
          $(".pages").load("../productos/Cproductos/index/"); 
        },
       
      });
  });
  //-------------------------Fin -----------------------------------



//-----------------Validar Materiales----------------
  $(".validarIngre").click(function()
  {
      var IdProductoValidar = $(this).find(".IdValidar").val();
      var IDSucursal = $(this).find(".IdSucursal").val();
      var IdProductoSucursal = $(this).find(".IdSucursal").val();
      //alert(IdProductoValidar+":"+IDSucursal);
      $.ajax
      ({
        url: "../productos/Cproductos/validar_materiales",
        type: "post",
        data: {IdProductoValidar:IdProductoValidar,IDSucursal:IDSucursal,IdProductoSucursal:IdProductoSucursal},                           
      
        success: function(data)
        {                  
            $(".conten-sucursales").hide();
            $(".load-productoBySucursal").show();                                
            $(".load-productoBySucursal").load("../productos/Cproductos/productosBySucursal/"+IDSucursal);
        },
       
      });
  });
  //-------------------------Fin -----------------------------------

</script>
<div class="bar-other-actions">
      <button type="button" class="btn btn-success backSucursales" style="float: right;background-color: #c75757;">
         Regresar a Sucursales
      </button>
  </div>


<div class="cont-loadProductos">
  
  <div class="row col-lg-12 conten-productos">


    <table class="table table-hover table-dynamic ">
                    <thead class='titulos'>
                      <tr>
                        <th>Nombre</th>                                          
                        <th>Categoria</th>
                        <th>Sucursal</th>
                        <th>Precio Sugerido</th>
                        <th>Precio Minimo</th>
                        <th>Detalle</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($productoByS){
                    foreach ($productoByS as $value) {
                            ?>
                             <tr>
                                <td><?php echo $value->nombre_producto;  ?></td>
                                <td><?php echo $value->nombre_categoria_producto;  ?></td>
                                 <td><?php echo $value->nombre_sucursal;  ?></td>
                                <td><?php echo $value->numerico1;  ?></td>
                                <td><?php echo $value->precio_minimo;  ?></td>
                                <td>
                                    <?php if($value->verifiDetalle == 0)
                                    {?>
                                        <p class="fa fa-list-ol icoAlert" title="Los ingredientes son correctos" aria-hidden="true"></p>
                                    <?php }
                                    else{?>
                                           <p class="vdetalle" title="Algunos ingredientes no estan en inventario" style="cursor: pointer;">VD</p>
                                    <?php
                                    } 
                                    ?>

                                    <?php if($value->precio != 0)
                                    {?>
                                        <p class="fa fa fa-money icoAlert" title="Precio agregado correctamente" aria-hidden="true"></p>
                                    <?php }
                                    else{?>
                                           <p class="fa fa-exclamation-triangle icoAlertError" title="Necesita agregar un precio" aria-hidden="true"></p>
                                    <?php
                                    } 
                                    ?>

                                    <?php if($value->ingredientes_completos != 0)
                                    {?>
                                        <p class="fa fa-check-circle icoAlert" title="Ingrendiente completados" aria-hidden="true"></p>
                                    <?php }
                                    else{?>
                                           <p class="fa fa-exclamation-triangle icoAlertError" title="Necesita validar que estan completos los ingredientes" aria-hidden="true"></p>
                                    <?php
                                    } 
                                    ?>


                                    <?php if($value->nodoID != null)
                                      {
                                    ?>    
                                        <button class="btn btn-primary  btn-sm assignarNodo"  role="button">Nodo 
                                        <input type="hidden" name="idIntermedia" class="idIntermedia" value="<?php echo $value->id ?>">
                                        <li class="fa fa-check-circle" style="color: #fff;font-size: 16px;"></li>
                                        </button>
                                    <?php
                                    }
                                     else
                                     {
                                     ?> 
                                        <button class="btn btn-primary  btn-sm assignarNodo"  role="button">Nodo 
                                        <input type="hidden" name="idIntermedia" class="idIntermedia" value="<?php echo $value->id ?>">
                                        </button>
                                     
                                    <?php
                                     } 
                                    ?>


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





<!-- Modal para asignar precio al producto por sucur-->
<div class="modal fade modalAsignarPrecio" role="dialog" tabindex="1" style="idth: 60%;">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
      <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Asignar precio
          </h4>
 
           <span class="input input--hoshi">
           <input class="input__field input__field--hoshi" type="text" id="precio" required name="precio" />
           <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
           <span class="input__label-content">Precio de producto</span>
          </label>
          </span>
             
                
     <br>
          <span class="input input--hoshi">
             <input type="hidden" name="sucursalProdcutoID" class="sucursalProdcutoID" value="">
            <button type="button" id="savePrecio" class="btn btn-primary">Guardar Asignacion</button>
             <button type="button" id="cancelarAsignacion" class="btn btn-primary">Cancelar Asignacion</button>
         </span>
     
      </div>
      

    </div>
  </div>
<!-- Fin-->  


<!-- Modal para asignar Nodo a producto por sucur-->
<div class="modal fade modalAsignarNodo" role="dialog" tabindex="1" style="idth: 60%">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
      <h4 class="modal-title" style="background-color: #D82787;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Asignar Nodo
          </h4>
 
          <span class="input input--hoshi">
                        <span class="input__label-content">Nodos</span>
                        <select style="width: 60%;" class="form-control form-grey" name="nodoID" id="nodoID" data-style="white" data-placeholder="Seleccion una categoria">
                        <?php
                        foreach ($nodos as $value) {
                          ?>
                          <option value="<?php echo $value->id_nodo ?>"><?php echo $value->nombre_nodo?>
                          </option>
                          <?php
                        }
                        ?>                      
                        </select>
                     </span>

             
                
     <br>
          <span class="input input--hoshi">
             <input type="hidden" name="sucursalProdcutoID" class="sucursalProdcutoID" value="">
            <button type="button" id="saveNodo" class="btn btn-primary">Guardar Asignacion</button>
             <button type="button" id="cancelarAsignacionNodo" class="btn btn-primary">Cancelar Asignacion</button>
         </span>
     
      </div>
      

    </div>
  </div>
<!-- Fin-->  