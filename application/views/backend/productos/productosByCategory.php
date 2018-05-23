
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

/*
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
    */

    $(".viewDetalle").click(function()
    {
        $(".myModalDetalle2").modal({
           backdrop: 'static', 
           keyboard: false 
        });

        var prodcutoID = $(this).find('.idProducto').val();
        //alert(prodcutoID);
        $(".cont-detalleView").load("../productos/Cproductos/detalleProducto2/"+prodcutoID);

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
              ?>
              <table class="table table-hover table-dynamic ">
                    <thead class='titulos'>
                      <tr>
                        <th>Nombre</th>                                          
                        <th>Estado</th>
                        <th>Detalle</th>                        
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($producto){
                    foreach ($producto as $value) {
                            ?>
                             <tr>
                                <td><?php echo $value->nombre_producto;  ?></td>
                                <td></td>
                                <td>
                                    <a class="btn btn-primary  btn-sm associateBranch" style="margin-left: -9px;" role="button">Asociar
                                            <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">

                                            </a> 
                                            <a class="btn btn-primary  btn-sm viewDetalle" style="margin-left: -9px;" role="button">Detalle
                                            <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>"></a>
                                            
                                            <a class="btn btn-primary  btn-sm modifyP" style="margin-left: -9px;" role="button"><i class="fa fa-pencil" aria-hidden="true"></i>
                                              <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                                            </a>

                                            <a class="btn btn-primary  btn-sm deleteP" style="margin-left: -9px;" role="button"><i class="fa fa-trash" aria-hidden="true"></i>
                                              <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                                              <input type="hidden" name="ImageName" class="ImageName" value="<?php echo $value->image ?>">
                                            </a>
                                          <?php if($value->ingredientes_completos != 0)
                                                          {?>
                                            <span class="fa fa-check-circle icoAlert" style="position: absolute; float: right;" title="Ingredientes completos" aria-hidden="true"></span>

                                     <?php }
                                    else{?>
                                           <p class="fa fa-exclamation-triangle icoAlertError" title="Necesita completar ingredientes" aria-hidden="true"></p>
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
              <?php

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
