<?php
   session_start();
?>
<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script>
  $(document).ready(function()
  {
   //-----------------save proveedor--------------
    $("#saveConfigMaterialAdd").click(function()
      {
        var cantidadNueva = $("#cantidadNueva").val();  
        var sucursalID = $(".sucursalID").val(); 
        if (cantidadNueva !="") 
        {
          $.ajax
             ({
              url: "../inventario/Cinventario/save_add_material",
              type:"post",
              data: $("#configMaterial").serialize(),
              success: function()
              {
                //alert("Material agregado correctamente");
                $(".load-inventario").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);
              },
              error:function(){
                  alert("failure");
              }
            });
        }
        else
        {
           alert("La nueva cantidad es un campos necesarios!"); 
        }

      });
      //-------------------------Fin -----------------------------------
 });    
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
  .titleMaterial
  {
    font-weight: bold;
  }

</style>

<div class="addIngredientes" style="background: #88b32f;height: 2px;">
<div class="col-md-12">
  <h1 class='titleMaterial'></h1>
</div>  
<hr>
  <form id="configMaterial" action="post">
  <input type="hidden" name="catalogoSucursalID" class="catalogoSucursalID" value="<?php echo $materialSucursal[0]['id_inventario_sucursal'] ?>">

  <input type="hidden" name="sucursalID" class="sucursalID" value="<?php echo $materialSucursal[0]['id_sucursal'] ?>">

             <input type="hidden" name="codigoMaterial" class="codigoMaterial" value="<?php echo $materialSucursal[0]['codigo_meterial'] ?>">

              <input type="hidden" name="ActualExistencia" class="ActualExistencia" value="<?php echo $materialSucursal[0]['total_existencia'] ?>">

            <input type="hidden" name="userID" class="userID" value="<?php echo $_SESSION['idUser'] ?>">
  <div class="col-md-12">
    <h1>
    <?php
     //var_dump($materialSucursal);
     ?> 
      <?php echo $materialSucursal[0]['nombre_matarial']."<br>";?>  
       <?php echo "Unidad medida: ".$materialSucursal[0]['nombre_unidad_medida']."<br>";?>  
      <?php echo $materialSucursal[0]['codigo_meterial']."<br>";?>
       <?php echo "Total Existencia: ".$materialSucursal[0]['total_existencia']."<br>";?>  
    </h1>
  </div>
  <div class="col-md-12">   
   <div class="col-md-6">       
    <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="text" id="cantidadNueva" name="cantidadNueva" value="" />
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Cantida ingrediente</span>
      </label>
      </span>
  </div>
  </div>  
  </div>                
 <div class="col-md-12">
          <div class="col-md-6"> 
            <span class="input input--hoshi">
            <button type="button" id="saveConfigMaterialAdd" class="btn btn-primary">Guardar</button>
            </span>
          </div>


 
  </div>
 </form>


