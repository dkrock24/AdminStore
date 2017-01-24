<script type="text/javascript">
  $(".associateBranch").click(function()
    {
       var prodcutoID = $(this).find('.idProducto').val();
       //alert(prodcutoID);
      $(".pages").load("../productos/Cproductos/loadSucursales/"+prodcutoID); 
    });

  $(".viewDetalle").click(function()
    {
        $(".myModalDetalle").modal({
           backdrop: 'static', 
           keyboard: false 
        });

        var prodcutoID = $(this).find('.idProducto').val();
        //alert(prodcutoID);
        $(".cont-detalleView").load("../productos/Cproductos/detalleProducto/"+prodcutoID);

    });



  $(".deletePC").click(function()
  {
     $(".modalEliminarC").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var prodcutoID = $(this).find('.idProducto').val();
    $("#prodcutoIDYes").val(prodcutoID);
  });


  $(".deleteNotC").click(function()
  {

     $('.modalEliminarC').modal('toggle'); 

  });
  //-------------------------Fin -----------------------------------

 
  $(".deleteYesC").click(function()
  {
      var ProductoId = $(this).find('#prodcutoIDYes').val();
      var ProductoName = $(".deletePC").find('.ImageName').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../productos/Cproductos/delete_producto",
          type:"post",
          data: {ProductoId:ProductoId,ProductoName:ProductoName},
          success: function(message)
          {
            alert(message);
            $(".pages").load("../productos/Cproductos/index");
          },
          error:function()
          {
            alert("failure");
          }
      });

  });
  //-------------------------Fin -----------------------------------
</script>
<div class="row col-lg-12 conten-productos">
    <?php
        if (!empty($producto)) 
        {
          foreach ($producto as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="col-md-4">
              <div class="thumbnail" style="height: 400px;">
                <img src="../../../assets/images/productos/<?php echo $value->image ?>" alt="...">
                <div class="caption" style="word-wrap: break-word;">
                  <h3><?php echo $value->nombre_producto ?></h3>
                  <p><?php echo $value->description_producto ?></p>
                  <p>
                    <a class="btn btn-primary  btn-sm associateBranch" style="margin-left: -9px;" role="button">Asociar
                        <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">

                        </a> 
                        <a class="btn btn-primary  btn-sm viewDetalle" style="margin-left: -9px;" role="button">Detalle
                        <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>"></a>
                        
                        <a class="btn btn-primary  btn-sm deletePC" style="margin-left: -9px;" role="button">Eliminar
                          <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                          <input type="hidden" name="ImageName" class="ImageName" value="<?php echo $value->image ?>">
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






<!-- Codigo de funcionalidad de Modals eliminar dproductos-->
<div class="modal fade modalEliminarC" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Eliminar Datos
          </h4>
          <hr>
        <div class="modal-body">
           <div class="cont-message"  style="font-size: 30px;padding: 12px;margin: 6px;">
           <span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size: 60px;color: #bb1212;"></span>
             Seguro que desea eliminar la informacion seleccionada
           </div>
           <hr>
           <div class="bar--action" style="float: right;">
             <span class="btn btn-warning deleteNotC">Cancelar</span>
             <span class="btn btn-warning deleteYesC">
              <input type="hidden" name="prodcutoIDYes" id="prodcutoIDYes" val="">
             Eliminar</span>
           </div>
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  
