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


  $(".assignarPrecio").click(function()
  {
    if ($(".precioData").text() != "Null") 
    {
      alert("Desea modoficar el precio actual");
    }
    
    $(".modalAsignarPrecio").modal({
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
         
          $('.myModalDetalle').modal('toggle');
          $(".pages").load("../productos/Cproductos/index/"); 
        },
       
      });
  });
      //-------------------------Fin -----------------------------------

</script>
<div class="bar-other-actions">
      <button type="button" class="btn btn-success backSucursales" style="float: right;background-color: #c75757;">
         Regresar a Sucursales
      </button>
  </div
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
            <div class="col-md-4">
              <div class="thumbnail" style="height: 350px;">
                <img src="../../../assets/images/productos/<?php echo $value->image ?>">
                <div class="caption" style="word-wrap: break-word;">
                  <h3><?php echo $value->nombre_producto ?></h3>
                   <span class="precioData">Precio: <?php echo $precio = ($value->precio == null) ? "Null" : $value->precio; ?></span>
                  <p>
                    <a class="btn btn-primary  btn-sm assignarPrecio"  role="button">
                    Asignar Precio 
                    <input type="hidden" name="idIntermedia" class="idIntermedia" value="<?php echo $value->id ?>">

                    </a> 
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
<div class="modal fade modalAsignarPrecio" role="dialog" tabindex="1" style="idth: 60%;margin-left: 20%;">
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