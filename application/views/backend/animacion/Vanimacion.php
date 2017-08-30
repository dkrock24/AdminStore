<?php
session_start();

include_once("class_db/configuracion.php");

$info = config();

?>


	    <script src="../../../assets/plugins/charts-sparkline/sparkline.min.js"></script> <!-- Charts Sparkline -->

	<script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous 
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->

    <script src="../../../assets/plugins/icheck/icheck.min.js"></script> <!-- Checkbox & Radio Inputs -->

    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    

    <!-- BEGIN PAGE SCRIPT -->
  
    <script src="../../../assets/js/pages/form_icheck.js"></script>  <!-- Change Icheck Color - DEMO PURPOSE - OPTIONAL -->


<script>
$(document).ready(function(){

	$(".msg2").hide();
	
	var data = $("#login1").is(":checked");
	var idConfig = $("#idConfig").val();

	$("#btn_login").click(function(){
		var data = $("#login1").is(":checked");
		
		if(data ==true)
		{
			var login = 1;
		}
		else
		{
			var login = 0;
		}
		Ajax(idConfig,login);
	});

	var idSession= $("#idSession").val();
	$("#btn_session").click(function(){
		var data = $("#session1").is(":checked");
		
		if(data ==true)
		{
			var login = 1;
		}
		else
		{
			var login = 0;
		}
		Ajax(idSession,login);
	});
	function Ajax(id,valor)
	{
	$.ajax({
		    url: "../../../class_db/configuracion.php",
		    type:"post",
		    data: { val1 : id ,val2: valor },
		    
		    success: function(){
		        $(".msg2").slideDown(200, function(){
		        	$(".msg2").show();
			        setTimeout(function() {
			        	$(".msg2").slideUp(2000);
			        }, 3000);
		        });
		    },
		    error:function(){
		        alert("failure1");
		    }
	});
}
})

</script>

<style>
.msg2{
    background-color: #9AC835;
  }
</style>

<div class="row alert-success msg2">
        <div class="col-md-12">         
          <div class="msg2" ><h3><strong>Cambio Realziados!</strong> Satisfactoriamente.</h3></div>
        </div>
    </div>

<br>
<div class="row">
    <div class="col-md-4">
    	<div class="panel">
                	<div class="panel-header bg-primary">
                 		Activar Slider del Login
                	</div>

                	<div class="panel-content">
                		<div class="form-group">
                              <p><strong>Opciones</strong></p>
                              <div class="input-group">
                                <div class="icheck-list">
                                
                                <?php

                                $n=0;
                                $a = count($info['id']);
								while($n<$a)
								{
									if($info['pagina'][$n] == 'login')								
										{
											?>
											<input type="hidden" id="idConfig" value="<?php echo $info['id'][$n]; ?>">
											<?php
											$info['pagina'][$n];
											$valor =  $info['accion'][$n];	
											if($valor == '1')										
											{
												?>
													<label><input type="radio" name="login1" id="login1" checked="checked" data-radio="iradio_minimal-blue" value="Activar">Activar</label>
				                                  	<label><input type="radio" name="login1" id="login1" data-radio="iradio_minimal-blue" value="Desactivar">Desactivar</label>                                  
												<?php
											}
											else
											{
												?>
													<label><input type="radio" name="login1" id="login1"  data-radio="iradio_minimal-blue" value="Activar">Activar</label>
				                                  	<label><input type="radio" name="login1" id="login1" checked="checked" data-radio="iradio_minimal-blue"  value="Desactivar"> Desactivar</label>                                  
												<?php

											}
										$n++;
										}
									$n++;
								}
                                ?>
                                  
                                </div>
                                <button class="btn btn-default"  id="btn_login">Guardar</button>                                
                                </form>
                              </div>
                            </div>
                  	</div>
        </div>
    </div>

    <div class="col-md-4">
     	<div class="panel">
                	<div class="panel-header bg-primary">
                 		Slider del bloqueo.
                	</div>

                	<div class="panel-content">
                	<div class="form-group">
                              <p><strong>Opciones</strong></p>
                              <div class="input-group">
                                <div class="icheck-list">
                                	<?php
                                	$n=0;
                                	$a = count($info['id']);
									while($n<$a) {	
										if($info['pagina'][$n] == 'user-lockscreen')								
										{
											?>
											<input type="hidden" id="idSession" value="<?php echo $info['id'][$n]; ?>">
											<?php
											$info['pagina'][$n];
											$valor =  $info['accion'][$n];	
											if($valor == '1')										
											{
												?>
													<label><input type="radio" name="session" id="session1" checked="checked" data-radio="iradio_minimal-blue" value="Activar">Activar</label>
				                                  	<label><input type="radio" name="session" id="session1" data-radio="iradio_minimal-blue" value="Desactivar">Desactivar</label>                                  
												<?php
											}
											else
											{
												?>
													<label><input type="radio" name="session" id="session1"  data-radio="iradio_minimal-blue" value="Activar">Activar</label>
				                                  	<label><input type="radio" name="session" id="session1" checked="checked" data-radio="iradio_minimal-blue"  value="Desactivar"> Desactivar</label>                                  
												<?php

											}
										
										}
										$n++;									
										
									}
                                ?>
                                  
                                </div>
                                <button class="btn btn-default" id="btn_session">Guardar</button> 
                              </div>
                            </div>
                  	</div>
        </div>
    </div>

    <div class="col-md-4">
     	<div class="panel">
                	<div class="panel-header bg-primary">
                 		Imagen Session
                	</div>

                	<div class="panel-content">
                		<div class="form-group">
                              <p><strong>Opciones</strong></p>
                              <div class="input-group">
                                <div class="icheck-list">
                                  <label><input type="radio" name="imagen1" checked data-radio="iradio_minimal-blue">Activar</label>
                                  <label><input type="radio" name="imagen1" data-radio="iradio_minimal-blue"> Desactivar</label>                                  
                                </div>
                              </div>
                            </div>
                  	</div>
        </div>
    </div>
</div>

