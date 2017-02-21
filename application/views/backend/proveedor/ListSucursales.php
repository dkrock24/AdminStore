<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedores").click(function()
    {
      $(".pages").load("../proveedor/Cproveedor/index"); 
    });
    //-------------------------Fin ------------------


   //-----------------Asociando un prodcuto----------
     $(".cont-sucursales").click(function()
      {
    
          var SucursalId = $(this).find('.SucursalId').val();
          var idProveedor = $(this).find('.idProveedor').val();
          if($(this).find(".activePS").length > 0) 
          {
            //alert("Desacosiar");
             $.ajax
               ({
                url: "../proveedor/Cproveedor/disassociate_producto",
                type:"post",
                data: {SucursalId:SucursalId,idProveedor:idProveedor},
                success: function()
                {
                   $(".pages").load("../proveedor/Cproveedor/loadSucursales/"+idProveedor); 
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
                url: "../proveedor/Cproveedor/associate_producto",
                type:"post",
                data: {SucursalId:SucursalId,idProveedor:idProveedor},
                success: function()
                {
                   $(".pages").load("../proveedor/Cproveedor/loadSucursales/"+idProveedor);
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
  width: 250px;
  border: 1px solid #445a18;
  text-align: center;
  float: left;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 15px;
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
    font-size: 14px;
    padding: 4px;
    color: #FFF;
}

</style>
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedores">Regresar</button>
<h1>Asociar a poveedor: <?php echo $proveedor[0]->nombre_proveedor; ?></h1></hr>

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
                <input type="hidden" name="SucursalId" class="SucursalId" value="<?php echo $value->id ?>">
                <input type="hidden" name="idProveedor" class="idProveedor" value="<?php echo $proveedor[0]->id_proveedor ?>">
                <i class='fa fa-home' style="font-size: 150px;color:#88b32f;"></i>
                <div class="name-sucursal"><?php echo $value->name; ?> 
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