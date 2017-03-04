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

<style type="text/css">
   #div_content-bra
  {
    width: 30%;
    float: left;
    margin: 10px;
    border: 1px solid #8B002B;
    background-color: #FFF;
    text-align: center;
    cursor: pointer;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
  }

  #div_content-bra:hover
  {
    opacity: 0.8;
  }
  
  .ico_branch
  {
    font-size: 114px;
    color: #3E9B48;
  }
  .activePS
  {
    font-size: 20px;
  }
  
.modal-dialog {
    margin-top: 5%;

}

.cont-sucursales
{
  width: 200px;
  border: 1px solid #445a18;
  text-align: center;
  float: left;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 7px;
}

.cont-sucursales:hover
{
  opacity: 0.8;
  cursor: pointer;
}

.name-sucursal
{
    background-color: #2b2e33;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    padding: 4px;
    color: #FFF;
}
.modal-open 
{
  overflow: auto;
}
#actions-bar
{
  width: 100%;
  height: 60px;
  
}
.btn.btn-sm 
{
    margin-left: 1px  !important;
}
</style>


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
