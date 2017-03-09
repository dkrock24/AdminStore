<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  
    //-------- mostrar los productos po asignados a sucursal
  $(".backto").click(function()
  {
      var sucursalID = $(this).find(".sucursalID").val();
      // alert(sucursalID);
      $(".pages").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);
      $(".conten-sucursales").hide();
      $(".load-inventario").show();

  });

    //-----------------save proveedor--------------
      $("#saveAdicional").click(function()
      {
        var sucursalID = $(".backto").find(".sucursalID").val();
        alert(sucursalID);
        $.ajax
           ({
            url: "../inventario/Cinventario/save_adicional",
            type:"post",
            data: $("#AddAdicioal").serialize(),
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
<div class="addAdicional">
<div id="actions-bar">
  <span type="button" style="float:right;background-color: #c75757;" class="btn btn-success backto">
  <input type="hidden" name="sucursalID" class="sucursalID"> value="<?php echo $material[0]['id_sucursal']; ?>">
     Regresar
  </span>  
</div>
<h2>Sucursal: <b><?php echo $material[0]['nombre_sucursal'];  ?></b></h2>
<h2>Material: <b><?php echo $material[0]['nombre_matarial'];  ?></b></h2>

<form id="AddAdicioal" action="post">
<?php
//var_dump($material);
?>
  <div class="col-md-12">
               <div class="col-md-6">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="cantidaAdicional" required name="cantidaAdicional" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Cantidad</span>
                      </label>
                  </span>
                </div>

              <div class="col-md-6">   
          <span>Unidad de medida:   </span><br>
          <span><select style="width: 80%;    margin-top: 35px;" class="form-control form-grey unidadMedidaAdicional" name="unidadMedidaAdicional"  data-style="white" data-placeholder="Seleccione un estado...">
          <?php
            foreach ($unidaMedida as $value) {
          ?>
          <option value="<?php echo $value->id_unidad_medida ?>"><?php echo $value->nombre_unidad_medida?>
          </option>
          <?php
            }
          ?>                      
          </select> 
          <span>  
          </div>    
                
                  
  </div>              
    <div class="col-md-12" style="margin-left: 15px;">
     
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="precioAdicional" name="precioAdicional" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Precio</span>
                      </label>
                  </span>
  </div> 
  <div class="col-md-12" >

      <div class="col-md-6"> 
        <span class="input input--hoshi">
        <input type="hidden" name="id_material_sucursal" class="id_material_sucursal" value="<?php echo $material[0]['id_inventario_sucursal']; ?>">
          <button type="button" id="saveAdicional" class="btn btn-primary">Guardar Adicional</button>
        </span>
      </div>
  </div> 
  </form>
</div>