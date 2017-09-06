
<?php
   session_start();
?>
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
     <script src="../../../assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="../../../assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="../../../assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="../../../assets/js/pages/search.js"></script> <!-- Search Script -->
  
    <link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet"><script type="text/javascript">
    
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
              //var_dump($producto);
              foreach ($producto as $value) 
              {
              ?>
                
              <!--  Vista dinamica de prodcutos --> 
                <div class="col-md-4">

                  <div class="thumbnail" style="height: 400px;padding: 0px;">
                  <?php if($value->ingredientes_completos != 0)
                {?>
                    <p class="fa fa-check-circle icoAlert" title="Ingredientes completos" aria-hidden="true"></p>
                <?php }
                else{?>
                       <p class="fa fa-exclamation-triangle icoAlertError" title="Necesita completar ingredientes" aria-hidden="true"></p>
                <?php
                } 
                ?>  
                <?php 
                  if($value->video != 'NULL')
                  {
                  ?>
                  <p class="video-div" style="position: absolute;background: #3e9b48;z-index: 1001;bottom: 221px;width: 89%;color: #fff;padding: 4px;cursor: pointer;text-align:center; opacity: 0.9;font-weight: bold;">Ver Video</p> 
                <?php 
                  }
                ?>   
                    
                    <img src="../../../assets/images/productos/<?php echo $value->image ?>" style="max-width: 60%;">
                   
                    <div class="action-btn-img" style="padding: 12px;text-align: center;background: #ecedee;">
                      <a class="btn btn-primary  btn-sm associateBranch" style="margin-left: -9px;" role="button">Asociar
                        <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">

                        </a> 
                        <a class="btn btn-primary  btn-sm viewDetalle" style="margin-left: -9px;" role="button">Detalle
                        <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>"></a>
                        <a class="btn btn-primary  btn-sm deleteP" style="margin-left: -9px;" role="button">Eliminar
                          <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                          <input type="hidden" name="ImageName" class="ImageName" value="<?php echo $value->image ?>">
                        </a>

                 
                    </div>

                    <div class="caption" style="word-wrap: break-word;padding: 0px;padding: 6px;">
                      <h3 style="font-weight: bold;color: #88b32f;"><?php echo $value->nombre_producto ?></h3>
                      <p style="height:100px; overflow: auto;"><?php echo $value->description_producto ?></p>
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
