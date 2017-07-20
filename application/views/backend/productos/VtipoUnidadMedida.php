<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">

<script>
$(document).ready(function()
  {

    //----------------go to add proveedores---------------
    $(".bacKunidadMedida").click(function()
    {
       $(".pages").load("../productos/Cproductos/unidadMedida"); 
    });
    //-------------------------Fin ------------------



    $(".agregarUnidaMedida").click(function()
    {
        $(".AddUnidadMedida").modal({
           backdrop: 'static', 
           keyboard: false 
        });

    });


  //-----------------Jquery insercion de  productos----------------
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
          $(".pages").load("../productos/Cproductos/tipoUnidadMedida"); 
        },
        error:function()
        {

        }
    });

  });
  //-------------------------Fin -----------------------------------   

  //----------------modificar data---------------
    //$(".EditData").click(function()
    $(document).on('click','.EditData',function() 
    {
       $(".AddUnidadMedidaEditTipo").modal({
           backdrop: 'static', 
           keyboard: false 
        });

        var tipoUnidadID = $(this).find('.dataModifiID').val();
        $(".laod-tipoModificar").show();
        $(".laod-tipoModificar").load("../productos/Cproductos/editDataControllTipo/"+tipoUnidadID); 
    });

 

  //--------------------Delete caegoria------------------------------ 
  $(".deleteBTN").click(function()
  //$(document).on('click','.deleteBTN',function()  
  {
      var dataDeleteID = $(this).find('.dataDeleteID').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../productos/Cproductos/delete_dataTipo",
          type:"post",
          data: {dataDeleteID:dataDeleteID},
          success: function(message)
          {
            alert("Se elimino correctamente la informacion");
            $(".pages").load("../productos/Cproductos/tipoUnidadMedida");
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
  <div class="bar-other-actions"  style="float: right;">
      <button type="button" class="btn btn-primary bacKunidadMedida" style="background-color: #c75757;">
        Regresar
      </button>
      <button type="button" class="btn btn-primary agregarUnidaMedida" style="background-color: #c75757;">
        Agregar Magnitud
      </button>
  </div>
  <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th width="40%">Nombre Magnitud</th>                   
                        <th width="40%">Fecha Creacion</th>                                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($tipoUnidad)) 
                    {
                      foreach ($tipoUnidad as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->name_tipo_unidad_medida;  ?></td>
                        <td><?php echo $value->fecha_creacion;  ?></td>                         
                        <td>
                    
                          <button type="button" class="btn btn-primary  btn-sm EditData">
                            <input type="hidden" name="dataModifiID" class="dataModifiID" value="<?php echo $value->id_tipo_unidad_medida ?>">Modificar
                          </button>
                          <button type="button" class="btn btn-primary  btn-sm deleteBTN">
                            <input type="hidden" name="dataDeleteID" class="dataDeleteID" value="<?php echo $value->id_tipo_unidad_medida ?>">Eliminar
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



<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade AddUnidadMedida" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Agregar Magnitud
          </h4>
          <hr>
        <div class="modal-body">

          <div class="form-tipoUnidad">
            <form id="TipoUnidadMedidaAdd" method="POST">
            <div class="col-md-12">
            <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreTipoUnidad" required name="nombreTipoUnidad" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre de Magnitud</span>
                      </label>
                  </span>
               </div>    
             <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="TipoUnidadAdd" class="btn btn-primary">Guardar</button>
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
<div class="modal fade AddUnidadMedidaEditTipo" role="dialog" tabindex="-1">
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
