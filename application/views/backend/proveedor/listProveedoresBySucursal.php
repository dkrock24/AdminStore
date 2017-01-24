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

 //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../proveedor/Cproveedor/index"); 
    });
    //-------------------------Fin ------------------


     //-------- Quitar Material de la lista de la sucursal -------------------

  $(".quitarMaterial").click(function()
  {
    
    var sucurProveedorID = $('.deleteSucursalProveedor').val();
    var sucursalID = $('.sucursalID').val();
 
     $.ajax
      ({
          url: "../proveedor/Cproveedor/quitar_proveedor_sucursal",
          type: "post",
          data: {sucurProveedorID:sucurProveedorID},                           
        
          success: function(data)
          {                                                  
           
              $(".load-productoBySucursal").load("../proveedor/Cproveedor/proveedorBySucursal/"+sucursalID);
          },
          error:function()
          {
            alert("Ocurrio un problema :(");
          }
      });
  });
   //-------- ENND Quitar Material de la lista de la sucursal------------------
  
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
<div id="actions-bar">
 <button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedor">Regresar</button>
</div> 
    <div>
         <table class="table table-hover">
                <thead class='titulos'>
                    <tr>
                        <th width="20%">Sucursal</th>
                         <th width="20%">Empresa</th>
                        <th width="20%">Correo</th>
                        <th width="10%">Telefono</th>                        
                        <th width="20%">Contacto</th>                                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($proveedorBySucursal)) 
                    {
                      foreach ($proveedorBySucursal as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_sucursal;  ?></td>
                         <td><?php echo $value->nombre_proveedor;  ?></td>
                        <td><?php echo $value->correo_proveedor;  ?></td>
                        <td><?php echo $value->telefono_proveedor;  ?></td>
                        <td><?php echo $value->contacto_referencia_proveedor;  ?></td>                         
                        <td>
                            <button type="button" class="btn btn-primary  btn-sm quitarMaterial">
                            <input type="hidden" name="deleteSucursalProveedor" class="deleteSucursalProveedor" value="<?php echo $value->id_proveedor_sucursal ?>">
                            <input type="hidden" name="sucursalID" class="sucursalID" value="<?php echo $value->id_sucursal ?>">Quitar
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

<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ModaViewdata" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Agregar Proveedor
          </h4>
          <hr>
        <div class="modal-body ModalAddProveedor">

            
          
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



<!-- Codigo de funcionalidad de Modals eliminar dproductos-->
<div class="modal fade modalEliminar" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content deleModal">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Eliminar Productos
          </h4>
          <hr>
        <div class="modal-body">
           <div class="cont-message"  style="font-size: 30px;padding: 12px;margin: 6px;">
           <span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size: 60px;color: #bb1212;"></span>
             Seguro que desea eliminar el proveedor seleccionado
           </div>
           <hr>
           <div class="bar--action" style="float: right;">
             <span class="btn btn-primary deleteNot">Cancelar</span>
             <span class="btn btn-primary deleteYes">
              <input type="hidden" name="deleteYesVal" id="deleteYesVal" val="">
             Eliminar</span>
           </div>
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  
