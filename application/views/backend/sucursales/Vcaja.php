<!DOCTYPE html> 
<html> 
<head> 
    <title><?php echo $datoSucursal[0]['nombre_sucursal'];  ?></title>

    <script src="../../../../../js/jquery.js"></script>
    <link rel="icon" href="../../../../../assets/images/caja/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" media="screen" href="../../../../../assets/css/caja/estilo.css" />
	<link rel="stylesheet" href="../../../../../assets/css/TimeCircles.css" /> 
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <link href="../../../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
    

	<script src="../../../../../assets/js/TimeCircles.js"></script>
	<script src="../../../../../js/bootstrap.min.js"></script>



</head>
<script language="javascript">
$( document ).ready(function() 
{
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
 
 $(".doCompras").click(function()
    {
        $(".ModaAddCompras").modal({
           backdrop: 'static', 
           keyboard: true 
        });


    });
});   

</script>
<style type="text/css">
.panel-success>.panel-heading 
{
	color: #000 !important;
    background-color: #607D8B;
    font-weight: bold !important;
}
</style>
<body>
<div class="cont-general">

	<div class="secction-right">
		<h2>Ordenes en cocina.</h2>
		<hr>
   
   <!--     Panel de ordenes en cocina -->	
	<div class="panel panel-success" style="color: #000;">
		<div class="panel-heading">
			<div class="timer" data-date="2018-01-01 00:00:00" style="width: 100%;"></div>
		</div>
		<span class="num-cuenta">Cuenta #16 </span><span class="antendida">Atendida por Jose Lopez</span>
		<div class="panel-body">
			<ul class="list-group">
			  <li class="list-group-item">Cras justo odio</li>
			  <li class="list-group-item">Dapibus ac facilisis in</li>
			  <li class="list-group-item">Morbi leo risus</li>
			  <li class="list-group-item">Porta ac consectetur ac</li>
			  <li class="list-group-item">Vestibulum at eros</li>
			</ul>
		</div>
	</div>
	<!-- fin Panel de ordenes en cocina -->
	
	</div>

	<div class="main-contenido">
	<div class="main header">
		<header>
		<nav>
			<ul>
			<li><a title="Opcion 1" href="#">Detalle</a></li>
			<li><a title="Opcion 2" href="#">Historial</a></li>
			<li><a title="Opcion 3" href="#">Corte Z</a></li>
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
			<button type="button" class="btn btn-default" style="height: 40px;">Tiquete</span></button> 
			<button type="button" class="btn btn-default" style="height: 40px;">Cerrar</button> 
			</div>
			<input class="form-control" placeholder=" Numero Mesa" aria-label="Text input with multiple buttons" style="width: 30%;height: 42px;border: 2px solid #88b32f;">
		</div>
	</center>	 
	</div>		

	<div class="panel panel-primary">
	  <div class="panel-heading">
	  <span class="num-cuenta">Cuenta #16 </span><span class="antendida">Atendida por Jose Lopez</span></div>
	  	<div class="btn-group" role="group">
		  <button type="button" class="btn btn-default" style="height: 40px;">Factura</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Fiscal</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Orden</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Tiquete</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Cerrar</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Anular</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Descuento</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">Cupon</button>
		  <button type="button" class="btn btn-default" style="height: 40px;">VIP</button>
		</div>
	  <div class="panel-body">
	   <div class="alert alert-success" role="alert">
	   	<span class="mesa badge">1</span>
	   	<span class="formula">((($33.63 + $4.37) = $38.00) + $3.80) - $0.00 =	<span class="total">$41.80</span></span>
	   </div>	
	   	<div class="iten-cuenta">
	   		<ul class="list-group">
				<li class="list-group-item">
				<input type="checkbox" name="item-venta[]" value="0"> Dapibus ac facilisis in</li>
				<li class="list-group-item"> 
				<input type="checkbox" name="item-venta[]" value="0"> Dapibus ac facilisis in</li>
				<li class="list-group-item">
				 <input type="checkbox" name="item-venta[]" value="0"> Morbi leo risus</li>
				<li class="list-group-item">
				 <input type="checkbox" name="item-venta[]" value="0"> Porta ac consectetur ac</li>
				<li class="list-group-item">
				 <input type="checkbox" name="item-venta[]" value="0"> Vestibulum at eros</li>
			</ul>
	   	</div>
	   	<div class="list-logs">
	   		<div>test de log</div>
	   		<div>test de log</div>
	   		<div>test de log</div>
	   		<div>test de log</div>
	   		<div>test de log</div>
	   		<div>test de log</div>
	   	</div>
	  </div>
	</div>
</div>


</div>


<!-- Codigo de funcionalidad de Modals para registrar compras en caja -->
<div class="modal fade ModaAddCompras" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
         <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title">
           Compras
          </h4>
          <hr>
        <div class="modal-body">
                 <form id="addCompra" method="POST">
                  <div class="col-md-12">
                  <span class="input input--hoshi col-md-6">
                      <input class="input__field input__field--hoshi" type="text" id="nombre" required name="nombre" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Comprado a</span>
                      </label>
                  </span>

                   <span class="input input--hoshi col-md-6">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>
                  </div>
                  <div class="col-md-12">


                    <span class="input input--hoshi col-md-6">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Precio</span>
                      </label>
                  </span>


                    <span class="input input--hoshi col-md-6">
                       <span class="input__label-content">Pagado via</span>
                        <select style="width: 60%;" class="form-control form-grey" name="categoria" id="categoria" data-style="white" data-placeholder="Seleccion una categoria">
                        <option value="caja">caja</option>
                        <option value="cheque">cheque</option>
                        </select>   
                     </span>

                   <span class="input input--hoshi col-md-12">
                     <button type="button" id="saveCategoria" class="btn btn-primary">Guardar</button>
                  </span>
                  </div>
                 </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  

</body>
</html>


