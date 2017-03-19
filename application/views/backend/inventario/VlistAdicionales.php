<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">

    //-----------------save proveedor--------------
      $(".deleteAdicional").click(function()
      {
        var adicionalID = $(this).find(".adicionalID").val();
        var sucursalID = $(this).find(".sucursalID").val();
        //alert(sucursalID);
        $.ajax
           ({
            url: "../inventario/Cinventario/delete_adicional",
            type:"post",
            data: {adicionalID:adicionalID},
            success: function()
            {
              $(".pages").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);
              $(".conten-sucursales").hide();
              $(".load-inventario").show();
            },
            error:function(){
                alert("failure");
            }
          });

      });
      //-------------------------Fin -----------------------------------
</script>
<table class="table table-hover table-dynamic filter-head">
  <thead class='titulos'>
    <tr>
      <th>Nombre material</th>
      <th>Codigo</th>
      <th>Cantida Adicional</th>
      <th>Unidad Medida</th>
      <th>Precio</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($adicionales)) 
    {
      //var_dump($adicionales);
      foreach ($adicionales as $value) 
      {
    ?>
    <tr>
    <td><?php echo $value->nombre_matarial;  ?></td>
    <td><?php echo $value->codigo_meterial;  ?></td>
    <td><?php echo $value->cantidad_adicional;  ?></td>
    <td><?php echo $value->nombre_unidad_medida;  ?></td>
    <td><?php echo $value->moneda." ".$value->precio_adicional;  ?></td>
     <td>
      <button type="button" class="btn btn-primary  btn-sm deleteAdicional">
      <input type="hidden" name="adicionalID" class="adicionalID" value="<?php echo $value->id_materiales_adicionales ?>">
       <input type="hidden" name="sucursalID" class="sucursalID" value="<?php echo $value->id_sucursal ?>">
      Quitar</button>
     </td>
    </tr>        
    <!--  Vista dinamica de prodcutos -->
    <?php
      }
    }
           
    ?> 
                   
  </tbody>   
</table>

              