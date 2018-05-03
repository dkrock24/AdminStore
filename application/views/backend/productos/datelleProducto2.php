<?php
   session_start()
?>
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 

   
<script>
  $(document).ready(function(){
    $("#saveProducto2").click(function()
    {
        var formulario = document.getElementById('productos');

        var formData = new FormData();
                    formData.append('files', $('#files')[0].files[0]);
                    
                    formData.append('nombre', $('#p_name').val());
                    formData.append('categoria', $('#categoria').val());
                    formData.append('descripcion', $('#p_descripcion').val());
                    formData.append('precio1', $('#p_precio_sugerido').val());
                    formData.append('precio2', $('#p_precio_minimo').val());
              
            $.ajax({
               url: "../productos/Cproductos/update_producto2",
                type:"post",
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                data: formData,

                    success: function(data)
                    {
                      if (data == "3") 
                      {
                        alert("El tamaño de la imagen no es correcto");
                        $(".loading").hide();
                      }                      
                      
                    },
                    error:function(data)
                    {
                        alert(data);
                    }
                });
    });
    
  });
    
  
</script>
 <link rel="stylesheet" href="../../../assets/css/jquery-ui.min.css" type="text/css" /> 
</head>
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
    <form enctype="multipart/form-data" id="productos" method="POST">
    <table class="table table-hover table-dynamic">
        <tr>
            <td>Producto</td>
            <td><input type="" class="form-control" name="" id="p_name" value="<?php echo $detalle[0]->nombre_producto; ?>"></td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td><input type="" class="form-control" name="" id="p_descripcion" value="<?php echo $detalle[0]->description_producto; ?>"></td>
        </tr>
        <tr>
            <td>Precio Sugerido</td>
            <td><input type="" class="form-control" name="" id="p_precio_sugerido" value="<?php echo $detalle[0]->numerico1; ?>"></td>
        </tr>
        <tr>
            <td>Precio Minimo</td>
            <td><input type="" class="form-control" name="" id="p_precio_minimo"  value="<?php echo $detalle[0]->precio_minimo; ?>"></td>
        </tr>
        <tr>
            <td>Categoria</td>
            <td>
                <?php echo $detalle[0]->nombre_categoria_producto; ?>
                <select name="categoria" id="categoria" class="form-control">
                <?php
                foreach ($categoria as $value) {
                    ?>
                    <option value=""><?php echo $value->nombre_categoria_producto; ?></option>
                    <?php
                }
                ?>
                </select>
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <img src="/kaprichos/uploaded/mod_productos/<?php echo $detalle[0]->image; ?>" width="50%">
                <input class="input__field input__field--hoshi" type="file" id="files" name="files[]" required />

            </td>
        </tr>
    </table>
    </form>

  <div class="bar-other-actions">
     <a href="#" id="saveProducto2" class="btn btn-default">Guardar</a>
  </div>
</div>



