<?php
   session_start();
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

  //----------------- Open modal view data-------------------
  $(".viewData").click(function()
  {
     $(".ModaViewdata").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var proveedorID = $(this).find('.viewDataID').val();
    $(".modalViewCOntent").load("../proveedor/Cproveedor/viewProveedor/"+proveedorID);
  });


   //----------------add proveedor---------------
    $(".agregarProveedor").click(function()
    {
      $(".pages").load("../proveedor/Cproveedor/addProveedor"); 
    });
    //-------------------------Fin ------------------

    //----------------modificar proveedor---------------
    $(".editProveedor").click(function() 
    {
        var proveedorID = $(this).find('.editValID').val();
        $(".pages").load("../proveedor/Cproveedor/editProveedor/"+proveedorID); 
    });
    //-------------------------Fin ------------------


  //----------------- Open modal delete-------------------
  $(".deleteBTN").click(function()
  {
     $(".modalEliminar").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var proveedorID = $(this).find('.deleteValID').val();
    $("#deleteYesVal").val(proveedorID);
  });


  $(".deleteNot").click(function()
  {

     $('.modalEliminar').modal('toggle'); 

  });
  //-------------------------Fin -----------------------------------

 
  $(".deleteYes").click(function()
  {
      var proveedorID = $(this).find('#deleteYesVal').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../proveedor/Cproveedor/delete_proveedor",
          type:"post",
          data: {proveedorID:proveedorID},
          success: function(message)
          {
            //alert(message);
            $(".pages").load("../proveedor/Cproveedor/index");
          },
          error:function()
          {
            alert("failure");
          }
      });

  });
  //-------------------------Fin -----------------------------------

   //-------- mostrar los productos po asignados a sucursal
  $(".cont-sucursales").click(function()
  {
      var sucursalID = $(this).find(".idSucursal").val();
     // alert(sucursalID);
      $(".conten-sucursales").hide();
      $(".load-productoBySucursal").show();
      $(".load-productoBySucursal").load("../proveedor/Cproveedor/proveedorBySucursal/"+sucursalID);

  });
  //-------------------------Fin -----------------------------------


      //----------------add proveedor---------------
    $(".associateBranch").click(function()
    {
       var proveedorID = $(this).find('.proveedorID').val();
       //alert(proveedorID);
      $(".pages").load("../proveedor/Cproveedor/loadSucursales/"+proveedorID); 
    });
    //-------------------------Fin ------------------
      //-------------------------Fin -----------------------------------



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

</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-users'></i>Ver Proveedores</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-users'></i>Proveedores por sucursal</a></li> 
  <li id="menu_li" class="C "><a href="#tab1_3" data-toggle="tab"><i class='fa fa-pencil-square-o'></i>Pedidos a proveedores</a></li>  
</ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
    <div id="actions-bar">
      <span  style="float:right;background-color: #c75757;" class="btn btn-success agregarProveedor">Agregar Proveedor</span>
    </div>     
         <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th width="20%">Empresa</th>
                        <th width="20%">Telefono</th>                        
                        <th width="20%">Contacto</th>                                                
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (!empty($proveedor)) 
                    {
                      foreach ($proveedor as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_proveedor;  ?></td>
                        <td><?php echo $value->telefono_proveedor;  ?></td>
                        <td><?php echo $value->contacto_referencia_proveedor;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary  btn-sm editProveedor">
                            <input type="hidden" name="editValID" class="editValID" value="<?php echo $value->id_proveedor ?>">Modificar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm deleteBTN">
                            <input type="hidden" name="deleteValID" class="deleteValID" value="<?php echo $value->id_proveedor ?>">Eliminar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm viewData">
                            <input type="hidden" name="viewDataID" class="viewDataID" value="<?php echo $value->id_proveedor ?>">Ver
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm associateBranch">
                            <input type="hidden" name="proveedorID" class="proveedorID" value="<?php echo $value->id_proveedor ?>">Asociar
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
         <div class="row col-lg-12 conten-sucursales">
       <?php
        if (!empty($sucursales)) 
        {
          foreach ($sucursales as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="cont-sucursales">
                 <input type="hidden" name="idSucursal" class="idSucursal" value="<?php echo $value->id_sucursal ?>"></a>
                <i class='fa fa-home' style="font-size: 150px;color:#88b32f;"></i>
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







  <div class="tab-pane includ fade" id="tab1_3">
    <div class="row line col-md-12">
    <div class="alert alert-info" role="alert">Es necesario obtener la lista de los materiales por terminar para poder hacer el pedido!!!</div>
      
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
