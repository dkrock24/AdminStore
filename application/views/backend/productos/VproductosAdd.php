 <!-- END PRELOADER -->

    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
 <link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
    <!-- BEGIN PAGE SCRIPT -->
   <script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>    
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>    
    <script src="../../../assets/js/sidebar_hover.js"></script> <!-- Sidebar on Hover -->
    <script src="../../../assets/js/plugins.js"></script> <!-- Main Plugin Initialization Script -->
    <script src="../../../assets/js/pages/search.js"></script> <!-- Search Script -->
    <!-- BEGIN PAGE SCRIPT -->
    <script src="../../../assets/plugins/datatables/jquery.dataTables.min.js"></script> <!-- Tables Filtering, Sorting & Editing -->
    <script src="../../../assets/js/pages/table_dynamic.js"></script>
    <!-- BEGIN PAGE SCRIPT -->
<script>
  function archivo(evt) 
  {
    $("#list").show();
    var files = evt.target.files; // FileList object
             
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) 
    {
    //Solo admitimos imágenes.
      if (!f.type.match('image.*')) 
      {
        continue;
      }
      var reader = new FileReader();
      reader.onload = (function(theFile) {
      return function(e) 
      {
       // Insertamos la imagen
      document.getElementById("list").innerHTML = ['<img style="width:60%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
      };
      })(f);
      reader.readAsDataURL(f);
    }
  }
    document.getElementById('files').addEventListener('change', archivo, false);
</script>
<script>

    $('.associateBranch').click(function(){

       var prodcutoID =  $(this).find('.idProducto').val();

        $(".sk-three-bounce").show();
        $.ajax({
            //url: "../orden/CListarorden/detalle",
            type:"post",
            success: function(){     
              $(".pages").load("../productos/Cproductos/loadSucursales/"+prodcutoID); 
              setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  
    });

    $(".viewDetalle").click(function()
    {
        $(".myModalDetalle2").modal({
           backdrop: 'static', 
           keyboard: false 
        });

        var prodcutoID = $(this).find('.idProducto').val();
        //alert(prodcutoID);
        $(".cont-detalleView").load("../productos/Cproductos/detalleProducto2/"+prodcutoID);

    });

    $(document).ready(function()
    {




    //-----------------Jquery insercion de  productos----------------
      $("#saveProducto").click(function()
      {
        
         var formulario = document.getElementById('productos');
         if(formulario.checkValidity())
         {
              $(".loading").show();
              var formData = new FormData();
                    formData.append('files', $('#files')[0].files[0]);
                    formData.append('filevideo', $('#video')[0].files[0]);
                    formData.append('nombre', $('#nombre').val());
                    formData.append('categoria', $('#categoria').val());
                    formData.append('descripcion', $('#descripcion').val());
                    formData.append('precio', $('#precio').val());
              
            $.ajax({
               url: "../productos/Cproductos/save_producto",
                type:"post",
                processData: false,  // tell jQuery not to process the data
                contentType: false,  // tell jQuery not to set contentType
                data: formData,

                    success: function(data)
                    {
                      if (data == "3") 
                      {
                        alert("El tamaño de la imagen no es correcto");
                        $(".loading").hide();
                      }
                      else
                      {
                        $(".loading").hide();
                        $("#list").hide();
                        $('#nombre').val("");
                        $('#descripcion').val("");
                        $('#precio').val("");
                        document.getElementById("files").value = "";
                        //$('#files').val("");
                        $('#video').val("");
                        $(".pages").load("../productos/Cproductos/index");
                        
                      }
                      
                      
                    },
                    error:function(data)
                    {
                        alert(data);
                    }
                });
         }
         else
         {
            alert('Hay campos requeridos');
         }
         

      });
      //-------------------------Fin -----------------------------------

      //-----------------Jquery insercion de  productos----------------
      $("#saveCategoria").click(function()
      {

        var formulario = document.getElementById('categoriaP');
         if(formulario.checkValidity())
         {
          $.ajax
             ({
              url: "../productos/Cproductos/save_categoria",
              type:"post",
              data: $("#categoriaP").serialize(),
              success: function()
              {
                $('#myModal').modal('toggle');
                $(".pages").load("../productos/Cproductos/index"); 
              },
              error:function(){
                  alert("failure");
              }
            });
         }
         else
         {
            alert("Hay campos requeridos");
         }   

      });
      //-------------------------Fin -----------------------------------

      //-----------------Jquery cargar de sucursales asociadas----------
      //----------------add proveedor---------------
    $(".associateBranch").click(function()
    {

       var prodcutoID =  $(this).find('.idProducto').val();

        $(".sk-three-bounce").show();
        $.ajax({
            //url: "../orden/CListarorden/detalle",
            type:"post",
            success: function(){     
              $(".pages").load("../productos/Cproductos/loadSucursales/"+prodcutoID); 
              setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });  

      
    });
    //-------------------------Fin ------------------
      //-------------------------Fin -----------------------------------

    

 
  $(".deleteP").click(function()
  {
     $(".modalEliminar").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var prodcutoID = $(this).find('.idProducto').val();
    $("#prodcutoIDYes").val(prodcutoID);
  });


  $(".modifyP").click(function()
  {
     $(".modalEditar").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var prodcutoID = $(this).find('.idProducto').val();
    $(".viewProductoData").load("../productos/Cproductos/updateProducto/"+prodcutoID); 
  });



  $(".deleteNot").click(function()
  {

     $('.modalEliminar').modal('toggle'); 

  });
  //-------------------------Fin -----------------------------------

 
  $(".deleteYes").click(function()
  {
      var ProductoId = $(this).find('#prodcutoIDYes').val();
      var ProductoName = $(".deleteP").find('.ImageName').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../productos/Cproductos/delete_producto",
          type:"post",
          data: {ProductoId:ProductoId,ProductoName:ProductoName},
          success: function(message)
          {
            alert(message);
            $(".pages").load("../productos/Cproductos/index");
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
      //alert(sucursalID);
      $(".conten-sucursales").hide();
      $(".load-productoBySucursal").show();
      

      $(".sk-three-bounce").show();
        $.ajax({
            //url: "../orden/CListarorden/detalle",
            type:"post",
            success: function(){     
              $(".load-productoBySucursal").load("../productos/Cproductos/productosBySucursal/"+sucursalID); 
              setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);      
            },
            error:function(){
                //alert("Error.. No se subio la imagen");
            }
        });

  });
  //-------------------------Fin -----------------------------------


  //--------------------Busqueda por filtro de categoria de producto

  $('.categoriaSearch').change(function () 
  {
    var categoryID = $('.categoriaSearch').val();
      if (categoryID !=0)
      {
        $(".conten-productos").hide();
        $(".load-categoryProductos").show();
        $(".load-categoryProductos").load("../productos/Cproductos/SearchByCategory/"+categoryID);
      }
      else
      {
         $(".pages").load("../productos/Cproductos/index");
      }
     
  });

  //----------------------FIN --------------------------------------



  //----------------- Open modal view data-------------------
  $(".viewData").click(function()
  //$(document).on('click','.viewData',function() 
  {
     $(".ModaViewdata").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    var categoriaID = $(this).find('.viewDataID').val();
    $(".modalViewCOntent").load("../productos/Cproductos/viewCategoria/"+categoriaID);
  });

  //----------------modificar data---------------
    $(".EditData").click(function()
    //$(document).on('click','.EditData',function() 
    {
        var categoriaID = $(this).find('.editValID').val();
        $(".pages").load("../productos/Cproductos/editDataControll/"+categoriaID); 
    });


//--------------------Delete caegoria------------------------------ 
  $(".deleteBTN").click(function()
  //$(document).on('click','.deleteBTN',function() 
  {
      var dataDeleteID = $(this).find('.deleteValID').val();
      //alert(ProductoId);
      $.ajax
      ({
          url: "../productos/Cproductos/delete_data",
          type:"post",
          data: {dataDeleteID:dataDeleteID},
          success: function(message)
          {
            alert("Se elimino correctamente la informacion");
            $(".pages").load("../productos/Cproductos/index");
          },
          error:function()
          {
            alert("Es posible que esta catgoria este en uso");
          }
      });

  });
  //-------------------------Fin -----------------------------------



 });

  
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
    background-color: #D82787;
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
.icoAlert
{
  font-size: 22px;
  float: right;
  color: #3e9b48;
  margin: 4px;
}
.icoAlertError
{
  font-size: 22px;
  float: right;
  color: red;
}

.vdetalle
{
    background-color: red;
    color: #fff;
    text-align: center;
    font-size: 10px;
    border-radius: 64px;
    width: 23px;
    float: left;
}

.btn.btn-sm {
    font-size: 9px !important;
    padding: 5px 12px !important;
}
</style>
<ul class="nav nav-tabs">
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-plus'></i>Agregar producto</a></li> 
   <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-eye'></i>Productos</a></li>
  <li id="menu_li" class="C "><a href="#tab1_3" data-toggle="tab"><i class='fa fa-home'></i>Productos por sucursal</a></li>
  <li id="menu_li" class="D "><a href="#tab1_4" data-toggle="tab"><i class='fa fa-list-ul'></i>Categoria de productos</a></li>  
</ul>

<div class="cont-loadProductos">
  
    <div class="tab-content">

        <div class="tab-pane fade active in" id="tab1_1">
            <div class="row col-lg-12 conten-productos">

                    <table class="table table-hover table-dynamic ">
                            <thead class='titulos'>
                              <tr>
                                <th>Nombre</th>                                          
                                <th>Categoria</th>
                                <th>2checkoutID</th>
                                <th>Precio Sugerido</th>
                                <th>Precio Minimo</th>
                                <th>Estado</th>
                                <th>Detalle</th>                        
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if($producto){
                            foreach ($producto as $value) {
                                    ?>
                                     <tr>
                                        <td><?php echo $value->nombre_producto;  ?></td>
                                        <td><?php echo $value->nombre_categoria_producto;  ?></td>
                                        <td><?php echo $value->customnum;  ?></td>
                                        <td><?php echo $value->numerico1;  ?></td>
                                        <td><?php echo $value->precio_minimo;  ?></td>
                                        <td>
                                            <?php if($value->prodStado == 1){
                                                ?><span class="btn btn-success btn-sm">Activo</span><?php
                                            }else{
                                                ?><span class="btn btn-warning btn-sm">Inactivo</span><?php
                                            }?>
                                                
                                            </td>
                                        <td>
                                            <a class="btn btn-primary  btn-sm associateBranch" style="margin-left: -9px;" role="button">Asociar
                                                    <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">

                                                    </a> 
                                                    <a class="btn btn-primary  btn-sm viewDetalle" style="margin-left: -9px;" role="button">Detalle
                                                    <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>"></a>
                                                    <!--
                                                    <a class="btn btn-primary  btn-sm modifyP" style="margin-left: -9px;" role="button"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                      <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                                                    </a>-->

                                                    <a class="btn btn-primary  btn-sm deleteP" style="margin-left: -9px;" role="button"><i class="fa fa-trash" aria-hidden="true"></i>
                                                      <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                                                      <input type="hidden" name="ImageName" class="ImageName" value="<?php echo $value->image ?>">
                                                    </a>
                                                  <?php if($value->ingredientes_completos != 0)
                                                                  {?>
                                                    <span class="fa fa-check-circle icoAlert" style="position: absolute; float: right;" title="Ingredientes completos" aria-hidden="true"></span>

                                             <?php }
                                            else{?>
                                                   <p class="fa fa-exclamation-triangle icoAlertError" title="Necesita completar ingredientes" aria-hidden="true"></p>
                                            <?php
                                            } 
                                            ?> 
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

        <div class="tab-pane includ fade" id="tab1_2" spellcheck="true">
            <div class="row line col-md-12">
                <div class="col-md-6">                    
                        <span class="input input--hoshi">
                              <input class="input__field input__field--hoshi" type="text" id="nombre" name="nombre" required/>
                              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                              <span class="input__label-content">Nombre Producto<strong>*</strong></span>
                              </label>
                        </span>   
          
                        <span class="input input--hoshi">
                                <span class="input__label-content">Categoria<strong>*</strong></span>
                                <select style="width: 60%;" class="form-control form-grey" name="categoria" id="categoria" data-style="white" data-placeholder="Seleccion una categoria" required>
                                <?php
                                foreach ($categoria as $value) {
                                  ?>
                                  <option value="<?php echo $value->id_categoria_producto ?>"><?php echo $value->nombre_categoria_producto?>
                                  </option>
                                  <?php
                                }
                                ?>                      
                                </select>
                                <p id="addCategoria" style="margin-top: 9px;margin-left: 4px;background-color: #c75757;" class="btn btn-success">Agregar</p>
                                
                             </span>


                        <span class="input input--hoshi">
                              <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" spellcheck="true" />
                              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                              <span class="input__label-content">Descripción</span>
                              </label>
                        </span>
                          
                        <span class="input input--hoshi">
                              <input class="input__field input__field--hoshi" type="file" id="video" name="video[]" />
                              <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                              <span class="input__label-content">Video</span>
                              </label>
                        </span>

                  
                        <span class="input input--hoshi">
                             <button type="button" id="saveProducto" class="btn btn-primary">Guardar</button>
                        </span>                
                </div> 

                <form enctype="multipart/form-data" id="productos" method="POST">  
                <div class="col-md-6">                
                    <div class="panel panel-info"> 
                        <div class="panel-heading"><h3 class="panel-title">Vista previa Imagen</h3></div>
                        <span class="input input--hoshi">
                            <input class="input__field input__field--hoshi" type="file" id="files" name="files[]" required />
                            <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                                <span class="input__label-content">Imagen<strong>*</strong></span>
                            </label>
                        </span>
                             
                            <div class="panel-body" id="list" style="display:none;"> 
                                <center>
                           
                                </center>
                             </div> 
                    </div>

                    <div class="panel panel-info"> 
                            <div class="panel-heading"><h3 class="panel-title">Estatus</h3></div> 
                            <div class="panel-body" id="list">
                                <center> 
                                    <i class="fa fa-spinner fa-spin fa-3x fa-fw loading" style="display:none;"></i>
                                    <span class="sr-only">Loading...</span> 

                                    <div class="msg alert alert-success" role="alert" style="display:none;">Guardado correctamente</div>
                                </center>  
                            </div> 
                    </div>              
                    </div>
                </form> 
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
                <div class="cont-sucursales">
                     <input type="hidden" name="idSucursal" class="idSucursal" value="<?php echo $value->id_sucursal ?>"></a>
                    <i class='fa fa-home' style="font-size: 150px;color:#D82787;"></i>
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

        <div class="tab-pane fade" id="tab1_4">
         
            <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Fecha Creacion</th>                                                    
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //var_dump($categoria);
                    if (!empty($categoria)) 
                    {
                        foreach ($categoria as $value) 
                        {
                    ?>
                    <tr>
                        <td><?php echo $value->nombre_categoria_producto;  ?></td>
                        <td><?php echo $value->descripcion;  ?></td>
                        <td><?php echo $value->fecha_creacion;  ?></td>
                        <td>
                            <button type="button" class="btn btn-primary  btn-sm EditData">
                            <input type="hidden" name="editValID" class="editValID" value="<?php echo $value->id_categoria_producto ?>">Modificar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm deleteBTN">
                            <input type="hidden" name="deleteValID" class="deleteValID" value="<?php echo $value->id_categoria_producto ?>">Eliminar
                            </button>
                            <button type="button" class="btn btn-primary  btn-sm viewData">
                            <input type="hidden" name="viewDataID" class="viewDataID" value="<?php echo $value->id_categoria_producto ?>">Ver
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



    </div> 
</div>




<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ModaAddCategory" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #D82787;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Agregar Categoria de productos
          </h4>
          <hr>
        <div class="modal-body">

                 <form id="categoriaP" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombre" required name="nombre" required/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre*</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion"  />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                     <button type="button" id="saveCategoria" class="btn btn-primary">Guardar</button>
                  </span>
                 </form>
          
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
<div class="modal fade myProductoAssociate" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Asociar Producto a Sucursal
          </h4>
          <hr>
        <div class="modal-body">
           <div class="cont-sucursal">
             
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


<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade myModalDetalle2" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
         <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #D82787;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Detalle de Producto.
          </h4>
          
        <div class="modal-body">
          <button type="button" style="color: #fff; float: right;" class="btn btn-danger" data-dismiss="modal">Close</button>
              <div class="cont-detalleView">
                
                  <div class="alert alert-warning" role="alert">No hay informacion de detalle!!!</div>


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


<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade myModalDetalle" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
         <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Detalle de producto
          </h4>
          <hr>
        <div class="modal-body">

              <div class="cont-detalleView">
                
                  <div class="alert alert-warning" role="alert">No hay informacion de detalle!!!</div>


              </div>

              <div class="cont-formDetalle" style="display:none;">
                 <form id="categoriaP" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombre" required name="nombre" required/>
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombres</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion"  />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripción</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                     <button type="button" id="saveCategoria" class="btn btn-primary">Guardar</button>
                  </span>
                 </form>
              </div>
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
      <div class="modal-content">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Eliminar Datos
          </h4>
          <hr>
        <div class="modal-body">
           <div class="cont-message"  style="font-size: 30px;padding: 12px;margin: 6px;">
           <span class="glyphicon glyphicon-remove" aria-hidden="true" style="font-size: 60px;color: #bb1212;"></span>
             Seguro que desea eliminar la información seleccionada
           </div>
           <hr>
           <div class="bar--action" style="float: right;">
             <span class="btn btn-warning deleteNot">Cancelar</span>
             <span class="btn btn-warning deleteYes">
              <input type="hidden" name="prodcutoIDYes" id="prodcutoIDYes" val="">
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


<!-- Codigo de funcionalidad de Modals editars-->
<div class="modal fade modalEditar" role="dialog" tabindex="1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
       <span type="button" style="font-size: 50px;" class="close" data-dismiss="modal">&times;</span>
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
          Modificar Datos
          </h4>
          <hr>
        
        <div class="modal-body">
          <div class="viewProductoData"></div>
        </div>

        <div class="modal-footer">
        <div id="msg" class="msgShowP"></div> 
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
           Información categoria de productos
          </h4>
          <hr>
        <div class="modal-body modalViewCOntent">

            
          
        </div>
        <div class="modal-footer">
        <div id="msg" class="msgShow">
        </div> 
          <button type="button" style="background-color: #16171a;color: #fff;" class="btn btn-info" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- Fin del Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->  