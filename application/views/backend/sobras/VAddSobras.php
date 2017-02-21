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
  #anio{
    width: 100%;
  }
  .avatar{
    padding: 10px;
    display: inline-block;
  }
 
</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-list-alt'></i>Ver Registro sobras</a></li>
  <!--<li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-bar-chart'></i>Estadisticas de sobras</a></li>--> 
  
</ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
    <div id="actions-bar">
      <span  style="float:right;background-color: #c75757;" class="btn btn-success agregarProveedor">Nuevo Registro</span>
    </div>     
      
      <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Sucursal</th>
                        <th>Material</th>
                        <th>Cantidad</th>                        
                        <th>Unida Medida</th>
                        <th>Fecha</th>                                                
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($datosSobras)) 
                    {
                      foreach ($datosSobras as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->name_detalle;  ?></td>
                        <td><?php echo $value->descripcion;  ?></td>
                        <td><?php echo $value->cantidad;  ?></td>
                        <td><?php echo $value->unidad_medida_id;  ?></td>
                        <td><?php echo $value->unidad_medida_id;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary">
                            <input type="hidden" name="detalleID" class="detalleID" value="<?php echo $value->id_detalle_producto ?>">Ver
                          </button>
                          
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
         
      ?> 
                   
    </tbody>   
  </table>
    </div>






    <div class="tab-pane includ fade" id="tab1_2">
    <div class="row line col-md-12">
      echo tab 3
    </div>  
    </div>


</div>


<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ModaViewdata" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Informacion de proveedor
          </h4>
          <hr>
        <div class="modal-body modalViewCOntent">

            
          
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div>
         
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  



