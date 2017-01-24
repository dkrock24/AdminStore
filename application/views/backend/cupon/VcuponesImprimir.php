<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lista de Cupones</title>
</head>
<link rel="stylesheet" type="text/css" href="../../../../../assets/images/print.css" media="print">

<style type="text/css" media="print">
@media print {
 	body {-webkit-print-color-adjust: exact; }
  	.bloc{
  		background:url(../../../../../assets/images/imagen_cupon.jpg) no-repeat ;
  		background-size: 340.15px 188.9px;
  	}
  	.titulo{
		float: left;
		position: relative;
		margin-top: 80px;
	  	font-size: 135px;
	}
	.codigo{
	display: inline-block;
	position: absolute;
	float: right;
	margin-left: 25%; 
	margin-top: 11%;
	transform: rotate(-20deg);
	font-size: 11px;
	}

}
@page {
    margin: 0;
    -webkit-print-color-adjust: exact;    
    background:url(../../../../../assets/images/imagen_cupon.jpg) no-repeat ;
    background-size: 340.15px 188.9px;

}


</style>

<style type="text/css">
	
.table{
  padding: 10px;

}
.bloc{
  width:340.15px;
  height: 188.9px;
  border:dashed;
  display: inline-block;  
  background: url("../../../../../assets/images/imagen_cupon.JPG") no-repeat; 
  background-size: 340.15px 188.9px;
}
.banda{
  width: 290px;
  height: 100%;
  background: grey;
  display: inline-block;
  padding: 5px;
  margin: 10px;
  margin-top:0px;
  margin: 0 auto;
}
.content{
  width: 290px;
  display: inline-block;
  padding: 5px;
  background: none;
}
.titulo{
	float: left;
	display: inline-block;
	position: absolute;
	margin-top: 90px;
  	font-size: 35px;
}
.codigo{
	display: inline-block;
	position: absolute;
	float: right;
	margin-left: 202px; 
	margin-top: 90px;
	transform: rotate(-15deg);
	font-size: 7px;
}
</style>



<body>
<div class="table">

	<?php
		$conta=1;
		foreach ($cupon as $cupones) 
		{
			if($conta==5){
				$conta=1;
				echo "<br>";
			}
			if($conta <=4 ){
				//echo $conta;
				?>
				<div class="bloc">

					<div class="content">
						<span class="titulo"> 
							<?php 
								$valor = substr($cupones->valor_categoria,0,1); 
								if($valor==0){
									echo substr($cupones->valor_categoria,-2)."% <br>";
								}else{
									echo "$". $cupones->valor_categoria."<br>";
								}								
							?>								
						</span>
						<span class="codigo"><?php echo strtoupper($cupones->codigo_cupon)."<br>"; ?></span>
					</div>
				</div>			
				<?php
				$conta+=1;
			}

			
			
		}
	?>

</div>
</body>
</html>

