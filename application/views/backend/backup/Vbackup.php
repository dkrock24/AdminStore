

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

<!--    <script src="assets/js/pages/form_icheck.js"></script> -->
    <!-- END PAGE STYLE -->

<script>
$(document).ready(function(){

   $("#bk").click(function(){        
        $(".includ").load("../../../pages/respaldo/dump_db.php");
    })
});


</script>

<?php
//include_once("class_db/class_bk_list.php");
//$data = lista_bk(); 
//echo $date = date("Y-M-d-h-i-s");
//echo time();
?>

<ul class="nav nav-tabs">
  <li id="menu_li" class="active"><a href="#tab1_1" data-toggle="tab">Inicio</a></li>
  <li id="menu_li" class=""><a href="#tab1_2" data-toggle="tab">Generar Backup</a></li>
  
</ul>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div class="tab-content">
	<div class="tab-pane fade active in" id="tab1_1">
	    <div class="row">
	      	<table class="table table-hover table-dynamic filter-head">
                    <thead>
                      <tr>
                        <th>Nombres Bk</th>
                        <th>Fecha</th>
                        <th>Link</th>                       
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ($backup!="") {
                    foreach ($backup as $backups) {
                    ?>
                             <tr>
                                <td><?php echo $backups->nombre_bk;  ?></td>
                                <td><?php echo $backups->fecha_bk;  ?></td>
                                <td>
                                <a href="http://localhost/control/pages/respaldo/<?php echo $backups->link_bk;  ?>" class="btn btn-default">Download</a>
                                </td>                                
                             </tr>                            
                            <?php
                        }
                      }
                    ?>  
                                    
                    </tbody>
    </table>	      	     

	    </div>
	</div>
    <div class="tab-pane fade in" id="tab1_2">
     	<div class="row">
     		<a href="#" id="bk" class='btn btn-default'>Generar Backup</a>
     		<div class='includ'>
     			
     		</div>
     	</div>
    </div>
</div>

