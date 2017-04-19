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
<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">

<script>
$(document).ready(function()
  {
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


//----------------modificar data---------------
    $(".EditData").click(function() 
    {
       $(".AddUnidadMedidaEdit").modal({
           backdrop: 'static', 
           keyboard: false 
        });

        var unidadID = $(this).find('.dataModifiID').val();
        $(".laod-tipoModificar").show();
        $(".laod-tipoModificar").load("../productos/Cproductos/editDataControllUnidad/"+unidadID); 
    });

 //----------------------Edita data code END-------------
 
  

  //--------------------Delete caegoria------------------------------ 
  $(".deleteBTN").click(function()
  {
      var dataDeleteID = $(this).find('.dataDeleteID').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../productos/Cproductos/delete_dataUnidad",
          type:"post",
          data: {dataDeleteID:dataDeleteID},
          success: function(message)
          {
            alert("Se elimino correctamente la informacion");
            $(".pages").load("../productos/Cproductos/unidadMedida");
          },
          error:function()
          {
            alert("failure");
          }
      });

  });
  //-------------------------Fin -----------------------------------
 
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

</style>

<div class="cont-table-detalle">
  <div class="bar-other-actions" style="float: right;">
      <button type="button" class="btn btn-primary agregarUnidaMedida" style="background-color: #c75757;">
        <input type="hidden" name="detalleID" class="detalleID"> Agregar Unidad de medida
      </button>
      <button type="button" class="btn btn-primary verTipoUnidades" style="background-color: #c75757;">
       Ver Tipos de Magnitud
      </button>
  </div>
  <div class="clear"></div>
  <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre Unidad</th>
                        <th>Simbolo</th>
                        <th>valor Unidad</th>                        
                        <th>Tipo Unidad</th>                                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($unidadMedida)) 
                    {
                      //var_dump($unidadMedida);
                      foreach ($unidadMedida as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>
                        <td><?php echo $value->simbolo_unidad_medida;  ?></td>
                        <td><?php echo $value->valor_unidad_medida;  ?></td>
                        <td><?php echo $value->name_tipo_unidad_medida;  ?></td>                         
                        <td>
                           <button type="button" class="btn btn-primary btn-sm EditData">
                            <input type="hidden" name="dataModifiID" class="dataModifiID" value="<?php echo $value->id_unidad_medida ?>">Modificar
                          </button>
                          <button type="button" class="btn btn-primary btn-sm deleteBTN">
                            <input type="hidden" name="dataDeleteID" class="dataDeleteID" value="<?php echo $value->id_unidad_medida ?>">Eliminar
                            </button>
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          //echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 
                   
    </tbody>   
  </table>
</div>



<!-- Codigo de funcionalidad de Modals agregar unidades de medida    -->
<div class="modal fade AddUnidadMedida" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Agregar Unidad de medida
          </h4>
          <hr>
        <div class="modal-body">
        <div class="form-principal">
           <form id="unidadMedidaAdd" method="POST">
            <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreUnidad" required name="nombreUnidad" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre Unidad</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="simbolo" name="simbolo" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Simbolo</span>
                      </label>
                  </span>
                </div>  
           </div>              
  <div class="col-md-12">
                <div class="col-md-6">   
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="valorUnidad" name="valorUnidad" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Valor de unidad</span>
                      </label>
                  </span>
                </div>
                  

                <div class="col-md-6"> 
                   <span class="input input--hoshi">
                        <span class="input__label-content">Unida Medida</span>
                        <select class="form-control form-grey" name="tipoUnidad" id="tipoUnidad" data-style="white" data-placeholder="Seleccion una categoria">
                        <?php
                        foreach ($tipoUnidad as $value) {
                          ?>
                          <option value="<?php echo $value->id_tipo_unidad_medida ?>"><?php echo $value->name_tipo_unidad_medida?>
                          </option>
                          <?php
                        }
                        ?>                      
                        </select>
                        <p id="saveTipoUnidadMedida" style="margin-top: 9px;margin-left: 4px;" class="btn btn-info">Agregar</p>
                        
                     </span>
                  </div>  
                  

                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveUnidadMedida" class="btn btn-primary">Guardar</button>
                  </span>
                </div>
             </div>

           </form>
           </div>



          <div class="form-tipoUnidad" style="display: none;">
            <form id="TipoUnidadMedidaAdd" method="POST">
            <div class="col-md-12">
            <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreTipoUnidad" required name="nombreTipoUnidad" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre Tipo Unidad</span>
                      </label>
                  </span>
               </div>    
             <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="TipoUnidadAdd" class="btn btn-primary">Guardar</button>
                     <button type="button" id="CancelTipoUnidadAdd" class="btn btn-primary">Cancelar</button>
                  </span>
                </div>
             
             </form>     
           </div>     
                 

        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  



<!-- Codigo de funcionalidad de Modals para editar tipo de unidad de medid -->
<div class="modal fade AddUnidadMedidaEdit" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Modificar tipo de unidad de medida
          </h4>
          <hr>
        <div class="modal-body">
          <div class="laod-tipoModificar" style="display: none;"></div> 
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
</div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  