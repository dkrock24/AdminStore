<script>
  	$(document).ready(function(){
  		//Cargar Sucursal
  		$(".go-sucursal").click(function(){
  			$(".sk-three-bounce").show();
    		var id_sucursal = $(this).attr("id");
	        $.ajax({
	            //url: "../sucursales/Cindex/cargar_sucursal/"+id_sucursal,
	            type:"post",
	            success: function(){    
	              $(".pages").load("../sucursales/Cindex/cargar_sucursal/"+id_sucursal);    
	              setTimeout(function() {
			     	$(".sk-three-bounce").css('display','none');
			    }, 1000);  
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
a.sucursal:hover{
	background: #88B32F;
	color: white;
	cursor: pointer;
}
</style>
<div class="tab-content">
	<div class="row">       
        <div class="col-md-4">
			<div class="list-group">
				<a href="#" class="list-group-item active">
					<i class='fa fa-home'></i>Sucursal
				</a>
				<?php
				if($sucursales!="")
				{
					foreach($sucursales as $sucursal) 
					{
					?>
					  	<a  class="list-group-item go-sucursal sucursal" id="<?php echo $sucursal->id_sucursal; ?>">
					  		<td><i class='fa fa-user-plus'></i> :</td>
					  		<td><?php echo $sucursal->nombre_sucursal; ?></td>
					  	</a>
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>