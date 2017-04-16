<script type="text/javascript">
    $(document).ready(function(){
        $(".footer").click(function(){
            var id = $(this).attr("id");
            $.ajax({        
                url: "../alertas/Calertas/getAlertasNoVistas/"+id, 
                type:"post",                         
                data: $('#filtros').serialize(),               
                

                success: function(data){   
                    
                    $(".detalle_alertas").html(data);
                },
                error:function(){            
                    alert("Error Al Despachar Pedido");
                }
            }); 
        });
    })
</script>
<style type="text/css">
	.footer{		
		color: black;
	}
	.text-right{
		text-align: center;
		float: right;
		display: inline-block;
		
		color: black;
	}
	.fondo{
		background: #9AC835;
		border:1px solid;
		border-radius: 5px 5px 5px 5px;
	}
	.huge{
		font-size: 30px;
	}
    .filtro{
        text-align: center;
    }
</style>

<div id="page-wrapper">
    <div class="container-fluid">
    	<div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="fondo">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $vistas[0]->Total ?></div>
                                        <div>Acceso al Sistema</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="footer" id="1">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalle</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fondo">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-money fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <div class="huge">0</div>
                                        <div>Cortes</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="footer" id="2">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalle</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fondo">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <div class="huge">0</div>
                                        <div>Pedidos</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="footer">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalle</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="fondo">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-book fa-5x"></i>
                                    </div>
                                    <div class="col-xs-8 text-right">
                                        <div class="huge">0</div>
                                        <div>Otros</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="footer">
                                <div class="panel-footer">
                                    <span class="pull-left">Detalle</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
        </div>
        <form id="filtros">
        <div class="row">
            <br>
            <div class="col-md-3"></div>
            <div class="col-md-3">Fecha Inicio</div>
            <div class="col-md-3">Fecha Fin</div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <br>
            <div class="col-md-3">
                <select name="mensaje" class="form-control">
                    <option value="todos">Todos</option>
                    <?php
                    foreach ($mensajes as $msj) {
                        ?>
                        <option value="<?php echo $msj->id_mensaje; ?>"><?php echo $msj->mensaje; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control" name="inicio" value="<?php echo date("Y-m-d") ?>">
            </div>

            <div class="col-md-3">
                <input type="date" class="form-control" name="fin" value="<?php echo date("Y-m-d") ?>">
            </div>
            <div class="col-md-3">
                <select name="sucursal" class="form-control">
                    <option value="todas">Todos</option>
                    <?php
                    foreach ($sucursales as $sucursal) {
                        ?>
                        <option value="<?php echo $sucursal->id_sucursal; ?>"><?php echo $sucursal->nombre_sucursal; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        </form>

        <div class="row">
            <br>
            <div class="detalle_alertas">
                
            </div>
        </div>
    </div>
</div>
