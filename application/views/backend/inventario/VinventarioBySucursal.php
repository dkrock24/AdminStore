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
  <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre Unidad</th>
                        <th>Simbolo</th>
                        <th>valor Unidad</th>                        
                        <th>Fecha Creacion</th>                                                
                        <th>Acciones</th>
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
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>
                        <td><?php echo $value->Símbolo_unidad_medida;  ?></td>
                        <td><?php echo $value->valor_unidad_medida;  ?></td>
                        <td><?php echo $value->fecha_creacion;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_unidad_medida ?>">Modificar
                          </button>
                          <button type="button" class="btn btn-primary">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_unidad_medida ?>">Eliminar
                            </button>
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 
                   
    </tbody>   
  </table>
</div>



