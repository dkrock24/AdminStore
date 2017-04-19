<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script>
   $("#saveListMateriales").click(function()
    {
        //var dataString = $('#listMateriales').serialize();
        //alert(dataString);
        $.ajax
        ({
            url: "../inventario/Cinventario/saveMaterialesList",
            type: "post",
            data: $('#listMateriales').serialize(),                           
          
            success: function(data)
            {                                                  
             
              var sucursalID = $("#sucursalID").val();
              $('.modelAddMaterial').modal('toggle');
              $(".laod-material-view").show(); 
              $(".load-inventario").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);
            },
            error:function()
            {

            }
        });

    });

  $('#select_all').click(function() 
  {
      //var c = this.checked;
      $("form input:checkbox").attr ( "checked" , true );
  });


</script>
<form id="listMateriales" method="POST">
<table class="table table-hover table-dynamic">
  <thead class='titulos'>
    <tr>
      <th>Nombre material</th>
      <th>Descripcion</th>
      <th>Codigo</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if (!empty($materiales)) 
    {
      //var_dump($materiales);
      foreach ($materiales as $value) 
      {
    ?>
    <tr>
    <td>
      <input type="checkbox" name="materialesList[]" value="<?php echo $value->codigo_material;  ?>" />
      <span class='nameMaterial'><?php echo $value->nombre_matarial;  ?></span>
    </td>
    <td><?php echo $value->descripcion_meterial;  ?></td>
    <td><?php echo $value->codigo_material;  ?></td>
    
    </tr>        
    <!--  Vista dinamica de prodcutos -->
    <?php
      }
    }
           
    ?> 
                   
  </tbody>   
</table>
<input type="hidden" name="sucursalID" id="sucursalID" value="<?php echo $sucursalID;  ?>">
<div class="col-md-12"> 
  <button type="button" id="saveListMateriales" class="btn btn-primary">Agregar</button>
  <button type="button" id="select_all" class="btn btn-primary">Seleccionar todos</button>
</div>
</form>
              