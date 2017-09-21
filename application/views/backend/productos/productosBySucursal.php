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
    if ($(".precioData").text() != "Null") 
    {
      alert("Desea modificar el precio actual");
    }
    
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
    <?php
        if (!empty($productoByS)) 
        {
          //var_dump($productoByS);
          foreach ($productoByS as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="col-md-4" >
               <div class="thumbnail" style="height: 330px !important;">
              
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
                <img src="../../../assets/images/productos/<?php echo $value->image ?>"  height="150" width="170">
                <div class="caption" style="word-wrap: break-word;padding: 0px;padding: 6px;">
                  <h3><?php echo $value->nombre_producto ?></h3>
                   <span class="precioData">Precio: <?php echo $precio = ($value->precio == null) ? "Null" : $value->precio; ?></span>
                  <p>
                    <a class="btn btn-primary  btn-sm assignarPrecio"  role="button">
                    Precio 
                    <input type="hidden" name="idIntermedia" class="idIntermedia" value="<?php echo $value->id ?>">

                    </a> 

                    <a class="btn btn-primary  btn-sm validarIngre"  role="button" title="Valida existencia de ingredientes en inventario">
                    Ingredientes 
                    <input type="hidden" name="IdValidar" class="IdValidar" value="<?php echo $value->id_producto ?>">
                    <input type="hidden" name="IdProductoSucursal" class="IdProductoSucursal" value="<?php echo $value->id ?>">
                     <input type="hidden" name="IdSucursal" class="IdSucursal" value="<?php echo $value->id_sucursal ?>">
                    </a> 

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
                      
                  </p>
                </div>
              </div>
            </div>
            <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 

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
      <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
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