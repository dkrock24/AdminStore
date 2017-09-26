<?php
   session_start();
?>
<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../../assets/css/jquery-ui.min.css" type="text/css" /> 
<script type="text/javascript">
var IdsursalInventario = 1;


$("#ingrediente").autocomplete({
        source: "../produccion/Cproduccion/catalogo_materiales_inventario",
        minLength: 1
});

//----------------Cancelar envio ----
    $("#cancelEnvio").click(function()
    {
      $(".pages").load("../produccion/Cproduccion/index"); 
    });
 //-------------------------Fin ------------------

//------------Eliminar item de lista
$("body").on("click",".btnDeleteItem", function(){
  $(this).closest("tr").remove();
});
//-------fin codigo para eliminar item


//-----------------save Item de envio--------------
$("#addItem").click(function()
{
  //-------list data
  var medidaPorcion = $('#medidaPorcion').val();
  var cantidaEnvio = $("#cantdadPorcion").val();
  var unidadMedida = $('#umedidas').val();
  var unidadMedidaLabel = $('#umedidas option:selected').text()
  var material = $('#ingrediente').val();
  var vencimiento = $('#vencimiento').val();

 $('#tableList > tbody:last-child').append('<tr id='+material+'><td id="td_material">'+material+'</td><td>'+medidaPorcion+" "+unidadMedidaLabel+'</td><td id="td_cantidad">'+cantidaEnvio+'</td><td id="td_vencimiento">'+vencimiento+'<input type="hidden" name="idUnidadMedida" id="idUnidadMedida" value='+unidadMedida+'><input type="hidden" name="umporcion" id="umporcion" value='+medidaPorcion+'></td><td><span class="btn btn-primary btnDeleteItem">Eliminar</span></td></tr>');
  
  $('#medidaPorcion').val("");
  $("#cantdadPorcion").val("");
  $('#umedidas').val("");
  $('#ingrediente').val("");
  $('#vencimiento').val("");

});
//-------------------------Fin --------------------

//-----------------save Item de envio--------------
$(".imprime").click(function()
{
   var divToPrint=document.getElementById("tableList");
   var pageTitle = 'Lista de envios',
            stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
            win = window.open('', 'Print', 'width=500,height=300');
        win.document.write(divToPrint.outerHTML);
        win.document.close();
        win.print();
});
//-------------------------Fin -----------------------------------


//-----------------save proveedor--------------
$(".saveListEnvio").click(function()
{
  var TABLAID = "tableList";
  var DATA   = [];
  var TABLA   = $("#"+TABLAID+" tbody > tr");
  var CODIGOENVIO = 
 
  TABLA.each(function(){   

  var MATERIAL  = $(this).find("td[id='td_material']").text(),
      UNIDADMEDIDA  = $(this).find("input[id*='idUnidadMedida']").val(),
      MEDIDAPORCION  = $(this).find("input[id*='umporcion']").val(),
      CANTIDADPORCION  = $(this).find("td[id='td_cantidad']").text(),
      VENCIMIENTO  = $(this).find("td[id='td_vencimiento']").text(),
      FECHAENVIO  = $('#dateEnvios').val();
      SUCURSALENVIO  = $('#sucursal').val();
      CPRODUCCIONID  = $('#cproduccionID').val();
      USERID  = $('#userID').val();
 
    item = {};
    if(MATERIAL !== '')
    {
          item ["material"]   = MATERIAL;
          item ["unidaMedida"]   = UNIDADMEDIDA;
          item ['medidaPorcion']   = MEDIDAPORCION;
          item ['cantidadPorcion']   = CANTIDADPORCION;
          item ['vencimiento']   = VENCIMIENTO;
          item ['fechaEnvio']   = FECHAENVIO;
          item ['sucursalEnvio']   = SUCURSALENVIO;
          item ['cproduccionID']   = CPRODUCCIONID;
          item ['userID']   = USERID;
       
      DATA.push(item);
    }

  });
  console.log(DATA);

  INFO  = new FormData();
  aInfo   = JSON.stringify(DATA);
 
  INFO.append('data', aInfo);

  $.ajax
    ({
      url: "../produccion/Cproduccion/saveEnvioDos",
      type:"POST",
      data: INFO,
      processData: false, 
      contentType: false,
      success: function(data)
      {
        alert(data);
        $(".pages").load("../produccion/Cproduccion/indexDos/"+CPRODUCCIONID); 
      },
      error:function()
      {
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
<div id="conte-print"> 
  <h2>Lista de Envio</b></h2>  

  <div class="envioMaterialList">
    <form id="envioForm" action="post">
  <div class="col-md-12">
    
    <div class="col-md-6">
      <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="date" id="dateEnvios" name="dateEnvios" required/>
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Fecha Envio</span>
      </label>
      </span>
    </div>  
    
   <div class="col-md-6"> 
    <span class="input input--hoshi">
    <span class="input__label-content">Sucursales</span>
    <select class="form-control form-grey" name="sucursal" id="sucursal" data-style="white" data-placeholder="Seleccion una categoria" style="margin-top: -1em !important;" required>
    <option value="0">N/A </option>
    <?php
      foreach ($sucursales as $value) {
    ?>
    <option value="<?php echo $value->id_sucursal ?>"><?php echo $value->nombre_sucursal?></option>
    <?php
      }
    ?>                      
    </select>                         
    </span>
  </div>  


  </div>

  <div class="col-md-12" style="border: 1px solid #88b32f; border-radius: 4px; padding: 10px; width: 100%;">
   
    <div class="col-md-6">
      <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="text" id="ingrediente" required="true" name="ingrediente" />
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Material</span>
      </label>
      </span>
    </div>  
    
    <div class="col-md-6">
      <span class="input input--hoshi">
        <span class="input__label-content">Unidad Medida</span>
        <select class="form-control form-grey" name="umedidas" id="umedidas" data-style="white" data-placeholder="Seleccion una categoria" style="margin-top: -1em !important;">
        <option value="0">N/A </option>
        <?php
          foreach ($unidadMedida as $medida) {
        ?>
        <option value="<?php echo $medida->id_unidad_medida ?>"><?php echo $medida->nombre_unidad_medida?></option>
        <?php
          }
        ?>                      
        </select>                         
        </span>
    </div>

     <div class="col-md-6">
      <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="number" id="medidaPorcion" required="true" name="medidaPorcion" />
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Medida de porcion</span>
      </label>
      </span>
    </div>

    <div class="col-md-6">
      <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="text" id="cantdadPorcion" required="true" name="cantdadPorcion" />
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Cantidad Porciones</span>
      </label>
      </span>
    </div>

     <div class="col-md-12">
      <span class="input input--hoshi">
      <input class="input__field input__field--hoshi" type="date" id="vencimiento" required="true" name="vencimiento" />
      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
      <span class="input__label-content">Vencimiento</span>
      </label>
      </span>
    </div>

    <div class="col-md-3"> 
      <span class="input input--hoshi">
      <button type="button" id="addItem" class="btn btn-primary" style="background: #88b32f;">Agregar</button>
      </span>
    </div>

  </div>

  <div class="col-md-12" style="border: 1px solid #88b32f; border-radius: 4px; padding: 10px; width: 100%;margin-top: 12px;">
    <form id="listDetalle" method="POST">
    <h2>Detalle lista de envio</h2>
    <hr>
    <div id="conten-detalle">
    <table class="table table-hover table-dynamic" id="tableList">
    <thead class='titulos'>
      <tr>
        <th>Material</th>
        <th>Medida de porcion</th>
        <th>Cantidad porcion</th>
        <th>Vencimiento</th>                                                                 
        <th></th>
      </tr>
    </thead>
      <tbody>     
      </tbody>   
    </table>
    </div>
    </form>
  </div>
</div>
    
<div class="col-md-12">
    <div class="input input--hoshi">
      <input type="hidden" name="cproduccionID" id="cproduccionID" value="<?php echo $cproduccionID; ?>">
       <input type="hidden" name="userID" class="userID" id="userID" value="<?php echo $_SESSION['idUser'] ?>">
      <span class="btn btn-primary saveListEnvio">Guardar todo</span>
      <span id="cancelEnvio" class="btn btn-primary">Cancelar</span>
      <span id="imprimirEnvio" class="btn btn-primary imprime">Imprimir</span>
    </div>
</div> 
</form>
</div>


