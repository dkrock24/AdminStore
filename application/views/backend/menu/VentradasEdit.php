

    <link href="../../../assets/a/bootstrap.css" rel="stylesheet">
   	<script src="../../../assets/a/bootstrap.js"></script>    
    <link href="../../../assets/a/summernote.css" rel="stylesheet">
    <script src="../../../assets/a/summernote.js"></script>


<script type="text/javascript">
var f = new Date();
var fechadeldia = f.getDate()+""+(f.getMonth()+1)+""+f.getFullYear()+""+f.getHours()+""+f.getMinutes()+""+f.getSeconds();
	$(document).ready(function(){
		var sizeInMB=0.1;

		$('#fleImagen1').change(function(){ 
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $("#preview1").fadeIn("low").attr('src',URL.createObjectURL(event.target.files[0]));

                var file = this.files[0];
                var fileName = file.fileName;                
                var fileSize = file.size;                    

                sizeInMB = (fileSize / (1024*1024)).toFixed(2);
                 var fileType = this.files[0].type;
                 //alert(fileType);
            });

		// Guardar Notas Por Menu

    $("#updateEntrada").click(function(){
            var filename1 = $("#fleImagen1").val().replace(/C:\\fakepath\\/i, '');
            var fileDocument1 = $("#documento1").val().replace(/C:\\fakepath\\/i, '');

            var formData = new FormData();
            formData.append('file', $('#fleImagen1')[0].files[0]);
            formData.append('documento', $('#documento1')[0].files[0]);
            formData.append('accion', 'subirImageNota');
            formData.append('nuevo_nombre', fechadeldia);

            if(filename1!=""){
            	$("#nombreImagen1").val(fechadeldia+filename1);
            	
            }
            if(fileDocument1!=""){
            	$("#nombreDocumento1").val(fechadeldia+fileDocument1);
            }
            
            
            
                if(sizeInMB <= 0.20)
                {
                    //alert(sizeInMB + 'MB');
                    subirImageNota(formData);
                    $.ajax({
                        url: "../menu/ChomePages/UpdateNota",
                        type:"post",
                        dataType: "json",
                        data: $('#EditNotas').serialize(),               

                        success: function(){   

                            $('#notas').trigger("reset");
                            $('#preview').attr('src', '');
                            //$(".includ").load("pages/lista_menus.php"); 
                            //window.setTimeout('location.reload()', 1000);       
                        },
                        error:function(){
                           $('#notas').trigger("reset");
                           $('#preview').attr('src', '');
                            //alert("Error.. No se subio la imagen");
                        }
                    });
                }
                else
                {
                    alert("La Imagen Es Muy pesada");
                } 
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
                    //alert("sube");
                    $(".perfil").load("pages/avatar.php");
                },
                error:function(){
                    alert("Error.. No se subio la imagen");
                }
            });
        }

        $('#contenido1').summernote({
        minHeight: 200,
          maxHeight: 450,
          toolbar: [
            ['style', ['bold', 'italic', 'underline','clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['color', ['color']],
            ['table', ['table']],
            ['height', ['height']],
            ['fontsize', ['fontsize']],
            ['link', ['linkDialogShow', 'unlink']],
            ['insert', ['link', 'picture']],
            ['fontname',['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
            ['fontname', ['fontname']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
            ['style', ['style']],
            ['view', ['codeview']],
            ['misc', ['codeview']],
            ['para', ['ul', 'ol', 'paragraph']],
          ],
      });



	});


</script>


<style type="text/css" media="screen">
.abc{
	border:0px solid black;
	color:black;
	
}
.panel-body{
	background: #aaa;
	color: white;
}

.btn-success{
		background-color: #9AC835;
		color: white;
	}
	.btn.jumbo {
            font-size: 20px;
            font-weight: normal;
            padding: 14px 24px;
            margin-right: 10px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
            border-radius: 6px;
        }


<?php
foreach ($entradas as $entrada) {
	

?>

</style>
<form action="#" id="EditNotas" method="post">
<table class="table table-bordered table-striped">  


	<div class="row abc">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 	<h4> <span>Nombre del Título</span> </h4>
			  	<input type="text" class="form-control" id="titulo" size="100%" name="titulo1" value="<?php echo $entrada->titulo; ?>"/>
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 	<h4> <span>Nombre del Subtítulo</span> </h4>
			  	<input type="text" class="form-control" id="subtitulo" name="subtitulo1" value="<?php echo $entrada->subtitulo; ?>">
			  	</div>
			</div>
		</div>
    </div><br>

    <div class="row abc">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
			 	<h4> <span>Contenido de la Entrada</span> </h4>			  	
			  	<textarea class="textarea form-control" id="contenido1"  name="contenido1" style="width: 810px; height: 200px"><?php echo $entrada->contenido; ?></textarea>
			  	</div>
			</div>
		</div>
    </div>

    
    <div class="row abc">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 		<h4> <span>Documento de la Entrada</span> </h4>
			  		<input type="file" class="form-control" name="documento1" id="documento1" multiple>
					<span><?php echo $entrada->documento; ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 		<h4> <span>Video de la Entrada</span> </h4>
			  		<input type="text" class="form-control" name="video1" id="video1" value="<?php echo $entrada->video; ?>" >
			  	</div>
			</div>
		</div>
    </div>

    <div class="row abc">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 	<h4> <span>Referencia de la Entrada</span> </h4>
			  	<input type="text" class="form-control" name="referencia1" id="referencia1" value="<?php echo $entrada->referencia; ?>">
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 	<h4> <span>Estado</span> </h4>
			  	<select name="estado1" width="100%" class="form-control">
		        	<?php
		        		if($entrada->estado == 1){
		        			?>
		        			<option value="1">Activo</option>
			            	<option value="0">Inactivo</option>
		        			<?php
		        		}
		        		else{
		        			?>
		        			<option value="0">Inactivo</option>
		        			<option value="1">Activo</option>	            	
		        			<?php
		        		}
		        	?>
            	</select>
            	</div>
			</div>
		</div>
    </div>

    <div class="row abc">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 	
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
			 		<h4> <span>Imagen de la Entrada</span> </h4>
			  		<input type="file" class="form-control" name="fleImagen1" id="fleImagen1" multiple>
					<img src="../../../assets/images/avatars/<?php echo $entrada->imagen; ?>" id="preview1" width='100px'>
				</div>
			</div>
		</div>
    </div>



	<input type="hidden" name="IdNota" id="menuNota1" value="<?php echo $entrada->id_entrada; ?>">	
	<input type="hidden" name="nombreImagen1" id="nombreImagen1" value="">
    <input type="hidden" name="nombreDocumento1" id="nombreDocumento1" value="">
    <input type="hidden" name="usuario" id="usuario1" value="<?php echo $_SESSION['idUser'] ?>">


    <div class="row abc">
		<div class="col-md-6">
			
		</div>
		<div class="col-md-6">
			<div class="page-header">
			 	
			  	<a href="#" class="btn btn-success update" name="updateEntrada" id="updateEntrada">Guardar</a>
			</div>
		</div>
    </div>





</table>
<?php
}
?>


