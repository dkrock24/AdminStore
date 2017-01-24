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
    foreach ($proveedor as $value) 
      {
  ?>

  <div class="bs-Ver Proveedor" data-example-id="horizontal-dl"> 
    <dl class="dl-horizontal" style=" font-size: 18px !important;margin-left: 10%;">
      
      <dt>Empresa:</dt> 
          <dd><?php echo $value->nombre_proveedor;  ?></dd> 
       
       <dt>Descripcion:</dt> 
          <dd><?php echo $value->descripcion_proveedor;  ?></dd>  
       
       <dt>Correo:</dt> 
          <dd><?php echo $value->correo_proveedor;  ?></dd>  
       
       <dt>Direccion:</dt> 
          <dd><?php echo $value->direccion_proveedor;  ?></dd> 
       
       <dt>Telefono:</dt> 
          <dd><?php echo $value->telefono_proveedor;  ?></dd> 
       
       <dt>Contacto:</dt> 
          <dd><?php echo $value->contacto_referencia_proveedor;  ?></dd> 

       <dt>Sucursales:</dt> 
          <dd><?php echo $value->asociadas;  ?></dd>        

    </dl> 
  </div>

   <?php
      }          
    ?>               
  </div> 
</div>