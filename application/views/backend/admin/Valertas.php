<script type="text/javascript">
	$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>

<style type="text/css">
	/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #5A55A3;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #5A55A3;
  background-image: #5A55A3;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #5A55A3;
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

.logo{
	width: 100%;
	height: 100%;
	background: black;
	padding: 10px;
	margin-top: 40%;
}


div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}
</style>

	<div class="tab-content">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 class="glyphicon glyphicon-home"></h4><br/>Inicio
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-alert"></h4><br/>Alertas
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-home"></h4><br/>Null
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-cutlery"></h4><br/>Null
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="glyphicon glyphicon-credit-card"></h4><br/>Null
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active data">
                    <center>
                    	<h2 class="glyphicon glyphicon-home" style="font-size:12em;color:#55518a"></h2>
                    	

                      <h2 style="margin-top: 0;color:#55518a">BIENVENIDOS</h2>
                      <h3 style="margin-top: 0;color:#55518a">Sistema Administrativo</h3>
                      
                    </center>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
                    <center>
                      <h2 class="glyphicon glyphicon-alert" style="font-size:12em;color:#55518a"></h2>                      
                      <h2 style="margin-top: 0;color:#55518a">Minimos En Existencias</h2>
                      <h3 style="margin-top: 0;color:#55518a">Necesita Alimentar el inventario</h3>
                    </center>
                    <table class="table">
                    	<tr>
                    		<th>Sucursal</th>
                    		<th>Material</th>
                    		<th>Minimo</th>
                    		<th>Maximo</th>
                    		<th>Total</th>
                    	</tr>
                    	<?php
                    	foreach ($existencias as $existencia) {
                    		?>
                    		<tr>
                    			<td><?php echo $existencia->nombre_sucursal; ?></td>
                    			<td><?php echo $existencia->nombre_matarial; ?></td>
                    			<td><?php echo $existencia->minimo_existencia .' '.$existencia->simbolo_unidad_medida; ?></td>
                    			<td><?php echo $existencia->maximo_existencia .' '.$existencia->simbolo_unidad_medida; ?></td>
                    			<td><?php echo $existencia->total_existencia .' '.$existencia->simbolo_unidad_medida; ?></td>
                    		</tr>
                    		<?php
                    	}
                    	?>
                    </table>
                </div>
    
                <!-- hotel search -->

            </div>
        </div>
    </div>

