<link rel="stylesheet" href="../../../assets/plugins/bootstrap/css/bootstrap.min.css"/>
<script type="text/javascript">

      $("li.pag").click(function(){
        var id_paginacion = $(this).attr("id"); 
        //alert(id_paginacion) ;
        var id_sub_menu = $(".id_menu").attr("id");   
        
        $(".menu_edi").load("../../backend/menu/ChomePages/loadSubMenu/"+id_sub_menu+"/"+id_paginacion);             
        
      });

      $("a.editar_entrada").click(function(){
      	var id_entrada = $(this).attr("id");      	
      	$(".menu_edi").load("../../backend/menu/ChomePages/loadRecord/"+id_entrada);             
      });


      //Elimina las Entradas y Recarga la Tabla
      $("a.eliminar_entrada").click(function()
      {
      		var id_entrada1 = $(this).attr("id");
      		var id_sub_menu = $(".id_sub_menu").attr("id");
      		var id_entrada=0;
      		var data = {id_entrada:id_entrada1};
      		//load("../../backend/menu/ChomePages/deleteEntrada/"+id_entrada);       
      		$.ajax({
                url: "../../backend/menu/ChomePages/deleteEntrada",
				type:"post",
				data: data,               

				success: function(){   
					$(".menu_edi").load("../../backend/menu/ChomePages/loadSubMenu/"+id_sub_menu+"/"+0);             
				},
				error:function(){
				}
			});
      });

</script>
<style type="text/css">
	target-content{
		background-color: orange;
	}
	.tabla_encabezado{
		font-size: 10px;
		background: blue;

	}
	.tabla_body{
		font-size: 10px;

	}
	.btn-success{
		background-color: #9AC835;
	}
	.pag{
		cursor: pointer;
	}
	.editar_entrada{
		border:1px solid grey;
		color: black;
	}
	.eliminar_entrada{
		border:1px solid grey;
		color: black;
	}
</style>

<?php
if($paginacion==0){
	echo "Pagina > 1";
}
else{
	echo "Pagina >".$paginacion;
}

if($paginacion>=0){
	?>
	<script type="text/javascript">
	
      $(document).ready(function(){
      	//$("li.pag").attr("id")
      	$('a.de').click(function(){
      		//alert($(this).id);
      		var id = $(this).css("background", "red");
      		$('#'+id).css("background", "red");
      		//$("#'"+id+"'").text("yes");
      	});
      });
      </script>
	<?php
}

$limit = 5;
$total_records = $cont_entradas[0]->total;  
$total_pages = ceil($total_records / $limit);
?>
<span id="<?php if($entradas!=""){echo $entradas[0]->id_submenu;} ?>" class="id_menu"></span>
<!-- Tab panes -->
<input type="hidden" name="id_sub_menu" class="id_sub_menu" id="<?php if($entradas!=""){echo $entradas[0]->id_submenu; } ?>">
<table class="table table-bordered table-striped">  
	<thead class="tabla_encabezado">  
		<tr>  
			<th>N</th>
			<th>Titulo</th>  
			<th>Subtitulo</th>
			<th>Contenido</th>  
			<th>I</th>
			<th>D</th>
			<th>V</th>
			<th>R</th>
			<th>Creado</th>
			<th>Editar</th>  
			<th>Eliminar</th>
		</tr>  
	</thead>  
	<tbody id="target-content" class="tabla_body">
		<?php  

			if($entradas!="")
			{
				$contador=1;
				foreach ($entradas as $info)
				{
				?>  
		            <tr>  
		            <td width="2%"><?php echo $contador; ?></td>  
		            <td width="14%"><?php echo $info->titulo; ?></td>  
		            <td width="14%"><?php echo $info->subtitulo; ?></td>  
					<td width="50%"><?php echo $info->contenido; ?></td>  
					<td width="5%"><?php if($info->imagen!=""){ echo "<span class='fa fa-check-circle'></span>";} ?></td>  
					<td width="5%"><?php if($info->documento!=""){ echo "<span class='fa fa-check-circle'></span>";} ?></td>  
					<td width="5%"><?php if($info->video!=""){ echo "<span class='fa fa-check-circle'></span>";} ?></td>  
					<td width="5%"><?php if($info->referencia!=""){ echo "<span class='fa fa-check-circle'></span>";} ?></td>
					<td width="10%"><?php $date=date_create($info->creado); echo date_format($date,"Y/m/d"); ?></td>
					<td width="10%"><a href="#" id="<?php echo $info->id_entrada; ?>" class="btn btn-success editar_entrada">Editar</a></td>
					<td width="10%"><a href="#" id="<?php echo $info->id_entrada; ?>" class="btn btn-success eliminar_entrada">Eliminar</a></td>
		            </tr>  
				<?php  
				$contador++;
				}

			}
		?>
	</tbody> 

</table>

	<nav aria-label="Page navigation">
		<ul class="pagination">
			<li class="">
				<a href="#" aria-label="Previous">
        			<span aria-hidden="true">&laquo;</span>
      			</a>
      		</li>
			<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
	            if($i == 1):?>
		            <li class='pag'  id="<?php echo $i;?>"><a href="#" class="de" id="yes<?php echo $i;?>"><?php echo $i;?></a></li> 
	            <?php else:?>
	            	<li class="pag" id="<?php echo $i; ?>"><a href="#" class="de" id="yes<?php echo $i;?>"><?php echo $i;?></a></li>
	        <?php endif;?>          
		<?php endfor;endif;?>
		<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
		</ul>
	</nav>


<script src="dist/jquery.simplePagination.js"></script>

<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
		currentPage : 1,
		onPageClick : function(pageNumber) {
			jQuery("#target-content").html('loading...');
			jQuery("#target-content").load("pagination.php?page=" + pageNumber);
		}
    });
});
</script>