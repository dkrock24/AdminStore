<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script>
   $("#addProveedorItem").click(function()
    {
      alert('ready');

    });

   $("#nextMaterial").click(function()
    {
      $(".passOne").hide();
      $(".passTwo").show();
      var materialName = $(".materialName").val();
      //alert(materialName);
      $(".titleMaterial").text(materialName);

    });

  $('.tipoMaterial').on('change', function() 
  {
    ///alert(this.value);
    var categoriaMaterialId = this.value;
    $(".load-Materiales-list").load("../inventario/Cinventario/vieMaterialByCategoria/"+categoriaMaterialId);
  
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
  .titleMaterial
  {
    font-weight: bold;
  }

</style>

<div class="addIngredientes">

<div class="passOne">
    
  <!-- Select dinamico para llamar la lsita de materiales  -->
      <div class="col-md-12">
        <span class="input input--hoshi">
        <span class="input__label-content titleMaterial">Categoria de Materiales</span>
        <select class="form-control form-grey  tipoMaterial" name="tipoMaterial" data-style="white" data-placeholder="Seleccion una categoria">
        <option value="0">N/A </option>
        <?php
          foreach ($categoria as $value) {
        ?>
        <option value="<?php echo $value->id_categoria_materia ?>"><?php echo $value->nombre_categoria_materia?>
        </option>
        <?php
        }
        ?>                      
        </select> 
        </span>
        </div>  
     
  <!--   END select dinamico -- >

  <!--   Cargar de forma dinamica la lista de materiales por categoria -->
         <div class="col-md-12">
          <span class="well center-block list-proveedores"> 
            <div class="load-Materiales-list">
             
            </div>     
          </span> 
           
         </div>         
  <!--  Fin del div que carga los metariales  -->

  <div class="col-md-6"> 
              <span class="input input--hoshi">
                <button type="button" id="nextMaterial" class="btn btn-primary">Siguiente</button>
              </span>
            </div>
  </div>
</div>


<div class="passTwo" style="display: none;">
<div class="col-md-12">
  <h1 class='titleMaterial'></h1>
</div>  

  <form id="addMaterialInventario" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="miniExistencia" required="true"  name="miniExistencia" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Minimo en existencia</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="maximoExistencia" name="maximoExistencia" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Maximo en existencia</span>
                      </label>
                  </span>
                </div>  
  </div>              
  

 <div class="col-md-12">   
          <H1>Lista de proveedores para este material  </H1><br>
            <span class="well center-block list-proveedores"> 
              <table class="table table-hover">
                <thead class='titulos'>
                    <tr>
                        <th width="60%">Nombre proveedor</th>
                        <th width="30%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($proveedores)) 
                    {
                      //var_dump($proveedores);
                      foreach ($proveedores as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_proveedor;  ?></td>
                        <td>
                          </button>
                          <button type="button" class="btn btn-primary btn-sm">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_proveedor ?>">Asociar
                          </button>
                          <button type="button" class="btn btn-primary btn-sm">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_proveedor ?>">Agregar Precio
                            </button>
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
           
      ?> 
                   
    </tbody>   
  </table>
  </span>            
  </div>  
  
 <div class="col-md-12">
          <div class="col-md-6"> 
            <span class="input input--hoshi">
              <button type="button" id="saveMaterial" class="btn btn-primary">Guardar</button>
            </span>
          </div>


  </form>
  </div>
</div>