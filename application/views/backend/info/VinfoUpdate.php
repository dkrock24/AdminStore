
<script>
var f = new Date();
var fechadeldia = f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds();
	$(document).ready(function(){
        //../info/Cinfo/update
        $('.alertt').hide();
        $("#regresar").click(function(){          
            $(".pages").load("../info/Cinfo/index");        
        });

        $("#updateInfo").click(function(){ 
            var filename = $("#fleImagen").val().replace(/C:\\fakepath\\/i, '');

            
            var formData = new FormData();
            formData.append('file', $('#fleImagen')[0].files[0]);
            formData.append('accion', 'subirImageNota');
            formData.append('nuevo_nombre', fechadeldia);
            if(filename!=""){
                $("#nombreImagen").val(fechadeldia+filename);
                subirImageNota(formData);
            }
            

            $.ajax({
                url: "../info/Cinfo/saveUpdate",
                type:"post",
                dataType: "json",
                data: $('#informacionGeneral1').serialize(),

                success: function(data){  
                    var info = "<strong>Cambios Guardados</strong> Correctamente...";
                    msj(info);
                },
                error:function(){
                    var info = "<strong>Cambios Guardados</strong> Correctamente...";
                    msj(info);
                    //alert("Error.. No se subio la imagen");
                }
            });     
       });

        function subirImageNota(formData)
        {
            $.ajax({
            url: "../../../class_db/saveUsuario.php",
            type:"post",
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            data: formData,

                success: function(){
                },
                error:function(){
                }
            });
        }

        function msj(info){
                $('.alertt').html(info);
                $(".alertt").slideDown(200, function(){
                        $(".alertt").show();
                        setTimeout(function() {
                            $(".alertt").slideUp(1000);
                            $(".pages").load("../info/Cinfo/index"); 
                        }, 2000);
                    });
            
        }

        $('#fleImagen').change(function(){ 
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $("#preview").fadeIn("low").attr('src',URL.createObjectURL(event.target.files[0]));

                var file = this.files[0];
                var fileName = file.fileName;                
                var fileSize = file.size;                    

                sizeInMB = (fileSize / (1024*1024)).toFixed(2);
                 var fileType = this.files[0].type;
                 //alert(fileType);
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
            	Información de la Empresa
            	<div class="opciones">
                    <a href="#" id="regresar" class='btn btn-primary btn-small'>Regresar</a>
            		<a href="#" id="updateInfo" class='btn btn-primary btn-small'>Guardar</a>
            	</div>
            </div>
            <div class="panel-content">
            <div class="alert alert-success alertt" role="alert"></div>
            <form action="#" method="post" id="informacionGeneral1">
            	<div class="row">
            		<div class="col-md-4">
            			<strong>Nombre Empresa:</strong> <br>
                        <input type="text" value="<?php echo $info[0]->nombre_empresa; ?>" name="nombreInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Rubro</strong><br>
                    <input type="text" value="<?php echo $info[0]->rubro_empresa; ?>" name="rubroInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>País</strong><br>
                    <input type="text" value="<?php echo $info[0]->pais; ?>" name="paisInstitucion">
            			
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Departamento</strong><br>
                    <input type="text" value="<?php echo $info[0]->departamento; ?>" name="departamentoInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Municipio</strong><br>
                    <input type="text" value="<?php echo $info[0]->municipio; ?>" name="municipioInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Telefono</strong><br>
                    <input type="text" value="<?php echo $info[0]->telefono; ?>" name="telefonoInstitucion">
            			
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Fax</strong><br>
                    <input type="text" value="<?php echo $info[0]->fax; ?>" name="faxInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Nit</strong><br>
                    <input type="text" value="<?php echo $info[0]->nit; ?>" name="nitInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Nombre Representante</strong><br>
                    <input type="text" value="<?php echo $info[0]->nombre_alcalde; ?>" name="nombre_alcaldeInstitucion">
            			
            		</div>
            	</div>
            	<hr>
            	<div class="row">
            		<div class="col-md-4"><strong>Nombre Sub Representante</strong><br>
                    <input type="text" value="<?php echo $info[0]->nombre_secretario; ?>" name="nombre_secretarioInstitucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Jefe de Area</strong><br>
                    <input type="text" value="<?php echo $info[0]->jefe_registro_familiar; ?>" name="nombre_secretario2Institucion">
            			
            		</div>
            		<div class="col-md-4"><strong>Logo</strong><br>
            		<img src="../../../assets/images/avatars/<?php echo $info[0]->logo_empresa; ?>" width="40%">
                    <img src="" id="preview" width='100px'>
                    <input type="file" name="fleImagen" id="fleImagen" multiple>
                    <input type="hidden" name="nombreImagen" id="nombreImagen" value="">
            		
            		</div>
            	</div>
                </form>
            </div>
        </div>
    </div>
</div>