<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../productos/Cproductos/tipoUnidadMedida"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveDataModi").click(function()
      {
        $.ajax
           ({
            url: "../productos/Cproductos/save_updatedUnidad",
            type:"post",
            data: $("#addDataModifi").serialize(),
            success: function()
            {
              //alert("Proveedor agregado correctamente");
              $(".pages").load("../productos/Cproductos/unidadMedida"); 
            },
            error:function(){
                alert("failure");
            }
          });

      });
      //-------------------------Fin -----------------------------------
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
<div class="addIngredientes">
<form id="addDataModifi" action="post">
 <?php
    //var_dump($unidadData);
    foreach ($unidadData as $value) 
      {
  ?>
 <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreUnidad" required name="nombreUnidad" value="<?php echo $value->nombre_unidad_medida;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="simboloUnidad" name="simboloUnidad" required value="<?php echo $value->simbolo_unidad_medida;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Simbolo</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                        <span class="input__label-content">Tipo unidad</span>
                        <select style="width: 60%;" class="form-control form-grey" name="tipoUnidada" id="tipoUnidada" data-style="white" data-placeholder="Seleccion una categoria">
                         
                        <?php
                        foreach ($tipoUnidad as $valueTipo) 
                        {
                          
                          if($valueTipo->id_tipo_unidad_medida != $value->id_tipo_unidad_medida)
                          {
                        ?>

                            <option value="<?php echo $valueTipo->id_tipo_unidad_medida ?>"><?php echo $valueTipo->name_tipo_unidad_medida?>
                            </option>
                        <?php
                          }
                          else
                          {
                        ?>    

                          <option selected="selected" value="<?php echo $valueTipo->id_tipo_unidad_medida ?>"><?php echo $valueTipo->name_tipo_unidad_medida?>
                            </option>
                          
                        <?php 
                          }
                        }
                        ?>                      
                        </select>
            
                  
                  </span>          
                 </div>  
              
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="valorUnidad" name="valorUnidad" required value="<?php echo $value->valor_unidad_medida;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Valor unidad</span>
                      </label>
                  </span>
                </div>  
        </div>  
                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveDataModi" class="btn btn-primary">
                     <input type="hidden" name="IdModifi" id="IdModifi" value="<?php echo $value->id_unidad_medida ?>">
                     Guardar</button>
                  </span>
                </div>

   <?php
      }          
    ?>               
  </div> 
  </form>
</div>