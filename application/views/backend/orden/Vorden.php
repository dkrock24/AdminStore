<script>
$(document).ready(function(){

	$(".buscar").click(function(){
		
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
	});
})

<?php

//var_dump($productos);

?>

</script>

	
    <div class="row">
    	<form name="ordenForm" id="ordenForm">
        <div class="col-xs-12">
            <div class="text-center">
                <i class="fa fa-search-plus pull-left icon"></i>
                <h2>Orden #33221</h2>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-md-3 col-lg-3 pull-left">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Codido Producto</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <input type="text" name="codProducto" value="" class="form-control" placeholder="Codigo">

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Categoria</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <select class="form-control" name="categoria">
                            	<option value="1">Categorias</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Sucursal</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <select class="form-control" name="sucursal">
                            	<option value="2">Sucursal</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3 col-lg-3 pull-right">
                    <div class="panel panel-primary height">
                        <div class="panel-heading" style="background: rgb(216, 39, 135);">Buscar Producto</div>
                        <div class="panel-body" style="border:1px solid grey;">
                            <a href="#" class="buscar form-control">Buscar</a>
                            
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
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Samsung Galaxy S5</td>
                                    <td class="text-center">$900</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$900</td>
                                </tr>
                                <tr>
                                    <td>Samsung Galaxy S5 Extra Battery</td>
                                    <td class="text-center">$30.00</td>
                                    <td class="text-center">1</td>
                                    <td class="text-right">$30.00</td>
                                </tr>
                                <tr>
                                    <td>Screen protector</td>
                                    <td class="text-center">$7</td>
                                    <td class="text-center">4</td>
                                    <td class="text-right">$28</td>
                                </tr>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right">$958.00</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                    <td class="emptyrow text-right">$20</td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right">$978.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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
</style>

<!-- Simple Invoice - END -->


