<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../inventario/Cinventario/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveUpdaCategoria").click(function()
      {
        $.ajax
           ({
            url: "../inventario/Cinventario/update_inventarioCategoria",
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
  .label-current
  {
    padding: 8px;
    background-color: #c75757;
    margin: 4px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
    font-size: 12px;
    color: #fff;

  }

</style>
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedor">Regresar</button>
<h1>Modificar Categoria materiales</h1>
<hr/>
<div class="addIngredientes">
<form id="addUpdatedInventario" action="post">
 <?php
    //var_dump($material);
    foreach ($categoria as $value) 
      {
  ?>
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreCategoria" required name="nombreCategoria" value="<?php echo $value->nombre_categoria_materia;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre Categoria</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionP" name="descripcionP" required value="<?php echo $value->descripcion_categoria_materia;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion Categoria</span>
                      </label>
                  </span>
                </div>  
  </div> 
   <div class="col-md-12" style="margin-left: 20px;font-weight: bold;">
        <div class="col-md-6">   
          <span>Estatus:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey estatusCat" name="estatusCat"  data-style="white" data-placeholder="Seleccione una categoria...">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>                     
            </select><span class="label-current">Actual:   <?php echo $value->cateStatus;  ?></span>
          <span>           
          </div>  
    </div>                   
   
                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveUpdaCategoria" class="btn btn-primary">
                     <input type="hidden" name="inventarioID" id="inventarioID" value="<?php echo $value->id_categoria_materia ?>">
                     Actualizar</button>
                  </span>
                </div>

   <?php
      }          
    ?>               
  </div> 
  </form>
</div>