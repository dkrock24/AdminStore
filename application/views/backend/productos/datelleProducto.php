<script>
  
  $(".agregarIngrediente").click(function()
  {
    
    $(".cont-table-detalle").hide();
    $(".addIngredientes").show();

  });

   //-----------------Jquery insercion de  ingredientes----------------
  $("#saveDetalle").click(function()
  {
  
      $.ajax
      ({
        url: "../productos/Cproductos/save_ingrediente",
        type: "post",
        data: $('#addIngredienteForm').serialize(),                           
      
        success: function(data)
        {                                                  
         
          $('.myModalDetalle').modal('toggle');
          $(".pages").load("../productos/Cproductos/index"); 
        },
        error:function()
        {

        }
      });
  });
  //-------------------------Fin -----------------------------------

   $("#ingrediente").autocomplete({
        source: "../productos/Cproductos/catalogo_materiales",
        minLength: 1
  });

 //---------------------  Add checkec ingredientes completos----------
  $("#ingredientteCompleto").click( function()
  {
      var productoID = $(".agregarIngrediente").find(".detalleID").val();
      //alert(productoID);    
      if( $(this).is(':checked') ) 
      {
         //alert('estoy cehcked');
         $.ajax
          ({
            url: "../productos/Cproductos/completos_ingrediente",
            type: "post",
            data: {IngrendienteStatus:"1",productoID:productoID},                                
          
            success: function(data)
            {                                                  
             
              alert(data);
               $(".pages").load("../productos/Cproductos/index"); 
            },
            error:function()
            {

            }
          });
        
      }
      else
      {
         //alert('estoy uncehcked');
         $.ajax
          ({
            url: "../productos/Cproductos/incompletos_ingrediente",
            type: "post",
            data: {IngrendienteStatus:"0",productoID:productoID},                           
          
            success: function(data)
            {                                                  
             
               alert("A este producto le hacen falta ingredientes");
                $(".pages").load("../productos/Cproductos/index"); 
            },
            error:function()
            {

            }
          });
        
      }  
  });
 //----------------End ingredientes comletos------------------------- 

  //-----------------quitar ingredientes----------------
  $(".quitarDetalle").click(function()
  {
      var detalleId = $(this).find(".detalleID").val();
      $.ajax
      ({
        url: "../productos/Cproductos/quitar_detalle",
        type: "post",
        data: {detalleId:detalleId},                           
      
        success: function(data)
        {                                                  
         
          $('.myModalDetalle').modal('toggle');
          //$(".pages").load("../productos/Cproductos/index"); 
        },
        error:function()
        {

        }
      });
  });
  //-------------------------Fin -----------------------------------
</script>
 <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 
</head>
<style>
  .ui-autocomplete { 
    z-index:2147483647;
  
  }
  .ui-autocomplete {
    position: absolute;
}

#container_tags {
    display: block; 
    position:relative
}
  .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
</style>
<div class="cont-table-detalle">
  <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Igrediente</th>
                        <th>Descripcion</th>
                        <th>Cantidad</th>                        
                        <th>Medida</th>                                                
                        <th width="15%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($detalle)) 
                    {
                      //var_dump($detalle);
                      foreach ($detalle as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_matarial;  ?></td>
                        <td><?php echo $value->descripcion;  ?></td>
                        <td><?php echo $value->cantidad;  ?></td>
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary quitarDetalle">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_detalle_producto ?>">Eliminar
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
  <div style="font-size:14px; font-weight: bold;margin: 8px;">
  <?php
  //var_dump($ingredienteC);
  if ($ingredienteC[0]['ingredientes_completos'] != "0") 
  {
  ?>

    <input type="checkbox" id="ingredientteCompleto" name="ingredientteCompleto" checked> Ingredientes completos<br>
  <?php
  }
  else
  {?>
        <input type="checkbox" id="ingredientteCompleto" name="ingredientteCompleto" > Ingredientes completos<br>
  <?php
  }
  ?>
  </div>
  <div class="bar-other-actions">
      <button type="button" style="background-color: #c75757; float: left;" class="btn btn-success agregarIngrediente">
        <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $productoID; ?>"> Agregar Ingrediente
      </button>
  </div>
</div>



<div class="addIngredientes" style="display:none;">
<form id="addIngredienteForm" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
               <div class="content">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="ingrediente" required name="ingrediente" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Ingrediente</span>
                      </label>
                  </span>
                </div>
                
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>
                </div>  
  </div>              
  <div class="col-md-12">
                <div class="col-md-6">   
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="cantidad" name="cantidad" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Cantidad</span>
                      </label>
                  </span>
                </div>
                  

                <div class="col-md-6"> 
                   <span class="input input--hoshi">
                        <span class="input__label-content">Unida Medida</span>
                        <select class="form-control form-grey" name="unidaMedida" id="unidaMedida" data-style="white" data-placeholder="Seleccion una categoria">
                         <option value="0">N/A </option>
                        <?php
                        foreach ($unidadMedida as $value) {
                          ?>
                          <option value="<?php echo $value->id_unidad_medida ?>"><?php echo $value->nombre_unidad_medida?>
                          </option>
                          <?php
                        }
                        ?>                      
                        </select>
                    
                        
                     </span>
                  </div>  
                  

                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                   <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $productoID ?>">
                     <button type="button" id="saveDetalle" class="btn btn-primary">Guardar</button>
                  </span>
                </div>
  </div> 
  </form>
</div>