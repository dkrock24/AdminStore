<script>
  	$(document).ready(function(){
  		//Cargar Sucursal
  		$(".go-sucursal").click(function(){
    		var id_sucursal = $("#id_sucursal").val();
    		var url1 = $(this).attr("id");
	        $.ajax({
	            url: url1+id_sucursal,
	            type:"post",
	            success: function(){     
	              $(".pages").load(url1+id_sucursal);      
	            },
	            error:function(){
	                //alert("Error.. No se subio la imagen");
	            }
	        });  
   		});
   		//End
	});
</script>
<style>
.center{
	text-align: center;
}
.header{
	background: #88B32F;
}
.izquierda{
	text-align: right;
}
.go-sucursal{
	cursor: pointer;
}
</style>
<div class="tab-content">
	<div class="row"> 
		<div class="col-md-2">
			<h3 id="../sucursales/Cindex/index/" class="go-sucursal"><i class="fa fa-arrow-left"></i>REGRESAR</h3>
		</div>
		<div class="col-md-10 izquierda">
			<h3>SUCURSAL : <?php echo $sucursales[0]->nombre_sucursal; ?>
			</h3>
		</div>
	</div>
	<div class="row"> 
		<input type="hidden" value="<?php echo $sucursales[0]->id_sucursal; ?>" name="id_sucursal" id="id_sucursal">
        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-sitemap'></i>Nodos
				</a>
				<a  class="list-group-item go-sucursal" id="../sucursales/Cindex/cargar_nodos/">
					<p class="center"><img src="../../../asset_/img/domain-transfer.png"></p>
				</a>
			</div>
        </div>

        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-money'></i>Despachos
				</a>
					<a href="../sucursales/Cindex/despacho_view/<?php echo $sucursales[0]->id_sucursal; ?>" target="_black" class="list-group-item go-sucursal" id="">					
						<p class="center"><img src="../../../asset_/img/domain-transfer.png"></p>
					</a>
			</div>
        </div>

        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-file-text'></i>Ordenes
				</a>
				<a href="../sucursales/Cindex/login/<?php echo $sucursales[0]->id_sucursal; ?>" target="_black" class="list-group-item go-sucursal" id="">										  	
				  	<p class="center"><img src="../../../asset_/img/ordenes.png"></p>
				</a>
			</div>
        </div>
        
        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-file-text'></i>Productos
				</a>
					<a  class="list-group-item go-sucursal" id="">										  	
					  	<p class="center"><img src="../../../asset_/img/catalogo.png"></p>
					</a>
			</div>
        </div>

    </div>

    <div class="row">       
        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-check'></i>Pedidos
				</a>
					<a  class="list-group-item go-sucursal" id="">										  	
					  	<p class="center"><img src="../../../asset_/img/pedidos.png"></p>
					</a>
			</div>
        </div>
        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-file-text'></i>Cortes
				</a>
				<a href="#" class="list-group-item go-sucursal" id="../sucursales/Ccortes/index/">										  	
				  	<p class="center"><img src="../../../asset_/img/cortes.png"></p>
				</a>
			</div>
        </div>
        <div class="col-md-4">
        	<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-bell'></i>Notificacion 

				</a>
					<a  class="list-group-item go-sucursal" id="">										  	
					  	<p class="center"><img src="../../../asset_/img/notificacion.png"></p>
					</a>
			</div>
        </div>
    </div>
</div>



