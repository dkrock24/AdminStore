<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../productos/Cproductos/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveProduct").click(function()
      {
        $.ajax
           ({
            url: "../productos/Cproductos/udpate_producto",
            type:"post",
            data: $("#modificarProdcuto").serialize(),
            success: function()
            {
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
<div class="addIngredientes">
<form id="modificarProdcuto" action="post">
 <?php
    foreach ($producto as $value) 
      {
  ?>
          
        <div class="row line col-md-12">
        <form enctype="multipart/form-data" id="productos" method="POST">
        <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
          <div class="col-md-6"> 
            <span class="input input--hoshi">
            <input class="input__field input__field--hoshi" type="text" id="nombre" name="nombre" value="<?php echo $value->nombre_producto; ?>" />
            <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
            <span class="input__label-content">Nombres</span>
            </label>
            </span>
          </div>        

        <div class="col-md-6"> 
        <span class="input input--hoshi">
        <span class="input__label-content">Categoria</span>
        <select  class="form-control form-grey" name="categoria" id="categoria" data-style="white" data-placeholder="Seleccion una categoria" required>
        <?php
        foreach ($catego as $values) 
        {
          $selected = ($value->id_categoria_producto == $value->categoria_id) ? "selected" : " " ;
        ?>
          <option value="<?php echo $values->id_categoria_producto ?>" <?php echo $selected; ?> ><?php echo $values->nombre_categoria_producto?>
          </option>
        <?php
          }
        ?>                      
         </select>               
        </span>
        </div>

        <div class="col-md-12"> 
        <span class="input input--hoshi">
          <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" value="<?php echo $value->description_producto; ?>" />
          <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
          <span class="input__label-content">Descripción</span>
          </label>
        </span>
        <div class="col-md-6">       
                  
                   <span class="input input--hoshi">
                     <button type="button" id="saveProduct" class="btn btn-primary">Modificar</button>
                  </span>
                
            </div> 
            </form>  
        </div>
   <?php
      }          
    ?>               
</form>
</div>