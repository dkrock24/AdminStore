<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<script type="text/javascript">
    $(document).ready(function(){
        $('#actualizar_orden').click(function(){
            $.ajax({
                url: "../orden/CListarorden/actualizarOrden",
                type:"post",
                data: $('#ordenDetalle').serialize(), 

                
                success: function(data){
                    $(".pages").load("../orden/CListarorden/index");                    
                },
                error:function(){
                    alert("failure1");
                }
            });
        });

        $('#regresar').click(function(){
            $.ajax({
                //url: "../orden/CListarorden/actualizarOrden",
                //type:"post",
                //data: $('#ordenDetalle').serialize(), 

                
                success: function(data){
                    $(".pages").load("../orden/CListarorden/index");                    
                },
                error:function(){
                    alert("failure1");
                }
            });
        });
    });
</script>

    <div class='row' style='padding-top:25px; padding-bottom:25px;'>
        <div class='col-md-12'>
            <div id='mainContentWrapper'>
                <div class="col-md-8 col-md-offset-2">
                    <h2 style="text-align: center;">
                        Detalle De La Orden **************
                    </h2>
                    <hr/>
                    <a href="#" class="btn btn-info" style="width: 100%;">Orden # <?php echo $orden[0]->id_pedido.$orden[0]->secuencia_orden; ?></a>
                    <form name="ordenDetalle" id="ordenDetalle" action="" method="">
                    <table class="table">
                        <tr>
                            <td>
                                <select class="form-control" name="estado">
                                    <?php
                                        foreach ($estados as $value) {
                                            ?>
                                            <option value='<?php echo $value->id_pedido_estado;  ?>'><?php echo $value->pedido_estado;  ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                <input type="hidden" name="idOrden" value="<?php echo $orden[0]->id_pedido ?> ">
                            </td>
                            <td>
                                <a href="#" class="btn btn-info" name="" id="actualizar_orden">Actualizar</a>
                                <a href="javascript:window.print()" class="btn btn-primary" id="imprimir_orden" >Imprimir</a>
                                <a href="#" class="btn btn-danger" id="regresar">Regresar</a>
                            </td>
                        </tr>
                    </table>
                    </form>
                    
                    <hr/>
                    <div class="shopping_cart">
                        <form class="form-horizontal" role="form" action="" method="post" id="payment-form">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Resumen del Pedido</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items">
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>Producto</td>
                                                            <td>Cantidad</td>                                                            
                                                            <td>Precio Original</td>
                                                            <td>Precio Grabado</td>
                                                        </tr>
                                                        <?php
                                                            foreach ($orden as $value) {
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <b><?php echo $value->nombre_producto; ?></b>
                                                                    </td>
                                                                    <td><?php echo $value->cantidad; ?></td>
                                                                    <td><?php echo $value->moneda .' '. number_format($value->precio_grabado,2); ?></td>
                                                                    <td>
                                                                        <?php echo $value->moneda .' '. number_format($value->precio_original,2); ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                        <tr>
        
                                                            <td>Totales</td>
                                                            <td>
                                                                <?php
                                                                    $total_cantidad = 0;
                                                                    foreach ($orden as $value) {

                                                                        $total_cantidad += $value->cantidad;
                                                                    }
                                                                    echo $total_cantidad ;

                                                                ?>
                                                            </td>
                                                            <td>
                                                                <b>
                                                                    <?php
                                                                    $total =0;
                                                                    foreach ($orden as $value) {
                                                                        $total += $value->precio_original * $value->cantidad;
                                                                    }
                                                                   
                                                                    echo $orden[0]->moneda .' '. number_format($total, 2);
                                                                    ?>
                                                                </b>
                                                            </td>
                                                            <td>
                                                                <b>
                                                                <?php
                                                                    $total =0;
                                                                    foreach ($orden as $value) {
                                                                        $total += $value->precio_grabado * $value->cantidad;
                                                                    }
                                                                    
                                                                    echo $orden[0]->moneda .' '. number_format($total, 2);
                                                                ?>
                                                                </b>
                                                            </td>
                                                            
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>Total Orden</h3>
                                                        <h3><span style="color:green;">
                                                            <?php
                                                            $total =0;
                                                            foreach ($orden as $value) {
                                                                $total += $value->precio_grabado * $value->cantidad;
                                                            }
                                                            echo $orden[0]->moneda .' '. number_format($total, 2);
                                                            ?>
                                                        </span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;">Cliente</div>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <?php echo $orden[0]->cliente; ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;">Datos de Pedido</div>
                                        </h4>
                                </div>

                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body">
                                        <table class="table">
                                                <tr>
                                            <td>
                                                <span class="">Correo</span>                                                
                                            </td>
                                            <td>
                                                <?php echo $orden[0]->email; ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                <span class="">Telefono</span>                                                
                                            </td>
                                            <td>
                                                <?php echo $orden[0]->telefono1; ?>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                <span class="">Celular</span>                                                
                                            </td>
                                            <td>
                                                <?php echo $orden[0]->celular1; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="">Fecha Pedido</span>                                                
                                            </td>
                                            <td>
                                                <?php echo $orden[0]->fechahora_pedido; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="">Tarjeta</span> 
                                                

                                            </td>
                                            <td>
                                                <?php echo $orden[0]->tarjeta; ?>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>
                                                
                                                <span class="">CVS </span>
                                                
                                               
                                            </td>
                                            <td>
                                                <?php echo $orden[0]->cvs; ?><br>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                               
                                                <span class="">Fecha Pedido </span>
                                               
                                            </td>
                                            <td>
                                                 <?php echo $orden[0]->fecha_sugerida_entrega; ?>
                                            </td>
                                        </tr>  
                                        <tr>
                                            <td>De </td>
                                            <td><?php echo $orden[0]->de; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Para </td>
                                            <td><?php echo $orden[0]->para; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Dedicatoria </td>
                                            <td><?php echo $orden[0]->dedicatoria; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Direccion </td>
                                            <td><?php echo $orden[0]->direccion; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nota Interna </td>
                                            <td><?php echo $orden[0]->nota_interna; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Estado </td>
                                            <td><?php echo $orden[0]->pedido_estado; ?></td>
                                        </tr>
                                    </table>
                                    </div>
                                </div>

                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;">Datos de produccion</div>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <table class="table">
                                        <tr>
                                            <td>Pais </td>
                                            <td><?php echo $orden[0]->nombre_pais; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Departamento </td>
                                            <td><?php echo $orden[0]->nombre_departamento; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Sucursal </td>
                                            <td><?php echo $orden[0]->nombre_sucursal; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nodo </td>
                                            <td><?php echo $orden[0]->id_nodo; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Encargado de Produccion </td>
                                            <td><?php echo $orden[0]->Uno; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Encargado de Entrega </td>
                                            <td><?php echo $orden[0]->Dos; ?></td>
                                        </tr>
                                    </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
      

        
                               
                            </div>

                         
                    </div>
                </div>
                </form>
            </div>
        </div>
    


