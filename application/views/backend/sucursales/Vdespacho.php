<!DOCTYPE html> 
<html> 
<head> 
    <title><?php echo $datoSucursal[0]['nombre_sucursal'];  ?></title>
    <link rel="icon" href="../../../../../assets/images/despacho/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" media="screen" href="../../../../../assets/css/despacho/estilo.css" />

    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />
    <script src="../../../../../js/jquery.js"></script>
    <script src="../../../../../js/bootstrap.min.js"></script>



</head>
<script language="javascript">
$( document ).ready(function() 
{
	var idSucursal = <?php echo $idSucursal[0];  ?>
  //------------------Load de la data de masterChef----------------
  $("#pedidosLoad").load("../despacho_view_master/"+idSucursal);
  //---------------------Fin del codigo load
});      
</script>
 
<body style="font-family: serif !important;">
<div id="pedidosLoad"  style="height: 100%;"></div>
</body>
</html>