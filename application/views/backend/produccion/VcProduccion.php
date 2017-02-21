<?php
   session_start()
?>
 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
     <script src="../../../assets/plugins/translate/jqueryTranslator.min.js"></script> <!-- Translate Plugin with JSON data -->
    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="../../../assets/js/widgets/notes.js"></script> <!-- Notes Widget -->
    <script src="../../../assets/js/quickview.js"></script> <!-- Chat Script -->
    <script src="../../../assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="../../../assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="../../../assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
    <link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">

<script>    
  //-----------------Jquery load table empleados----------------
  $(".viewDataEmpleao").click(function()
  {
    $(".load-table").hide();
    $(".load-dataDinamic").show();
    $(".load-dataDinamic").load("../produccion/Cproduccion/listEmpleadosCP/");
  });
  //-------------------------Fin ----------------------------------- 

  //----------------Load second index with ID centroP ----
    $(".cont-sucursales").click(function()
    {
       var cpID = $(this).find('.cpID').val();
       //alert(cpID);
      $(".pages").load("../produccion/Cproduccion/indexDos/"+cpID); 
    });
    //-------------------------Fin ------------------ 
</script>



<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-university'></i>Centros de Produccion</a></li>   
</ul>

<div class="tab-content">

  <div class="tab-pane fade active in" id="tab1_1">
  
  <div class="row col-lg-12 conten-sucursales">
       <?php
        if (!empty($cproduccion)) 
        {
          foreach ($cproduccion as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="cont-sucursales">
                 <input type="hidden" name="cpID" class="cpID" value="<?php echo $value->id_sucursal ?>"></a>
                <i class='fa fa-university' style="font-size: 150px;color:#88b32f;"></i>
                <div class="name-sucursal"><?php echo $value->nombre_sucursal ?></div>
            </div>
          <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 

      </div>
      
         <div class="load-productoBySucursal" style="display:none;"></div>   
              
      </div>               
  </div>
  
</div>
