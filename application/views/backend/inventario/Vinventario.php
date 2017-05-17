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
  $(".viewDataM").click(function()
  {
     //alert("tesr");
     $(".ViewdataModal").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var inventarioID = $(this).find('.viewDataIDM').val();
    //alert(inventarioID);
    $(".ViewCOntent").load("../inventario/Cinventario/viewInventario/"+inventarioID);
  });


   //----------------add Material---------------
    $(".agregarMateria").click(function()
    {
      $(".pages").load("../inventario/Cinventario/addInventario"); 
    });
    //-------------------------Fin ------------------

    //----------------add categoria Material---------------
    $(".agregarCategoria").click(function()
    {
      $(".pages").load("../inventario/Cinventario/addCategoria"); 
    });
    //-------------------------Fin ------------------

    //----------------modificar material---------------
    //$(".editInventario").click(function()
    $(document).on('click','.editInventario',function()
    {
        var materialID = $(this).find('.editValID').val();
        $(".pages").load("../inventario/Cinventario/editMaterial/"+materialID); 
    });
    //-------------------------Fin ------------------


  //----------------- Open modal delete-------------------
  $(".deleteBTN").click(function()
  {
     $(".modalEliminar").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var inventarioID = $(this).find('.deleteValID').val();
    $("#deleteYesVal").val(inventarioID);
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
          url: "../inventario/Cinventario/delete_material",
          type:"post",
          data: {proveedorID:proveedorID},
          success: function(message)
          {
            //alert(message);
            $(".pages").load("../inventario/Cinventario/index");
          },
          error:function()
          {
            alert("Este material está siendo utilizado");
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
      $(".load-inventario").show();
      $(".load-inventario").load("../inventario/Cinventario/inventarioBySucursal/"+sucursalID);

  });
  //-------------------------Fin -----------------------------------

   //-------- mostrar los productos po asignados a sucursal
  $(".vieMaterialesTerminar").click(function()
  {
    alert("ready");
      /*var sucursalID = $(this).find(".idSucursal").val();
     // alert(sucursalID);
      $(".conten-sucursales").hide();
      $(".load-inventario").show();
      $(".load-inventario").load("../inventario/Cinventario/listMaterialesTerminar/"+sucursalID);
     */
  });
  //-------------------------Fin -----------------------------------

  
  //-------- mostrar los productos po asignados a sucursal
  $(".ActiveInactive").click(function()
  {
      var categoID = $(this).find(".viewDataIDCat").val();
      if ($(this).find(".vieText").val() == "Inactivar") 
      {
         $.ajax
          ({
              url: "../inventario/Cinventario/inactivarCategoria",
              type:"post",
              data: {categoID:categoID},
              success: function(message)
              {
                //alert(message);
                if (message == "0") 
                {
                  alert("No se puede desactivar esta siendo utilizada!!!");
                  
                }
                else
                {
                  $(".pages").load("../inventario/Cinventario/index");  
                }
                
              },
              error:function()
              {
                alert("failure");
              }
          });

      }
      else
      {
        $.ajax
          ({
              url: "../inventario/Cinventario/activarCategoria",
              type:"post",
              data: {categoID:categoID},
              success: function(message)
              {
                //alert(message);
                $(".pages").load("../inventario/Cinventario/index");
              },
              error:function()
              {
                alert("failure");
              }
          });

      }

  });
  //-------------------------Fin -----------------------------------

 //----------------- Open modal delete Categorias-------------------
  $(".deleteBTNCat").click(function()
  {
     $(".modalEliminarCat").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var categoID = $(this).find('.deleteValIDCat').val();
    $("#deleteYesValCat").val(categoID);
  });

  //-------------------------Fin -----------------------------------
  
  //------------------------Delete cancel---------------------------
  $(".deleteNotCat").click(function()
  {

     $('.modalEliminarCat').modal('toggle'); 

  });
  //-------------------------Fin -----------------------------------

 //----------------Delete YES ------------------------------------
  $(".deleteYesCat").click(function()
  {
      var categoID = $(this).find('#deleteYesValCat').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../inventario/Cinventario/delete_categoria_material",
          type:"post",
          data: {categoID:categoID},
          success: function(message)
          {
            alert("Se eliminó correctamente!!!");
            $(".pages").load("../inventario/Cinventario/index");
          },
          error:function()
          {
            alert("Esta categoría está siendo utilizada");
          }
      });

  });
  //-------------------------Fin -----------------------------------


  //----------------modificar material---------------
    $(".editInventarioCat").click(function() 
    {
        var materialCatID = $(this).find('.editValIDCat').val();
        $(".pages").load("../inventario/Cinventario/editMaterialCat/"+materialCatID); 
    });
    //-------------------------Fin ------------------

</script>
<style type="text/css">
  
.cont-sucursales
{
  width: 250px;
  border: 1px solid #445a18;
  text-align: center;
  float: left;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  margin: 15px;
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
.btn.btn-sm {
    font-size: 9px !important;
    padding: 5px 12px !important;
}

</style>
<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab">
  <i class='fa fa-indent'></i>Ver inventario</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab">
  <i class='fa fa-list-alt'></i>Inventario por sucursal</a></li> 
  <!--<li id="menu_li" class="C "><a href="#tab1_3" data-toggle="tab">
  <i class='fa fa-info'></i>Materiales por terminar</a></li> --> 
  <li id="menu_li" class="D "><a href="#tab1_4" data-toggle="tab">
  <i class='fa fa-filter'></i>Categoria materiales</a></li>  

</ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
     <div id="actions-bar">
 <span type="button" style="float:right;background-color: #c75757;" class="btn btn-success agregarMateria">Agregar material</span>
    </div> 
         <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th >Nombre</th>
                        <th >Categoria</th>                    
                        <th >U medida</th>  
                        <th >Estatus</th>                           
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                <?php
                    if (!empty($inventario)) 
                    {
                      //var_dump($inventario);
                      foreach ($inventario as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_matarial;  ?></td>
                        <td><?php echo $value->nombre_categoria_materia;  ?></td>
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>   
                        <td><?php echo $value->nombre_estatus;  ?></td>                          
                        <td>
                          <button type="button" class="btn btn-primary  btn-sm editInventario">
                            <input type="hidden" name="editValID" class="editValID" value="<?php echo $value->id_inventario ?>">Modificar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm deleteBTN">
                            <input type="hidden" name="deleteValID" class="deleteValID" value="<?php echo $value->id_inventario ?>">Eliminar
                            </button>
                            <!--<button type="button" class="btn btn-primary  btn-sm viewDataM">
                            <input type="hidden" name="viewDataIDM" class="viewDataIDM" value="<?php echo $value->id_inventario ?>">Ver
                           <!-- </button> -->

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
                <div class="name-sucursal"><?php echo $value->name ?></div>
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
      
      <div class="load-inventario" style="display:none;"></div>    

      </div>   
    </div>







  <div class="tab-pane includ fade" id="tab1_3">
     <div class="row line col-md-12">
          
          <div class="row col-lg-12 conten-sucursales">
    <?php
        if (!empty($sucursales)) 
        {
          foreach ($sucursales as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="cont-sucursales vieMaterialesTerminar">
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
      
      <div class="load-inventario" style="display:none;"></div>    

      </div>   
  </div>




   <div class="tab-pane includ fade" id="tab1_4">
   <div id="actions-bar">
 <span type="button" style="float:right;background-color: #c75757;" class="btn btn-success agregarCategoria">Agregar categoria</span>
    </div>
    <div class="row line col-md-12">
      <table class="table table-hover table-dynamic">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th> 
                        <th>Estatus</th>                        
                                
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                <?php
                    if (!empty($categoriaMateriales)) 
                    {
                      //var_dump($categoriaMateriales);
                      foreach ($categoriaMateriales as $value) 
                      {
                        $statusD = ($value->cateStatus=="Activo") ? "Inactivar" : "Activar";
                      ?>
                    <tr>
                        <td><?php echo $value->nombre_categoria_materia;  ?></td>
                        <td><?php echo $value->descripcion_categoria_materia;  ?></td>
                         <td><?php echo $value->cateStatus;  ?></td>
                                                 
                        <td>
                          <button type="button" class="btn btn-primary  btn-sm editInventarioCat">
                            <input type="hidden" name="editValID" class="editValIDCat" value="<?php echo $value->id_categoria_materia ?>">Modificar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm deleteBTNCat">
                            <input type="hidden" name="deleteValID" class="deleteValIDCat" value="<?php echo $value->id_categoria_materia ?>">Eliminar
                            </button>
                          
                            <span class="btn btn-primary  btn-sm ActiveInactive">
                            <?php echo $statusD;?>
                            <input type="hidden" name="vieText" class="vieText" value="<?php echo $statusD; ?>">
                            <input type="hidden" name="viewDataIDCat" class="viewDataIDCat" value="<?php echo $value->id_categoria_materia ?>">
                            </span>
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
  </div>



</div>








<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ModaViewdata" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
            Agregar nuevo estatus
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
<div class="modal fade ViewdataModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
            Ver material
          </h4>
          <hr>
        <div class="modal-body ViewCOntent">

            
          
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
             Seguro que desea eliminar el material seleccionado
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

<!-- Codigo de funcionalidad de Modals eliminar dproductos-->
<div class="modal fade modalEliminarCat" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content deleModal">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Eliminar Categoria
          </h4>
          <hr>
        <div class="modal-body">
           <div class="cont-message"  style="font-size: 30px;padding: 12px;margin: 6px;">
           <span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size: 60px;color: #bb1212;"></span>
             Seguro que desea eliminar la categoria seleccionado
           </div>
           <hr>
           <div class="bar--action" style="float: right;">
             <span class="btn btn-primary deleteNotCat">Cancelar</span>
             <span class="btn btn-primary deleteYesCat">
              <input type="hidden" name="deleteYesValCat" id="deleteYesValCat" val="">
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