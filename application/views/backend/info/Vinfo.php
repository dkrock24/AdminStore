
<script>
	$(document).ready(function(){
        //../info/Cinfo/update
		$("#updateInfo").click(function(){			
			$(".pages").load("../info/Cinfo/update");        
		});
		
	});
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
            		<a href="#" id="updateInfo" class='btn btn-primary btn-small'>Editar</a>
            	</div>
            </div>
            <div class="panel-content">
            	<div class="row">
            		<div class="col-md-4">
            			<strong>Nombre Institución:</strong> <br>
            			<?php echo $info[0]->nombre_empresa; ?>
            		</div>
            		<div class="col-md-4"><strong>Rubro</strong><br>
            			<?php echo $info[0]->rubro_empresa; ?>
            		</div>
            		<div class="col-md-4"><strong>País</strong><br>
            			<?php echo $info[0]->pais; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Departamento</strong><br>
            			<?php echo $info[0]->departamento; ?>
            		</div>
            		<div class="col-md-4"><strong>Municipio</strong><br>
            			<?php echo $info[0]->municipio; ?>
            		</div>
            		<div class="col-md-4"><strong>Telefono</strong><br>
            			<?php echo $info[0]->telefono; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Fax</strong><br>
            			<?php echo $info[0]->fax; ?>
            		</div>
            		<div class="col-md-4"><strong>Nit</strong><br>
            			<?php echo $info[0]->nit; ?>
            		</div>
            		<div class="col-md-4"><strong>Nombre Alcalde</strong><br>
            			<?php echo $info[0]->nombre_alcalde; ?>
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Nombre Secretario</strong><br>
            			<?php echo $info[0]->nombre_secretario; ?>
            		</div>
            		<div class="col-md-4"><strong>Jefe del registro familiar</strong><br>
            			<?php echo $info[0]->jefe_registro_familiar; ?>
            		</div>
            		<div class="col-md-4"><strong>Logo</strong><br>
            		<img src="../../../assets/images/avatars/<?php echo $info[0]->logo_empresa; ?>" width="40%">
            		
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>