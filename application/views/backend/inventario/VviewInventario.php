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
    
    foreach ($material as $value) 
      {
  ?>

  <div class="bs-Ver Proveedor" data-example-id="horizontal-dl"> 
    <dl class="dl-horizontal" style=" font-size: 18px !important;margin-left: 10%;">
      
      <dt>Nombre Material:</dt> 
          <dd><?php echo $value->nombre_matarial;  ?></dd> 
       
       <dt>Descripcion:</dt> 
          <dd><?php echo $value->descripcion_meterial;  ?></dd>  
       
       <dt>Codigo:</dt> 
          <dd><?php echo $value->codigo_material;  ?></dd>  
       
       <dt>Categoria:</dt> 
          <dd><?php echo $value->nombre_categoria_materia;  ?></dd> 
       
       <dt>Unidad de medida</dt> 
          <dd><?php echo $value->nombre_unidad_medida;  ?></dd> 

       <dt>estatus</dt> 
          <dd><?php echo $value->nombre_estatus;  ?></dd> 

       <dt>Fecha de creacion</dt> 
          <dd><?php echo $value->fecha_creacion;  ?></dd>      
          

    </dl> 
  </div>

   <?php
      }          
    ?>               
  </div> 
</div>