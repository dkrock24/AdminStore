<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //-----------------Change Status to approved-------------------
    $(".changeStatusAprobar").click(function()
    {
       
      var sobrasID = $(this).find(".sobrasID").val();
      var status = "1";
      $.ajax
           ({
            url: "../sobras/Csobras/approved_sobras",
            type:"post",  
            data: {sobrasID:sobrasID,status:status},
            success: function()
            {
    
              $(".pages").load("../sobras/Csobras/index"); 
            }
          });
    });


    //-----------------Change Status to disapproved-------------------
    $(".changeStatusDesaprobar").click(function()
    {
      
      var sobrasID = $(this).find(".sobrasID").val();
      var status = "0";

      $.ajax
           ({
            url: "../sobras/Csobras/disapproved_sobras",
            type:"post",
            data: {sobrasID:sobrasID,status:status},
            success: function()
            {
    
              $(".pages").load("../sobras/Csobras/index"); 
            }
  
          });
    });
  
</script>

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
    //var_dump($datosSobras);
    foreach ($datosSobras as $value) 
      {
  ?>

  <div class="bs-Ver Proveedor" data-example-id="horizontal-dl"> 
    <dl class="dl-horizontal" style=" font-size: 18px !important;margin-left: 10%;">
      
      <dt>Sucursal:</dt> 
          <dd><?php echo $value->nombre_sucursal;  ?></dd> 
       
       <dt>Producto:</dt> 
          <dd><?php echo $value->nombre_producto;  ?></dd> 


       <dt>Material:</dt> 
          <dd><?php echo $value->materiales;  ?></dd>  
       
       <dt>Cantidad:</dt> 
          <dd><?php echo $value->cantidad;  ?></dd>  
       
        <dt>comentario:</dt> 
          <dd><?php echo $value->comentario;  ?></dd>    

       <dt>Fecha de creacion</dt> 
          <dd><?php echo $value->fecha_registro;  ?></dd>

      <?php
      if ($value->imagen !="") 
      {
      ?>  
          <div class="thumbnail">
            <img src="../../../assets/images/desperdicios/<?php echo $value->imagen ?>" style="height: auto;width: 200px;>   
         </div>
      <?php
      }
      ?>        
        <?php
        if ($value->estatus_registro == '0') 
        {
        ?>  
         <button type='button' style="margin-top: 20px;margin-left: 23px;"  class='btn btn-primary changeStatusAprobar'>
         <input type="hidden" name="sobrasID" class="sobrasID" id="sobrasID" value="<?php echo $value->id_sobra_producto; ?>">
         Aprobar
         </button>
        <?php
        }
        else{?>

        <button type='button' style="margin-top: 20px;margin-left: 23px;background-color: #c75757;" class='btn btn-primary changeStatusDesaprobar'>
        <input type="hidden" name="sobrasID" class="sobrasID" id="sobrasID" value="<?php echo $value->id_sobra_producto; ?>">
        Desaprobar
        </button>
          
        <?php
        }
        ?>      
          

    </dl> 
  </div>

   <?php
      }          
    ?>               
  </div> 
</div>