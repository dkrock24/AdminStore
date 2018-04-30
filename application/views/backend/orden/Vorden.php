<script>
var datosTemp;

function myFunction(id_producto){
    $(document).ready(function(){

            $.ajax({
                url: "../orden/Corden/getProductoById/"+id_producto,
                type:"get",
                 dataType : "json",
                
                success: function(data){
                    //console.log(data[0].nombre_producto);
                    $("#producto_imagen").attr('src','/kaprichos/uploaded/mod_productos/'+data[0].image);
                    $('#producto_titulo').text(data[0].nombre_producto);
                    $('#producto_precio').text(data[0].numerico1);
                    $('#producto_minimo').text(data[0].numerico1);
                    $('#producto_categoria').text(data[0].nombre_categoria_producto);
                    $('#producto_descripcion').text(data[0].description_producto);

                    $('.producto_id').attr('name',data[0].id_producto);                    

                    $('#viewProducto').modal({
                        show: 'true'
                    });      
                    datosTemp = data ;
                },
                error:function(){
                    alert("failure1");
                }
            });
  
    });
}

function agregar(id_producto){
    $(document).ready(function(){
        
        var cantidad = $('#producto'+id_producto).val();
        var ck = $('#minimo'+id_producto).prop('checked');

            $.ajax({
                url: "../orden/Corden/agregar/"+id_producto+"/"+cantidad+"/"+ck,
                type:"get",

                
                success: function(data){
                    //console.log(data);
                    $('.resumen').html(data);
                    //$('.data').empty();        
                },
                error:function(){
                    alert("Error Datos Temp");
                }
            });
  
    });
}

function deleteItem(id_producto){
    
    $.ajax({
            url: "../orden/Corden/delete/"+id_producto,
            type:"post",

            
            success: function(data){
                //console.log(data);
                $('.resumen').html(data);               
                
            },
            error:function(){
                alert("failure1");
            }
        });
}

function cerrarBuscador(){
    $(document).ready(function(){

        $('.data').empty();   

    });
}
    
$(document).ready(function(){

    var sucursalId = $("#sucursalId").val();
    $("#sucursalActiva").val(sucursalId);

    $("#sucursalId").change(function(){        
        $("#sucursalActiva").val($(this).val());
    });

    $(".borrarBusqueda").click(function(){
        $("#codProducto").val('');
        $("#categoria").val('');
         $("#sucursalId").val('');
        
    });

    $(".buscar").click(function(){

        var inputCodigo = $("#codProducto").val();
        var inputCategoria = $("#categoria").val();

        if( inputCodigo != "" ||  inputCategoria != ""){

            $.ajax({
                url: "../orden/Corden/buscar",
                type:"post",
                data: $('#ordenForm').serialize(), 

                
                success: function(data){
                    //console.log(data);
                    $('.data').html(data);               
                    
                },
                error:function(){
                    alert("failure1");
                }
            });
        }     
        else{
            alert("Proporsione Codigo o Categoria de Producto");
        }   
        
    }); 

    $('.producto_id').click(function(){
        $.ajax({
            url: "../orden/Corden/agregar/"+datosTemp[0].id_producto,
            type:"get",

            
            success: function(data){
                //console.log(data);
                $('.resumen').html(data);
                $('.data').empty();        
            },
            error:function(){
                alert("Error Datos Temp");
            }
        });
    });

    // Procesar Orden
    $("#procesar_orden").click(function(){
        
        $.ajax({
            url: "../orden/Corden/procesarOrden",
            type:"post",
            data: $('#detalle_orden').serialize(), 

            
            success: function(data){

                $('.data').empty();     
                $('.resumen').empty();          
                
            },
            error:function(){
                alert("failure1");
            }
        });
    });

    $('#nueva_orden').click(function(){
        $("#detalle_orden")[0].reset();
    });


});

</script>

	
    <div class="row">
    	<form name="ordenForm" id="ordenForm" method="post">
        <div class="col-xs-12">

          
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                      
                             <div class="panel-heading" style="background: rgb(216, 39, 135);">Codido Producto</div>
                            <div class="panel-body" style="border:1px solid grey;">
                                <input type="text" name="codProducto" style="display: inline-block;" id="codProducto" value="" class="form-control" placeholder="Codigo">
                            </div>
                    </div>
                </div>
                    
                       
                        


                   
            
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Categoria</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <select class="form-control" name="categoria" id="categoria">
                                <option></option>
                                <?php

                                foreach ($categorias as $categoria) {
                                    ?><option value="<?php echo $categoria->id_categoria_producto; ?>"><?php echo $categoria->nombre_categoria_producto ?></option><?php
                                }
                                ?>
                            	
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Sucursal</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <select class="form-control" name="sucursal" id="sucursalId">
                            	<?php

                                foreach ($sucursales as $sucursal) {
                                    ?><option value="<?php echo $sucursal->id_sucursal; ?>"><?php echo $sucursal->nombre_sucursal.' / '. $sucursal->nombre_departamento ?></option><?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Buscar Producto</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <div class="row">
                                <div class="col-xs-6 col-md-6"><a href="#" class="buscar form-control btn btn-primary">Buscar</a></div>
                                <div class="col-xs-6 col-md-6"><a href="#" class="borrarBusqueda form-control btn btn-danger">Borrar</a></div>
                            </div>
                                                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    	</form>
    </div>

    <div class="row">
        
		<div class="col-md-12 data">
			
		</div>
	</div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Resumen de la Orden</strong></h3>
                </div>
                <div class="panel-body">
                    
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>Producto</strong></td>
                                    <td class="text-center"><strong>Precio Sugerido</strong></td>
                                    <td class="text-center"><strong>Precio Minimo</strong></td>
                                    <td class="text-center"><strong>Cantidad</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                    <td class="text-right"><strong></strong></td>
                                </tr>
                            </thead>
                            <tbody class="resumen">
                                
                            </tbody>                            
                        </table>
                        
                    </div>
                </div>
                <form action="#" id="detalle_orden" method="post">
                <div class="row">
                    <div class="col-md-6">
                        Cliente : <input type="text" placeholder="Nombre Completo" name="cliente" class="form-control">
                    </div>
                    <div class="col-md-6">
                        E-mail : <input type="email" placeholder="E-Mail" name="email" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">Telefono : <input type="text" placeholder="Telefono" name="telefono" class="form-control"></div>
                            <div class="col-md-6">Celular : <input type="text" placeholder="Celular" name="celular" class="form-control"></div>
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                De : <input type="text" name="de" placeholder="De" class="form-control">
                            </div>
                            <div class="col-md-6">
                                Para : <input type="text" name="para" placeholder="Para" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Direccion de Entrega: <textarea name="direccion" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        Dedicatoria : <textarea name="texto" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">Fecha Entrega : <input type="date" name="fecha_entrega" value="<?php echo date('Y-m-d'); ?>" class="form-control"></div>
                            <div class="col-md-6">Pagado?<br>
                                <select class="form-control" name="pagado">
                                    <option value="1">Cancelado</option>
                                    <option value="0">Pendiente</option>
                                </select>
                            </div>
                        </div>                        
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                Tarjeta Bancaria: <input type="text" name="tarjeta" placeholder="Tarjeta" class="form-control">
                            </div>
                            <div class="col-md-6">
                                CVS : <input type="text" name="cvs" placeholder="CVS" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         Nota Interna :<textarea name="nota_interna" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9"></div>
                    <div class="col-md-3">
                        <br>
                        <input type="hidden" name="sucursalActiva" value="" id="sucursalActiva">
                        <a href="#" name="guardarOrden" id="procesar_orden" class="btn btn-primary">Guardar Orden</a>
                        <a href="#" name="guardarOrden" id="nueva_orden" class="btn btn-danger">Nuevo Cliente</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>


<style>
	.height {
	    min-height: 200px;
	}

	.icon {
	    font-size: 47px;
	    color: #5CB85C;
	}

	.iconbig {
	    font-size: 77px;
	    color: #5CB85C;
	}

	.table > tbody > tr > .emptyrow {
	    border-top: none;
	}

	.table > thead > tr > .emptyrow {
	    border-bottom: none;
	}

	.table > tbody > tr > .highrow {
	    border-top: 3px solid;
	}
    .titulo_modal{
        padding: 10px;
        text-align: center;
        width: 100%;
        color: white;
    }

    .gridBuscar{
        height: 350px;
        overflow: scroll;

    }
</style>

<!-- Simple Invoice - END -->



<div class="modal fade" id="viewProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header" style="background: rgb(216, 39, 135);">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:white;">×</button>
            <div class="row">                
                <div class="col-md-12">
                    <b><h3 id="producto_titulo" class="titulo_modal"> </h3></b>
                </div>
            </div>
            
        </div> <!-- /.modal-header -->

        <div class="modal-body">
            <div class="row">                
                <div class="col-md-12" style="text-align: center;">
                    <img src="" width="300px" id="producto_imagen">
                </div>
                <div class="col-md-12">
                    <table class="table table-striped">
                        <tr>
                            <td>Precio Sugerido : </td>
                            <td><label id="producto_precio"></label></td>
                        </tr>
                        <tr>
                            <td>Precio Minimo : </td>
                            <td><label id="producto_minimo"></label></td>
                        </tr>
                        <tr>
                            <td>Categoria : </td>
                            <td><label id="producto_categoria"></label></td>
                        </tr>
                        <tr>
                            <td>Descripcion : </td>
                            <td><label id="producto_descripcion"></label></td>
                        </tr>
                        <tr>
                            <td>Activar Precio Sugerido</td>
                            <td><input type="checkbox" name="precioSugerido" value="0" class="form-check-input"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><a href="#" class="btn btn-default producto_id" name="">Agregar</a></td>
                        </tr>
                    </table>
                </div>
            </div>


        </div> <!-- /.modal-body -->

    <div class="modal-footer">
        

      </div> <!-- /.modal-footer -->

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




