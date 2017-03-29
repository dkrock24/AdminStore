 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
    <script src="assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
    <link href="assets/plugins/input-text/style.min.css" rel="stylesheet">

<!--    <script src="assets/js/pages/form_icheck.js"></script> -->
    <!-- END PAGE STYLE -->

<?php

session_start();
include_once("../class_db/class_p_nacimiento.php");

$data = empresa();



?>
<script>
	$(document).ready(function(){

		$("#updateInfo").click(function(){
			alert("demo");
			$(".pages").load("pages/p_informacion_update.php");        
		});
		
		
	})
</script>
<style>
.opciones{
	float: right;
	margin-top: -10px;
}
</style>

<div class="row">
    <div class="col-md-12">
    	<div class="panel">
            <div class="panel-header bg-primary">
            	Información de la Municipalidad
            	<div class="opciones">
            		<a href="#" id="updateInfo" class='btn btn-primary btn-small'>Actualizar</a>
            	</div>
            </div>
            <div class="panel-content">
            	<div class="row">
            		<div class="col-md-4">
            			<strong>Nombre Institución:</strong> <br>
            			<?php echo $data['nombre_empresa']; ?>
            		</div>
            		<div class="col-md-4"><strong>Rubro</strong><br>
            			<?php echo $data['rubro_empresa']; ?>
            		</div>
            		<div class="col-md-4"><strong>País</strong><br>
            			<?php echo $data['pais']; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Departamento</strong><br>
            			<?php echo $data['departamento']; ?>
            		</div>
            		<div class="col-md-4"><strong>Municipio</strong><br>
            			<?php echo $data['municipio']; ?>
            		</div>
            		<div class="col-md-4"><strong>Telefono</strong><br>
            			<?php echo $data['telefono']; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Fax</strong><br>
            			<?php echo $data['fax']; ?>
            		</div>
            		<div class="col-md-4"><strong>Nit</strong><br>
            			<?php echo $data['nit']; ?>
            		</div>
            		<div class="col-md-4"><strong>Nombre Alcalde</strong><br>
            			<?php echo $data['nombre_alcalde']; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Nombre Secretario</strong><br>
            			<?php echo $data['nombre_secretario']; ?>
            		</div>
            		<div class="col-md-4"><strong>Jefe del registro familiar</strong><br>
            			<?php echo $data['jefe_registro_familiar']; ?>
            		</div>
            		<div class="col-md-4"><strong>Logo</strong><br>
            		<img src="assets/images/logo/<?php echo $data['logo_empresa']; ?>" width="40%">
            		
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>