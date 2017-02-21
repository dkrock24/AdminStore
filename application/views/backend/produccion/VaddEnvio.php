<?php
   session_start();
?>
<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">

//-----------------save proveedor--------------
$("#saveEnvio").click(function()
{
  //alert($("#envioForm").serialize());
  var maximo = $('.maximo').val();
  var cantidaEnvio = $("#cantidaEnvio").val();
  //alert(maximo+":"+cantidaEnvio);
  if(maximo < cantidaEnvio)
  {
    alert("Cantidad sobrepasa total en existencia");
  }
  else
  {
    $.ajax
      ({
        url: "../produccion/Cproduccion/saveEnvio",
        type:"post",
        data: $("#envioForm").serialize(),
        success: function()
        {
          alert("Envios realizado correctamente");
          $(".pages").load("../produccion/Cproduccion/Index"); 
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

</style>
<h2>Centro de Produccion: <b><?php echo $dataMaterial[0]['nombre_sucursal'];?> </b></h2> 
<h2>Disponible para enviar:<b> <?php echo $dataMaterial[0]['total_existencia']." ".$dataMaterial[0]['nombre_unidad_medida'];?> </b></h2>  

<div class="envioMaterial">
<form id="envioForm" action="post">
  <input type="hidden" name="idCproduccion" class="idCproduccion" value="<?php echo $dataMaterial[0]['id_sucursal']; ?>">
  <input type="hidden" name="userID" class="userID" id="userID" value="<?php echo $_SESSION['idUser'] ?>">
  <input type="hidden" name="maximo" class="maximo" id="maximo" value="<?php echo $dataMaterial[0]['total_existencia']; ?>"> 

   <input type="hidden" name="idInventarioMaterial" class="idInventarioMaterial" id="idInventarioMaterial" value="<?php echo $dataMaterial[0]['id_inventario_sucursal']; ?>"> 
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="number" id="cantidaEnvio" required name="catindadEnvio" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Cantidad total de envio</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="codigoMaterial" name="codigoMaterial" readonly  value="<?php echo $dataMaterial[0]['codigo_meterial'];?>" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Codigo Material</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12" style="margin-left: 20px;font-weight: bold;">
          <div class="col-md-6">   
          <span>Sucursales:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey sucursalId" name="sucursalId"  data-style="white" data-placeholder="Seleccione un estado...">
          <?php
            foreach ($sucursales as $value) {
          ?>
          <option value="<?php echo $value->id_sucursal ?>"><?php echo $value->nombre_sucursal?>
          </option>
          <?php
            }
          ?>                      
          </select> 
          <span>          
          </div>  

          <div class="col-md-6">   
          <span>Unidad de media:   </span><br>
          <span><select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey unidadMedida" name="unidadMedida"  data-style="white" data-placeholder="Seleccione un estado...">
          <?php
            foreach ($unidadMedida as $value) {
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
  </div> 
  <div class="col-md-12">
    
          <div class="col-md-6"> 
            <span class="input input--hoshi">
              <button type="button" id="saveEnvio" class="btn btn-primary">Guardar</button>
            </span>
          </div>
  </div> 
  </form>
</div>


