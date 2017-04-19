<link rel="stylesheet" media="screen" href="../../../../../assets/css/despacho/estilo.css" />
<link rel="stylesheet" href="../../../../../assets/css/TimeCircles.css" /> 
<script src="../../../../../js/jquery.js"></script>
<script src="../../../../../assets/js/TimeCircles.js"></script>

<script language="javascript">
 setTimeout(function()
  {
      $("#pedidosLoad").load("../despacho_view_master/"+3);
  }, 500000);
  //--------Libreria para controlar timepos de pedido
  $(".timer").TimeCircles({
   "animation": "smooth",
    "bg_width": 0.7,
    "fg_width": 0.04,
    "circle_bg_color": "#0f1015",
    "time": {
        "Days": {
            "text": "Days",
            "color": "#CCCCCC",
            "show": false
        },
        "Hours": {
            "text": "Hours",
            "color": "#8b1a13",
            "show": true
        },
        "Minutes": {
            "text": "Minutes",
            "color": "#4bc51b",
            "show": true
        },
        "Seconds": {
            "text": "Seconds",
            "color": "#e2ae18",
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
        //var_dump($pedidos);
        foreach ($pedidos as $value) 
        {

         $classElaborado = ($value->flag_elaborado == 1) ? "classElaborado" : "" ; 
  ?>
    
    <div class="orden <?php echo $classElaborado; ?>" id="<?php echo 'orden_'.$value->id_pedido; ?>">
    <div class="timer" data-date="2017-04-17 00:20:00" style="width: 350px; height: 125px; padding: 0px; box-sizing: border-box; background-color: #202020;"></div><hr>

    <div class="DatoPedido" data-sucursalid="<?php echo $value->id_sucursal; ?>">
      <span class="numOrden" data-idpedido="<?php echo $value->id_pedido; ?>">#1:</span> 
      <span class="meseroName">Jose lopez</span>
    </div>
    <hr>
    <div class="cont-listItems">
      <li class="itemPedido"> Pizza aventador </li>
      <li class="itemPedido"> Pizza aventador </li>
      <li class="itemPedido"> Pizza aventador </li>
      <li class="itemPedido"> Pizza aventador </li>
      <li class="itemPedido"> Pizza aventador </li>
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