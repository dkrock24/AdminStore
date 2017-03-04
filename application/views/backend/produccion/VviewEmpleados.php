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
    //var_dump($empleado);
    foreach ($empleado as $value) 
      {
  ?>

  <div class="bs-Ver Proveedor" data-example-id="horizontal-dl"> 
    <dl class="dl-horizontal" style=" font-size: 18px !important;margin-left: 10%;">
      
      <dt>ID Usuario:</dt> 
          <dd><?php echo $value->id_usuario;  ?></dd> 
       
       <dt>Nombres:</dt> 
          <dd><?php echo $value->nombres;  ?></dd>  
       
       <dt>Apellidos:</dt> 
          <dd><?php echo $value->apellidos;  ?></dd>  
       
       <dt>Telefono:</dt> 
          <dd><?php echo $value->telefono;  ?></dd> 
       
       <dt>Celular:</dt> 
          <dd><?php echo $value->celular;  ?></dd> 
       
       <dt>Direccion:</dt> 
          <dd><?php echo $value->direccion;  ?></dd> 

       <dt>DUI:</dt> 
          <dd><?php echo $value->dui;  ?></dd>  

      <dt>Usuario:</dt> 
          <dd><?php echo $value->usuario;  ?></dd>  

      <dt>Genero:</dt> 
          <dd><?php echo $value->genero;  ?></dd>                

    </dl> 
  </div>

   <?php
      }          
    ?>               
  </div> 
</div>