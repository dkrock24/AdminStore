 <!-- END PRELOADER -->
    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>     
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="../../../assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="../../../assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
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


  .avatar{
    padding: 10px;
    display: inline-block;
  }

  .titulos{
    font-size: 12px;
  }
  .save{
  text-align: center;
}



</style>

<form action="../usuarios/Cusuarios/guardar_usuario" id="usuario" method="POST">
  <div class="tab-content">
  
    <div class="tab-pane fade active in" id="tab1_1">
      <table class="table table-hover table-dynamic filter-head">
                    <thead class='titulos'>
                      <tr>                                        
                        <th>Scursal</th>  
                        <th>Proceso</th>
                        <th>Usuario</th>       
                        <th>Fecha</th>                    
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if($login_log !=""){
                    foreach ($login_log as $logs) {
                            ?>
                             <tr>
                                <td><?php echo $logs->nombre_sucursal;  ?></td>
                                <td><?php echo $logs->nombre_proceso;  ?></td>
                                <td><?php echo $logs->nickname;  ?></td>                                
                                <td><?php echo $logs->fecha_log;  ?></td>                            
                             </tr>                            
                            <?php
                          }
                        }
                    ?>
                    </tbody>
    </table>
    </div>
  </div>
</form>


