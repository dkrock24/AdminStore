<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../productos/Cproductos/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveDataModi").click(function()
      {
        $.ajax
           ({
            url: "../productos/Cproductos/save_updated",
            type:"post",
            data: $("#addDataModifi").serialize(),
            success: function()
            {
              //alert("Proveedor agregado correctamente");
              $(".pages").load("../productos/Cproductos/index"); 
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
<h1>Modificar Datos</h1>
<hr/>
<div class="addIngredientes">
<form id="addDataModifi" action="post">
 <?php
    foreach ($categoriaP as $value) 
      {
  ?>
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreModifi" required name="nombreModifi" value="<?php echo $value->nombre_categoria_producto;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre Categoria</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionModifi" name="descripcionModifi" required value="<?php echo $value->descripcion;  ?>"/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>
                </div>  
  </div>              
    
                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveDataModi" class="btn btn-primary">
                     <input type="hidden" name="IdModifi" id="IdModifi" value="<?php echo $value->id_categoria_producto ?>">
                     Guardar</button>
                  </span>
                </div>

   <?php
      }          
    ?>               
  </div> 
  </form>
</div>