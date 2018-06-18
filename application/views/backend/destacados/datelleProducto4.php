<?php
   session_start()
?>
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 

   
<script>
  $(document).ready(function(){
    $("#delete").click(function()
    {
        var formulario = $(this).attr('name');
                    
              
            $.ajax({
               url: "../destacados/Cdestacados/delete_destacado4/"+formulario,
                type:"get",

                    success: function(data)
                    {
                        $(".pages").load("../destacados/Cdestacados/index");                    
                      
                    },
                    error:function(data)
                    {
                        alert(data);
                    }
                });
    });
    
    $(".saveProducto").click(function()
    {
        var formulario = $(this).attr('name');
        var image = $(this).attr('id');
                    
              
            $.ajax({
               url: "../destacados/Cdestacados/save_destacado4/"+formulario+"/"+image,
                type:"get",

                    success: function(data)
                    {
                        $(".pages").load("../destacados/Cdestacados/index");                    
                      
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
            <td rowspan="10" width="30%">
                <img src="/kaprichos/uploaded/mod_productos/<?php echo $detalle[0]->image; ?>" width="100%">
            </td>
            <td>Producto</td>
            <td><?php echo $detalle[0]->nombre_producto; ?></td>
        </tr>
        <tr>
            <td>Descripcion</td>
            <td><?php echo $detalle[0]->description_producto; ?></td>
        </tr>
        <tr>
            <td>Precio Sugerido</td>
            <td><?php echo $detalle[0]->numerico1; ?></td>
        </tr>
        <tr>
            <td>Precio Minimo</td>
            <td><?php echo $detalle[0]->precio_minimo; ?></td>
        </tr>
        <tr>
            <td>2Checkout Code</td>
            <td><?php echo $detalle[0]->customnum; ?></td>
        </tr>
        <tr>
            <td>Categoria</td>
            <td>
                
                <?php echo $detalle[0]->nombre_categoria_producto; ?>
                
            </td>
        </tr>
        <tr>
            <td>Estado producto</td>
            <td>               

                    <?php
                        if($detalle[0]->prodStado == 1){
                            ?>
                            Activo
                            <?php
                        }else{
                            ?>
                             Inactivo                            
                            <?php
                        }
                    ?>
                
            </td>
        </tr>
        <tr>
            
        </tr>
    </table>
    </form>

  <div class="bar-other-actions">
    <a href="#" id="delete" name="<?php echo $detalle[0]->id_producto; ?>" class="btn btn-success" style="float: right;">Quitar</a>
    
  </div> <a href="#" name="<?php echo $detalle[0]->id_producto; ?>" id="<?php echo $detalle[0]->image; ?>" class="saveProducto btn btn-success" style="float: right;">Guardar</a>
</div>



