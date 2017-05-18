<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProductos").click(function()
    {
      $(".pages").load("../productos/Cproductos/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveProveedor").click(function()
      {
        //alert($("#addProveedor").serialize());
        $.ajax
           ({
            url: "../proveedor/Cproveedor/save_proveedor",
            type:"post",
            data: $("#addProveedor").serialize(),
            success: function()
            {
              alert("Proveedor agregado correctamente");
              $(".pages").load("../proveedor/Cproveedor/index"); 
            },
            error:function(){
                alert("failure");
            }
          });

      });
      //-------------------------Fin -----------------------------------

        //-----------------Asociando un prodcuto----------
     $(".cont-sucursales").click(function()
      {
    
          var SucursalId = $(this).find('.idSucursal').val();
          var GlobalProductoId = $(this).find('.productoID').val();
          if($(this).find(".activePS").length > 0) 
          {
            //alert("Desacosiar");
             $.ajax
               ({
                url: "../productos/Cproductos/disassociate_producto",
                type:"post",
                data: {SucursalId:SucursalId,GlobalProductoId:GlobalProductoId},
                success: function()
                {
                   $(".pages").load("../productos/Cproductos/loadSucursales/"+GlobalProductoId); 
                },
                error:function()
                {
                  alert("failure");
                }
              });
          }
          else
          {
             //alert("Asociar");
            $.ajax
               ({
                url: "../productos/Cproductos/associate_producto",
                type:"post",
                data: {SucursalId:SucursalId,GlobalProductoId:GlobalProductoId},
                success: function()
                {
                   $(".pages").load("../productos/Cproductos/loadSucursales/"+GlobalProductoId);
                },
                error:function()
                {
                  alert("failure");
                }
              });
          }   

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
.cont-sucursales
{
  width: 200px;
  border: 1px solid #445a18;
  text-align: center;
  float: left;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 7px;
}

.cont-sucursales:hover
{
  opacity: 0.8;
  cursor: pointer;
}

.name-sucursal
{
    background-color: #2b2e33;
    text-align: center;
    font-weight: bold;
    height: 35px;
    font-size: 12px;
    padding: 4px;
    color: #FFF;
}

</style>
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProductos">Regresar</button>
<h1>Asociar sucursales</h1>

 <div class="row line col-md-12">
          <div class="row col-lg-12 conten-sucursales">
    <?php
        if (!empty($sucursales)) 
        {
          //var_dump($sucursales);
          foreach ($sucursales as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="cont-sucursales">
                 <input type="hidden" name="idSucursal" class="idSucursal" value="<?php echo $value->id ?>">
                 <input type="hidden" name="productoID" class="productoID" value="<?php echo $productoID; ?>">
                <i class='fa fa-home' style="font-size: 150px;color:#88b32f;"></i>
                <div class="name-sucursal"><?php echo $value->nombre_pais."(".$value->name.")"; ?> 
                <?php if($value->validate != null)
                {?>
                    <p class="fa fa-check-circle activePS" aria-hidden="true"></p>
                <?php } ?>
                  
                </div>
            </div>
          <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 

      </div>
      
      <div class="load-productoBySucursal" style="display:none;"></div>    

       </div>   