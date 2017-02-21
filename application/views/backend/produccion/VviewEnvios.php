<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<style>
  .table-dynamic{width: 100%;}
  .form-inline .form-control {
    width:85%;
    font-weight: 10px;
    padding: 4px;
  }

  .input__label-content{
    margin-top: -20px;
  }
  .line{
    
  }

.dl-horizontal dt 
{
    line-height: 40px !important;
    font-size: 18px !important
}

.dl-horizontal dd {
    margin-left: 180px;
    line-height: 40px;
}

</style>
<div class="addIngredientes">
 <?php
    foreach ($enviosData as $value) 
      {
  ?>

  <div class="bs-Ver Proveedor" data-example-id="horizontal-dl"> 
    <dl class="dl-horizontal" style=" font-size: 18px !important;margin-left: 10%;">
      
      <dt>ID Envio:</dt> 
          <dd><?php echo $value->id_envio_materiales;  ?></dd> 
       
       <dt>Nombre material:</dt> 
          <dd><?php echo $value->nombre_matarial;  ?></dd>  
       
       <dt>Codigo:</dt> 
          <dd><?php echo $value->codigo_material;  ?></dd>  
       
       <dt>Cantidad enviada:</dt> 
          <dd><?php echo $value->cantidad;  ?></dd> 
       
       <dt>Unidad medida:</dt> 
          <dd><?php echo $value->nombre_unidad_medida;  ?></dd> 
       
       <dt>Sucursal destino:</dt> 
          <dd><?php echo $value->nombre_sucursal;  ?></dd> 

        <dt>Estado:</dt> 
          <dd><?php echo $value->nombre_estatus;  ?></dd>    

       <dt>Fecha registgro:</dt> 
          <dd><?php echo $value->fecha_registro;  ?></dd>             

    </dl> 
  </div>

   <?php
      }          
    ?>               
  </div> 
</div>