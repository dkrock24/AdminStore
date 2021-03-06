<!DOCTYPE html> 
<html> 
<head> 
    <title><?php echo $datoSucursal[0]['nombre_sucursal'];  ?></title>

   
    <link rel="icon" href="../../../../../assets/images/caja/favicon.ico" type="image/x-icon">
    <link href="../../../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../../../assets/css/caja/estilo.css" />
    <link rel="stylesheet" href="../../../../../assets/css/TimeCircles.css" /> 
    <link rel="stylesheet" href="../../../../../assets/plugins/bootstrap/css/bootstrap.min.css"/>

  <script src="../../../../../js/jquery.js"></script>
  <script src="../../../../../assets/js/TimeCircles.js"></script>
  <script src="../../../../../js/bootstrap.min.js"></script>



</head>
<script language="javascript" > 
$( document ).ready(function() 
{

  function actualizarCaja() 
  {
    var sucursalID = $("#sucursalID").val();
    var lastPedido = $("#lastPedido").val();
    if (lastPedido != "") 
    {
      $.ajax
      ({
        url: "../../../sucursales/Ccaja/get_lastPedidos",
        type: "post",
        data: {sucursalID:sucursalID, lastPedido:lastPedido},                           
        success: function(data)
        {                                                
            if(data ==1)
            {
              $("#all-content").load(location.href+"#all-content>*","");
            }
        }
      });
    }
    else
    {
      $.ajax
      ({
        url: "../../../sucursales/Ccaja/get_lastPedidos",
        type: "post",
        data: {sucursalID:sucursalID, lastPedido:0},                           
        success: function(data)
        {                                                
            if(data ==1)
            {
              $("#all-content").load(location.href+"#all-content>*","");
            }
        }
      });
    }
    
  }

  $(function()
  {
    actualizarCaja();
  });

  setInterval(actualizarCaja,5000);

  $(".go-sucursal").click(function(){
        var id_sucursal = $("#id_sucursal").val();
        var url1 = $(this).attr("id");
          $.ajax({
              url: url1+id_sucursal,
              type:"post",
              success: function(){     
                $(".pages").load(url1+id_sucursal);      
              },
              error:function(){
                  //alert("Error.. No se subio la imagen");
              }
          });  
      });

  var sucursalID = $("#sucursalID").val();
  //alert(sucursalID);

  $(".timer").TimeCircles({
    "animation": "smooth",
    "bg_width": 0.5,
    "fg_width": 0.04,
    "circle_bg_color": "#0f1015",
    "time": {
        "Days": {
            "text": "Dias",
            "color": "#CCCCCC",
            "show": true
        },
        "Hours": {
            "text": "Horas",
            "color": "#8b1a13",
            "show": true
        },
        "Minutes": {
            "text": "Minutos",
            "color": "#4bc51b",
            "show": true
        },
        "Seconds": {
            "text": "Segundos",
            "color": "#e2ae18",
            "show": true
        }
    }
});
 
//--------evento para abrir modal de compras 
 $(".doCompras").click(function()
    {
        $(".ModaAddCompras").modal({
           backdrop: 'static', 
           keyboard: true 
        });


    });
//----------------fin evento para abrir modal
//-----------------Evento para agregar compras----
$("#saveCompras").click(function()
{
   var formulario = document.getElementById('addCompras');
   if(formulario.checkValidity())
   {
     $.ajax
      ({
          url: "../../../sucursales/Ccaja/save_compras",
          type: "post",
          data: $('#addCompras').serialize(),                           
        
          success: function(data)
          {                                                  
           
            alert("El regsitro se guardo correctamente!!!");
            document.getElementById('addCompras').reset();
            //$('.AddUnidadMedida').modal('toggle');
          
          }
      });
    }
    else
    {
      alert("Hay campos requeridos");
    }  

});
//-----------------------end  agregar compras 



//------- Evento para cerrar cuenta abierta--------
$(".cerrarCuenta").click(function()
 {
  var numMesa = $("#NumMesa").val();
  var mesaId = "mesa_id_"+numMesa;
  if (numMesa !="") 
  {
    var searchMesa = document.getElementsByClassName(mesaId);
    if (searchMesa.length > 0) 
    {
      if (confirm('Seguro que quiere cerrar esta cuenta?')) 
      {
        if (confirm('Esta cuenta se cancelo con tarjeta?')) 
        {
          var tarjetaNum = window.prompt("Ultimos 4 digitos de la tarjeta", "####");
          var numSend = tarjetaNum;
          var metodoPago = "tarjeta";
          var idpedidounico = $("."+mesaId).data("idpedidomesa");

          var pagoNeto = $(".totalneto_"+idpedidounico).text();
          var pagoIva = $(".IvaClean_"+idpedidounico).text();
          var pagoPropina = $(".propinaClean_"+idpedidounico).text();
          var pagoTotal = $(".totalClean_"+idpedidounico).text();

              if (tarjetaNum =! "" && !isNaN(tarjetaNum))  
              {
                $.ajax
                ({
                    url: "../../../sucursales/Ccaja/cerrar_cuenta",
                    type: "post",
                    data: {pagoNeto:pagoNeto,pagoIva:pagoIva,pagoPropina:pagoPropina,pagoTotal:pagoTotal,idpedidounico:idpedidounico,numSend:numSend,metodoPago:metodoPago},                           
                  
                    success: function(data)
                    {                                                  
                     
                      alert("Cuenta cerrada con exito");
                      $('.pedidoID_'+idpedidounico).remove();
                      $("#NumMesa").val("");
                    }
                });
              }
              else
              {
                alert('El valor de la tarjeta es incorrecto');
              }
              
            } 
            else 
            {
              var idpedidounico = $("."+mesaId).data("idpedidomesa");

              var pagoNeto = $(".totalneto_"+idpedidounico).text();
              var pagoIva = $(".IvaClean_"+idpedidounico).text();
              var pagoPropina = $(".propinaClean_"+idpedidounico).text();
              var pagoTotal = $(".totalClean_"+idpedidounico).text();

              var numSend = "0000";
              var metodoPago = "efectivo";
                $.ajax
                ({
                    url: "../../../sucursales/Ccaja/cerrar_cuenta",
                    type: "post",
                    data: {pagoNeto:pagoNeto,pagoIva:pagoIva,pagoPropina:pagoPropina,pagoTotal:pagoTotal,idpedidounico:idpedidounico,numSend:numSend,metodoPago:metodoPago},                           
                  
                    success: function(data)
                    {                                                  
                     
                      alert("Cuenta cerrada con exito");
                      $('.pedidoID_'+idpedidounico).remove();
                       $("#NumMesa").val("");
                    
                    }
                });
            }
         
        }
        else
        {
         
          $("#NumMesa").val("");
        }
        
    }
    else
    {
      alert("Esta mesa no tiene cuenta activa");
      $("#NumMesa").val("");
    }
  }  
  else
  {
    alert('El numero de mesa no puede ser "" ');  
  }
    

});
//---------fin evento cerrar cuenta-----------



//------- Evento para cerrar cuenta directa--------
$(".cerraCuentaUnica").click(function()
 {
    if (confirm("Desea cerrar la cuenta?"))
    {
      if (confirm('Esta cuenta se cancelo con tarjeta?')) 
        {
          var tarjetaNum = window.prompt("Ultimos 4 digitos de la tarjeta", "####");
          var numSend = tarjetaNum;
          var metodoPago = "tarjeta";
          var idpedidounico = $(this).data("idpedidounico");
          
          var pagoNeto = $(".totalneto_"+idpedidounico).text();
          var pagoIva = $(".IvaClean_"+idpedidounico).text();
          var pagoPropina = $(".propinaClean_"+idpedidounico).text();
          var pagoTotal = $(".totalClean_"+idpedidounico).text();

          if (tarjetaNum =! "" && !isNaN(tarjetaNum))  
          {
            $.ajax
            ({
                url: "../../../sucursales/Ccaja/cerrar_cuenta",
                type: "post",
                data: {pagoNeto:pagoNeto,pagoIva:pagoIva,pagoPropina:pagoPropina,pagoTotal:pagoTotal,idpedidounico:idpedidounico,numSend:numSend,metodoPago:metodoPago},                           
              
                success: function(data)
                {                                                  
                 
                  alert("Cuenta cerrada con exito");
                  $('.pedidoID_'+idpedidounico).remove();
                
                }
            });
          }
          else
          {
            alert('El valor de la tarjeta es incorrecto');
          }
          
        } 
        else 
        {
          var idpedidounico = $(this).data("idpedidounico");

          var pagoNeto = $(".totalneto_"+idpedidounico).text();
          var pagoIva = $(".IvaClean_"+idpedidounico).text();
          var pagoPropina = $(".propinaClean_"+idpedidounico).text();
          var pagoTotal = $(".totalClean_"+idpedidounico).text();


          var numSend = "0000";
          var metodoPago = "efectivo";
            $.ajax
            ({
                url: "../../../sucursales/Ccaja/cerrar_cuenta",
                type: "post",
                data: {pagoNeto:pagoNeto,pagoIva:pagoIva,pagoPropina:pagoPropina,pagoTotal:pagoTotal,idpedidounico:idpedidounico,numSend:numSend,metodoPago:metodoPago},                           
              
                success: function(data)
                {                                                  
                 
                  alert("Cuenta cerrada con exito");
                  $('.pedidoID_'+idpedidounico).remove();
                
                }
            });
        }
    }

        
      
});
//---------fin evento cerrar cuenta-----------


//--------------------check productos para separar
$('.itemProducto').click(function() 
{
  if ($(this).is(':checked')) 
  {
    var idProdcuto = $(this).data("idproducto");
    $('#optionUnica_'+idProdcuto).show();
  }
  else
  {
    var idProdcuto = $(this).data("idproducto");
    $('#optionUnica_'+idProdcuto).hide();
  }
});
//------------------Fin del codigo


//--------------------Cambiar de mesa productos selected
$('.cambiarM').click(function() 
{

  var numMesa = window.prompt("Ingrese el numero de mesa");
  var mesaId = "mesa_id_"+numMesa;
  if ($.isNumeric(numMesa)) 
  {
    var searchMesa = document.getElementsByClassName(mesaId);
    if (searchMesa.length > 0) 
    {
      if (confirm('Desea combinar su mesa?'))
      {

          var idpedidounico = $(this).data("idpedidocambiarmesa");
          var idpedidounicoMesa = $("."+mesaId).data("idpedidomesa");
          var className = ".itemProducto_"+idpedidounico;
          var myItems = new Array();
          $(className+':checked').each(function()
          {        
            myItems.push($(this).val());
          });

          $.ajax
          ({
              url: "../../../sucursales/Ccaja/combinar_mesa",
              type: "post",
              data: {myItems:myItems, idpedidounicoMesa:idpedidounicoMesa},
              success: function(data)
              {                                                  
                $("#all-content").load(location.href+"#all-content>*","");
              }
          });
      }
    }
    else
    {
     
      var idpedidounico = $(this).data("idpedidocambiarmesa");
      var className = ".itemProducto_"+idpedidounico;
      var myItems = new Array();
      $(className+':checked').each(function()
      {        
        myItems.push($(this).val());
      });
      
      $.ajax
      ({
          url: "../../../sucursales/Ccaja/cambiar_mesa",
          type: "post",
          data: {myItems:myItems, idpedidounico:idpedidounico, numMesa:numMesa},
          success: function(data)
          {                                                  
            $("#all-content").load(location.href+"#all-content>*","");
          }
      });

      
    }

  }
  else
  {
    alert("Es necesario ingresar numero de mesa valido");
  }
});
//------------------Fin del codigo


//--------------------mover de Mesa
$('.moverM').click(function() 
{
  if (confirm('Realmente desea mover de mesa?'))
  {
    var idpedidounico = $(this).data("idpedidomovermesa");
    var numMesa = parseInt(window.prompt("Ingrese el numero de mesa"));
    var mesaId = "mesa_id_"+numMesa;
    if ($.isNumeric(numMesa)) 
    {
      $.ajax
      ({
          url: "../../../sucursales/Ccaja/mover_mesa",
          type: "post",
          data: {numMesa:numMesa, idpedidounico:idpedidounico},
          success: function(data)
          {                                                  
            $("#all-content").load(location.href+"#all-content>*","");
            alert("Se movio de mesa correctamente");
          }
      });
    }
    else
    {
      alert("Es necesario que ingrese un numero de mesa valido");
    }
  }
 
});
//------------------Fin del codigo

//--------------------Separar Cuenta
$('.separarC').click(function() 
{
  if (confirm('Realmente desea separar cuentas'))
  {
    var idpedidounico = $(this).data("idpediseparar");
    var className = ".itemProducto_"+idpedidounico;
    var myItems = new Array();
    $(className+':checked').each(function()
    {        
       myItems.push($(this).val());
    });

    $.ajax
      ({
          url: "../../../sucursales/Ccaja/separar_cuenta",
          type: "post",
          data: {myItems:myItems, idpedidounico:idpedidounico},
          success: function(data)
          {                                                  
            $("#all-content").load(location.href+"#all-content>*","");
          }
      });
  }
 
});
//------------------Fin del codigo


//--------------------Descuento Cupon
$('.descuentoCupon').click(function() 
{
  var idpedidounico = $(this).data("idpedidocupon");
  if (confirm('Realmente desea aplicar descuento por cupon'))
  {
    var codigoCupon = window.prompt("Ingrese el codigo del cupon");
    if (codigoCupon.length > 0) 
    {
      $.ajax
      ({
          url: "../../../sucursales/Ccaja/descuento_cupon",
          type: "post",
          data: {codigoCupon:codigoCupon, idpedidounico:idpedidounico, sucursalID:sucursalID},                           
              
          success: function(data)
          {                                                  
            alert(data);
            $("#all-content").load(location.href+"#all-content>*","");
          }
      });
    }
    else
    {
      alert("No ingreso un codigo de cupon valido");
      return;
    }
  }
});
//------------------Fin del codigo

//--------------------Separar Cuenta
$('.removeIco').click(function() 
{
  if (confirm('Seguro que quiere cancelar este item de su pedido?')) 
    {
       var idpedidounico = $(this).data("idpedidocancelarpro");
       $.ajax
      ({
          url: "../../../sucursales/Ccaja/eliminar_item",
          type: "post",
          data: {idpedidounico:idpedidounico},                           
          success: function(data)
          {                                                  
            alert(data);
            $("#all-content").load(location.href+"#all-content>*","");
          }
      });
    }
    else
    {
      return;
    }
  
});
//------------------Fin del codigo

//--------------------Separar Cuenta
$('.quitar_propina').click(function() 
{
  var idpedidounico = $(this).data("idpedidounicopropina");
  if (confirm('Realmente desea quitar la propina esta orden?'))
  {
    var commentPropina = window.prompt("Ingrese el motivo");
    if (commentPropina.length > 0) 
    {
      $.ajax
      ({
          url: "../../../sucursales/Ccaja/quitar_propina",
          type: "post",
          data: {commentPropina:commentPropina, idpedidounico:idpedidounico},                           
              
          success: function(data)
          {                                                  
            alert("Propina eliminada con exito");
            $("#all-content").load(location.href+"#all-content>*","");
          }
      });
    }
    else
    {
      alert("Es necesario un comentario");
      return;
    }
  }
  else
  {
    return;
  }
});
//------------------Fin del codigo


//--------------------Anular cuenta
$('.anularPedido').click(function() 
{
  if (confirm('Realmente desea anular esta orden?'))
  {
     var idpedidounico = $(this).data("idpedidoanular");
    // valor estrax para anular cuenta
    var pagoNeto = $(".totalneto_"+idpedidounico).text();
    var pagoIva = $(".IvaClean_"+idpedidounico).text();
    var pagoPropina = $(".propinaClean_"+idpedidounico).text();
    var pagoTotal = $(".totalClean_"+idpedidounico).text();
   
    var commentAnulacion = window.prompt("Ingrese el motivo de anulacion");
    if (commentAnulacion.length > 0) 
    {
      $.ajax
      ({
          url: "../../../sucursales/Ccaja/anular_cuenta",
          type: "post",
          data: {commentAnulacion:commentAnulacion, idpedidounico:idpedidounico,pagoNeto:pagoNeto,pagoIva:pagoIva,pagoPropina:pagoPropina,pagoTotal:pagoTotal},                           
              
          success: function(data)
          {                                                  
            alert("Cuenta anulada con exito");
            $('.pedidoID_'+idpedidounico).remove();
          }
      });
    }
    else
    {
      alert("Es necesario agregar un comentario");
    }   
     
  } 


});
//------------------Fin del codigo 



//--------------------Hacer descuento
$('.descuento').click(function() 
{
  var porcent = "";
  if (confirm('Realmente desea hacer un descuento? (0 - 100 %)'))
  {
    var idpedidounico = $(this).data("idpedidodescuento");
    var total = $(".totalneto_"+idpedidounico).text();

    var comment = window.prompt("Ingrese el motivo del descuento");

    if (comment.length > 0) 
    {
       porcent = window.prompt("Porcentaje a descontar")
      if(porcent.length > 0)
      {
        $.ajax
        ({
            url: "../../../sucursales/Ccaja/addevento_historial",
            type: "post",
            data: {comment:comment, porcent:porcent, idpedidounico:idpedidounico}, 
            success: function(data)
            {          

              alert("Descuento aplicado correctamente");
              $("#all-content").load(location.href+"#all-content>*","");
         
            }
        });
      }
      else
      {
        alert("Es necesario el porcentaje del descuento");
        return;
      }
       
    }
    else
    {
      alert("Es necesario agregar un comentario");
      return;
    }   
     
  }


});
//------------------Fin del codigo 


//-------------Imprimir Tiquete
$('.imp_tiquete').click(function() 
{
  if (confirm('Realmente desea imprimir tiquete'))
  {
    var idpedidounico = $(this).data("idpedidotiquete");
    $.ajax
    ({
        url: "../../../sucursales/Ccaja/imprimir_tiquete",
        type: "post",
        data: {idpedidounico:idpedidounico}, 
        success: function(data)
        {          
          var pageTitle = 'Tiquete La Pizzeria',
                    stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
                    win = window.open('', 'Print', '');
          win.document.write(data);
          win.document.close();
          win.print();
           $("#all-content").load(location.href+"#all-content>*","");    
        }
    });
  }
});
//------------------Fin del codigo


//-------------Imprimir Factura
$('.imp_factura').click(function() 
{
  alert("imprimir factura");
  var divToPrint=document.getElementById("tableList");
  var pageTitle = 'Lista de envios',
            stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
            win = window.open('', 'Print', 'width=500,height=300');
        win.document.write(divToPrint.outerHTML);
        win.document.close();
        win.print();
});
//------------------Fin del codigo

});   
</script>
<style type="text/css">
.panel-success>.panel-heading 
{
  color: #000 !important;
    background-color: #607D8B;
    font-weight: bold !important;
}

.modal-backdrop {
  z-index: -1;
}

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
  #anio{
    width: 100%;
  }
  .avatar{
    padding: 10px;
    display: inline-block;
  }
 
</style>
<body>
<div class="cont-general" id="all-content">

  <div class="main-contenido">
      <div class="main header">
        <header>
        <nav>
          <ul>
          <li class='doCompras'><a title="Opcion 3" href="#">Compras</a></li>
          <li class="date-caja"><?php echo date('Y-m-d');  ?></li>
          </ul>
        </nav>
        </header>
      </div>

    <div class="conte-first"> 
      <div class="busqueda-mesa">
      <center>
        <h2>Cuentas Abiertas</h2>
        <div class="input-group"> 
        <div class="input-group-btn"> 
          <button type="button" class="btn btn-default imp_tiquete" style="height: 40px;">Tiquete</span></button> 
          <button type="button" class="btn btn-default cerrarCuenta" style="height: 40px;">Cerrar</button> 
        </div>
          <input class="form-control" placeholder="Numero Mesa" aria-label="Text input with multiple buttons" style="width: 30%;height: 42px;border: 2px solid #88b32f;" id="NumMesa">
        </div>
      </center>  
      </div>    
  </div>


    <!--iv contiene lista de pedido para cerrar en caja-->
    <?php
      if(!empty($pedidos)) 
      {
        //var_dump($pedidos);
        foreach ($pedidos as $value) 
        {
          
         
          $listProductos = explode(",", $value->name_producto);

          $listHistorial = explode(",", $value->historial);
          //var_dump($listHistorial);
    ?>  
        <div class="panel panel-primary pedidoID_<?php echo $value->id_pedido; ?>">
          <div class="panel-heading" style="text-align: center;color: #fff;font-weight: bold;">
           <span class="num-cuenta" style="font-size: 18px">Cuenta #<?php echo $value->secuencia_orden; ?>   Atendida por <?php echo $value->nombres." ".$value->apellidos; ?></span>
           <?php
            if ($value->elaborado == 1) 
            {
              echo "<span class='glyphicon glyphicon-usd' title='Pendiente de cobro'></span>";
            } 
          ?>
           </div>
            <div class="btn-group" role="group">
            <!--<button type="button" class="btn btn-default" style="height: 40px;">Factura</button>-->
            <!--<button type="button" class="btn btn-default" style="height: 40px;">Fiscal</button>-->
            <!--<button type="button" class="btn btn-default" style="height: 40px;">Orden</button>-->
            <button type="button" class="btn btn-default imp_tiquete" data-idpedidotiquete="<?php echo $value->id_pedido; ?>" style="height: 40px;">Tiquete</button>
             <button type="button" class="btn btn-default imp_factura" data-idpedidofactura="<?php echo $value->id_pedido; ?>" style="height: 40px;">Factura</button>
            <button type="button" class="btn btn-default cerraCuentaUnica" data-idpedidounico="<?php echo $value->id_pedido; ?>" style="height: 40px;">Cerrar</button>
            <button type="button" class="btn btn-default anularPedido" data-idpedidoanular="<?php echo $value->id_pedido; ?>" style="height: 40px;">Anular</button>
            <button type="button" class="btn btn-default descuento" data-idpedidodescuento="<?php echo $value->id_pedido; ?>" style="height: 40px;">Descuento</button>
            <button type="button" class="btn btn-default descuentoCupon" data-idpedidocupon="<?php echo $value->id_pedido; ?>" style="height: 40px;">Cupon</button>
            <button type="button" class="btn btn-default moverM" data-idpedidomovermesa="<?php echo $value->id_pedido; ?>" style="height: 40px;">Mover de mesa</button>
            <!--<button type="button" class="btn btn-default" style="height: 40px;">VIP</button>-->
          </div>
          

          <div class="btn-group optionUnica" role="group" id="optionUnica_<?php echo $value->id_pedido; ?>" style="display: none;">
            <button type="button" class="btn btn-danger separarC" data-idpediseparar="<?php echo $value->id_pedido; ?>" style="height: 40px;">Separar Cuenta</button>
           <button type="button" class="btn btn-danger cambiarM" data-idpedidocambiarmesa="<?php echo $value->id_pedido; ?>" style="height: 40px;">Cambiar mesa</button>
          </div>
          
          <div class="panel-body">
           <div class="alert alert-success" role="alert">
            <span class="num_mesa mesa_id_<?php echo $value->numero_mesa; ?>  badge" title="Numero de mesa"  data-idpedidomesa="<?php echo $value->id_pedido; ?>"><?php echo $value->numero_mesa; ?></span>
            <span class="formula">
               
              (((
              <span class="totalneto_<?php echo $value->id_pedido; ?>" style="cursor: not-allowed;" title="Total sin IVA">
              <?php
               //-------Formula de calculo de total( totalMasIVa - (DescuentoCupon, Descuento Porcent) + Propina =  ToTALNETO)

              $totalNetoDescuento = 0; // Variable GLobal Descuento
              $TotalDescuentoCupon = 0; //  Variable global descuento por cupon
              $propina = 0; //  Variable global propina

              $totalIva = $value->totalCon - $value->totalSin; // Cantidad IVA
              $totalNeto = $value->totalCon; // Total con IVA
              $TotalNetoSin = $value->totalSin; // Total sin IVA

              //--------_Calculo de propina
              if ($value->grupo == "PROPINA") 
              {
                $propina =  0;
              }
              else
              {
                $propina =  ($totalNeto - $totalNetoDescuento) * 0.10;
              }
              //------ END------------

              echo $TotalNetoSin // Total sin IVA

              ?>
              </span>
               +
              <span class="quitar_iva IvaClean_<?php echo $value->id_pedido; ?>" style="cursor: pointer;" title="IVA Clic para quitar IVA" data-ivasucursal="<?php echo $value->monto_impuesto; ?>">
              <?php 
               
                echo round($totalIva,2); ?>
              </span>
              
                ) = 
              <span class="totalMasIva totalIvaClean_<?php echo $value->id_pedido; ?>" style="cursor: not-allowed;color:blue;font-weight:bold;" title="Total con IVA sin propina">
              <?php 
                echo round($totalNeto,2); 
              ?>
              </span>

              ) + 

              <span class="quitar_propina propinaClean_<?php echo $value->id_pedido; ?>" style="cursor: pointer;color:red;font-weight:bold;" title="Propina
              Clic para quitar propina" data-idpedidounicopropina="<?php echo $value->id_pedido; ?>">
              <?php 
                echo $propina;     
              ?>
              </span>
              ) 
      
      
              <span class="totalFull totalFull_<?php echo $value->id_pedido; ?>" title="Total con IVA y con propina">
              $
               <?php 
                  //---Suma de total descuentos
                  $total =  ($totalNeto + $propina);


                //----explode group descuentos

                //------------End
                
                //--Calcular descuentos %
                if ($value->grupo == "DESCUENTO") 
                {
                  $porcentDescuento = $total / 100;
                  $totalNetoDescuento = $porcentDescuento * $value->descuentos;
                }
                // -------END----------------

                //---  Calculos de descuentos por CUPON $
                if ($value->grupo == "CUPON$") 
                {  
                    $TotalDescuentoCupon = $total - $value->descuentos; 
                }
                 // -------END----------------

                 // ---Calculo descuento cupon %
                if ($value->grupo == "CUPON%") 
                {  
                    $totalDescuento =  $total * $value->descuentos;
                    $TotalDescuentoCupon = $total - $totalDescuento; 
                }
                //---------END --------------- 
                  $totalNetoDescuento = $totalNetoDescuento + $TotalDescuentoCupon;
                  echo "<span class='totalClean_$value->id_pedido'>".round(($total- $totalNetoDescuento),2)."</span>"; 
                ?>
              </span>

            </span>
           </div> 

            <div class="iten-cuenta">
              <ul class="list-group">
              <li class="list-group-item">
              <?php
              foreach ($listProductos as $producto)
              {
                 $dataSeparada = explode("_", $producto);
                 //var_dump($dataSeparada);
              ?>  
                <span class="removeIco glyphicon glyphicon-remove" data-idpedidocancelarpro="<?php echo $dataSeparada[0]; ?>"></span>
                <input type="checkbox" name="item-venta[]" class="itemProducto itemProducto_<?php echo $value->id_pedido; ?>" data-idproducto="<?php echo $value->id_pedido; ?>" value="<?php echo $dataSeparada[0]; ?>"> 
                <?php echo $dataSeparada[1]; ?>
                <span class="preciograbado">$<?php echo $dataSeparada[2]; ?></span><br>
              <?php
              }
              ?>
              </li>
            </ul>
            </div>
            <div class="list-logs">
            <?php
              foreach ($listHistorial as $historia)
              {  
              ?>
              <div class="alert alert-warning" role="alert" style="color: #000000;padding: 3px;margin: 2px;"><?php echo $historia; ?></div>  
              <?php
              }
              ?>
            </div>
          </div>
        </div>
    <?php
          }
        }
      else
        {
          echo '<div class="alertDespacho">NADA PENDIENTE </span><span class="icoGreate glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></div>';
        }    
    ?>     
    <!-- fin Panel de ordenes en cocina -->

<!--          Variables globales para consultar datos nuevos SucursalID, lastPedidoID  -->    
        <input type="hidden" id="sucursalID"  name="sucursalID" value="<?php echo $idSucursal; ?>">
        <input type="hidden" id="lastPedido"  name="lastPedido" value="<?php echo @$value->id_pedido; ?>">
    <!--                                      END                                          -->



</div>
</body>
</html>


<!-- Codigo para modal para hacer compras-->
<div class="modal fade ModaAddCompras" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Compras
          </h4>

        <div class="modal-body">
  
                 <form id="addCompras" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="compradoA" name="compradoA" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Comprado A</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionP" name="descripcionP" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="precio" name="precio" required/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Precio</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                  <span class="input input--hoshi">
                        <span class="input__label-content" style="color: #000;">Pagado Via</span>
                        <select class="form-control form-grey" name="pagadoVia" id="pagadoVia" data-placeholder="Seleccion una categoria"required >
                       <option value="1">Caja</option>
                       <option value="1">Cheque</option>
                        </select>   
                     </span>
                </div>  
        </div>  

                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveCompras" class="btn btn-primary">Guardar Proveedor</button>
                  </span>
                </div>
  </form>
          
        </div>
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  