<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../inventario/Cinventario/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveUpdateInventario").click(function()
      {
        $.ajax
           ({
            url: "../inventario/Cinventario/update_inventario",
            type:"post",
            data: $("#addUpdatedInventario").serialize(),
            success: function()
            {
              //alert("Proveedor agregado correctamente");
              $(".pages").load("../inventario/Cinventario/index"); 
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
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedor">Regresar</button>
<h1>Modificar material</h1>
<hr/>
<div class="addIngredientes">
<form id="addUpdatedInventario" action="post">
 <?php
    //var_dump($material);
    foreach ($material as $value) 
      {
  ?>
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreMaterial" required name="nombreMaterial" value="<?php echo $value->nombre_matarial;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre material</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionP" name="descripcionP" required value="<?php echo $value->descripcion_meterial;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion material</span>
                      </label>
                  </span>
                </div>  
  </div> 
   <div class="col-md-12" style="margin-left: 20px;font-weight: bold;">
        <div class="col-md-6">   
          <span>Categoria:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey categoriaMaterial" name="categoriaMaterial"  data-style="white" data-placeholder="Seleccione una categoria...">
            <?php
                        foreach ($categoria as $valueCatego) 
                        {
                          
                          if($valueCatego->id_categoria_materia != $value->id_categoria_material)
                          {
                        ?>

                            <option value="<?php echo $valueCatego->id_categoria_materia ?>"><?php echo $valueCatego->nombre_categoria_materia?>
                            </option>
                        <?php
                          }
                          else
                          {
                        ?>    

                          <option selected="selected" value="<?php echo $valueCatego->id_categoria_materia ?>"><?php echo $valueCatego->nombre_categoria_materia?>
                            </option>
                          
                        <?php 
                          }
                        }
                        ?>                      
            </select>
          <span>           
          </div>  


          <div class="col-md-6">   
          <span>Estatus:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey estatusMateria" name="estatusMateria"  data-style="white" data-placeholder="Seleccione un estado...">
         <?php
                        foreach ($estatus as $valueEstatus) 
                        {
                          
                          if($valueEstatus->id_estatus != $value->estatus)
                          {
                        ?>

                            <option value="<?php echo $valueEstatus->id_estatus ?>"><?php echo $valueEstatus->nombre_estatus?>
                            </option>
                        <?php
                          }
                          else
                          {
                        ?>    

                          <option selected="selected" value="<?php echo $valueEstatus->id_estatus ?>"><?php echo $valueEstatus->nombre_estatus?>
                            </option>
                          
                        <?php 
                          }
                        }
                        ?>                      
                        
          </select> 
          <span>            
          </div>  

          <div class="col-md-6">   
          <span>Unidad de media:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey unidadMedida" name="unidadMedida"  data-style="white" data-placeholder="Seleccione un Unidad...">
          <?php
                        foreach ($unidaMedida as $valueUnidad) 
                        {
                          
                          if($valueUnidad->id_unidad_medida != $value->id_unidad_medida)
                          {
                        ?>

                            <option value="<?php echo $valueUnidad->id_unidad_medida ?>"><?php echo $valueUnidad->nombre_unidad_medida?>
                            </option>
                        <?php
                          }
                          else
                          {
                        ?>    

                          <option selected="selected" value="<?php echo $valueUnidad->id_unidad_medida ?>"><?php echo $valueUnidad->nombre_unidad_medida?>
                            </option>
                          
                        <?php 
                          }
                        }
                        ?>                      
                       
          </select> 
          <span>  
          </div>
 </div>                   
   
                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveUpdateInventario" class="btn btn-primary">
                     <input type="hidden" name="inventarioID" id="inventarioID" value="<?php echo $value->id_inventario ?>">
                     Actualizar</button>
                  </span>
                </div>

   <?php
      }          
    ?>               
  </div> 
  </form>
</div>