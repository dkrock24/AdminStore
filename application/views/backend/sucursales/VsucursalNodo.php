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
<style type="text/css">
	.go-sucursal{
		cursor: pointer;
	}
</style>

<div class="tab-content">  
    	<h3 id="../sucursales/Cindex/cargar_sucursal/" class="go-sucursal">
    		<i class="fa fa-arrow-left"></i>REGRESAR
    	</h3>
    	<input type="hidden" value="<?php echo $id_sucursal[0]; ?>" name="id_sucursal" id="id_sucursal">
    	<div class="list-group">
			<a href="#" class="list-group-item active">
					<i class='fa fa-home'></i>Nodos <?php if($sucursales!="")
			{ echo $sucursales[0]->nombre_sucursal;} ?>
			</a>
			<?php
			if($sucursales!="")
			{
				foreach($sucursales as $sucursal) 
				{
				?>
				  	<a  href="http://45.33.3.227/lapizzeria/index.php/backend/sucursales/Cindex/nodo/<?php echo $sucursal->id_nodo.'/'.$sucursales[0]->id_sucursal; ?>" target="_blank" name="" class="list-group-item nodo" id="">
				  		<td><i class='fa fa-arrow-right'></i> :</td>
				  		<td><?php echo $sucursal->nombre_nodo; ?></td>
				  	</a>
				<?php
				}
			}
			?>
			
		</div>
  </div>