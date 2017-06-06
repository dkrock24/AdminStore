<link rel="stylesheet" media="screen" href="../../../../../assets/css/despacho/estilo.css" />
<link rel="stylesheet" href="../../../../../assets/css/TimeCircles.css" /> 
<script src="../../../../../js/jquery.js"></script>
<script src="../../../../../assets/js/TimeCircles.js"></script>

<script language="javascript">

 var idSucursal = '<?php echo $idSucursal[0];  ?>';
 
 setTimeout(function()
  {
      $("#pedidosLoad").load("../despacho_view_master/"+idSucursal);
  }, 5000);
  //--------Libreria para controlar timepos de pedido
  $(".timer").TimeCircles({
   "animation": "smooth",
    "bg_width": 0.7,
    "fg_width": 0.04,
    "circle_bg_color": "#fff",
    "time": {
        "Days": {
            "text": "Dias",
            "color": "#3F51B5",
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
            "color": "#673AB7",
            "show": true
        }
    }
});
 
//----------------Fin de codigo de libreria

    $(".orden").click(function()
    {
      if ($(this).hasClass('classElaborado'))
      {
        if (confirm('Desea despachar esta orden?')) 
        {

          var sucursalID = $(this).find('.DatoPedido').data("sucursalid");
          var pedidoID =   $(this).find('.numOrden').data("idpedido");

          $.ajax
          ({
              url: "../update_despacho",
              type:"post",
              data: {sucursalID:sucursalID,pedidoID:pedidoID},
              success: function(message)
              {
                $("#orden_"+pedidoID).remove();
                //$("#pedidos").load("../despacho_view/"+sucursalID);
              },
              error:function()
              {
                alert("failure");
              }
          });
        }
      }
      else
      {
          alert("No se puede despachar todavia no elaborado!!!");
      }
        

    });
      
</script>
<div id="pedidos">
  <?php
    if (!empty($pedidos)) 
      {

        foreach ($pedidos as $value) 
        {

         $classElaborado = ($value->flag_elaborado == 1) ? "classElaborado" : "" ; 
         $listProductos = explode(",", $value->name_producto);
  ?>
    
    <div class="orden <?php echo $classElaborado; ?>" id="<?php echo 'orden_'.$value->id_pedido; ?>">
    <div class="timer" data-date="<?php echo $value->fechahora_pedido; ?>" style="width: 350px; height: 125px; padding: 0px; box-sizing: border-box; background-color: #202020; font-size: 25px !important;"></div><hr>

    <div class="DatoPedido" data-sucursalid="<?php echo $value->id_sucursal; ?>">
      <span class="numOrden" data-idpedido="<?php echo $value->id_pedido; ?>">Mesa: #<?php echo $value->numero_mesa; ?>:</span> 
      <span class="meseroName" data-idmesero="<?php echo $value->id_mesero; ?>"><?php echo $value->nombres." ".$value->apellidos; ?></span>
    </div>
    <hr>
    <div class="cont-listItems">
      <?php
      foreach ($listProductos as $producto)
      {
      ?>  
        <li class="itemPedido"> <?php echo $producto; ?> </li>
      <?php
      }
      ?>
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

</div>