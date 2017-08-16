<?php
   session_start();
?>
 <!-- END PRELOADER -->
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 

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

 $(".agregarSobras").click(function()
  {
    
    $(".cont-table-sobras").hide();
    $(".addSobras").show();
    $(".backOPtion").show();
    $(".agregarSobras").hide();
  
  });

  $(".backOPtion").click(function()
  {
    $(".cont-table-sobras").show();
    $(".addSobras").hide();
    $(".backOPtion").hide();
    $(".agregarSobras").show();

  });

 //-----------------Jquery insercion de  productos----------------
      $("#saveSobras").click(function()
      {

        //alert("test");
        var formData = new FormData();
                formData.append('files', $('#files')[0].files[0]);
                formData.append('ingrediente', $('#ingrediente').val());
                formData.append('cantidad', $('#cantidad').val());
                formData.append('comment', $('#comment').val());
                formData.append('sucursal', $('#sucursal').val());
                formData.append('unidaMedida', $('#unidaMedida').val());
                formData.append('userID', $('#userID').val());
      //alert(formData);
        $.ajax
           ({
            url: "../sobras/Csobras/save_sobras",
            type:"post",
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            data: formData,

            success: function()
            {
              $(".pages").load("../sobras/Csobras/index"); 
            },
            error:function(){
                alert("Ocurrio un problema :(");
            }
          });

      });
      //-------------------------Fin -----------------------------------

    //----------------- Open modal view data-------------------
    $(".viewDataM").click(function()
    {
       $(".ViewdataModal").modal({
             backdrop: 'static', 
             keyboard: false 
          });
      var sobrasID = $(this).find('.sobrasID').val();
      $(".modalViewCOntent").load("../sobras/Csobras/viewSobras/"+sobrasID);
    });
//-------------------------Fin -----------------------------------

 //----------------- Open modal view data-------------------
    $(".viewDataP").click(function()
    {
       $(".ViewdataModalP").modal({
             backdrop: 'static', 
             keyboard: false 
          });
      var sobrasIDP = $(this).find('.sobraspID').val();
      $(".modalViewCOntentP").load("../sobras/Csobras/viewSobrasP/"+sobrasIDP);
    });
//-------------------------Fin -----------------------------------

//------------------------AutoComplete---------------------------------

   $("#ingrediente").autocomplete({
        source: "../productos/Cproductos/catalogo_materiales",
        minLength: 1
  });
//------------------END--------------------------------------------

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
  .ui-autocomplete { 
    z-index:2147483647;
  
  }
  .ui-autocomplete {
    position: absolute;
}

#container_tags {
    display: block; 
    position:relative
}
  .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
</style>


<ul class="nav nav-tabs">
  <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-list-alt'></i>Ver Desperdicios</a></li>
  <li id="menu_li" class="B "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-bar-chart'></i>Ver Desperdicios Productos</a></li>
  
</ul>
  <div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
    <div id="actions-bar">
      <span  style="float:right;background-color: #c75757;" class="btn btn-success agregarSobras">Nuevo Registro</span>
      <span  style="float:right;background-color: #c75757; display: none;" class="btn btn-success backOPtion">Regresar</span>
    </div>    

      <div class="cont-table-sobras">  
      <table class="table">
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
                      foreach ($datosSobras as $value) 
                      {
                      ?>
                    <tr>
                        <td>
                         <?php if ($value->estatus_registro == "1") 
                          {
                            ?>
                          
                             <p style="margin-right: 10px;color: #3e9b48;font-size: 25px;" class="fa fa-check-circle icoAlert" aria-hidden="true"></p>
                          <?php } ?>
                        <?php echo $value->nombre_sucursal;  ?></td>
                        <td><?php echo $value->nombre_matarial;  ?></td>
                        <td><?php echo $value->cantidad_sobras;  ?></td>
                        <td><?php echo $value->nombre_unidad_medida;  ?></td>
                        <td><?php echo $value->fecha_registro;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary viewDataM">
                            <input type="hidden" name="sobrasID" class="sobrasID" value="<?php echo $value->id_sobras ?>">Ver
                          </button>
                         
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
      ?> 
                   
    </tbody>   
    </table>
    </div>  
  </div>






    <div class="tab-pane includ fade" id="tab1_2">
    <div class="row line col-md-12">
      <div class="cont-table-sobras">  
      <table class="table">
                <thead class='titulos'>
                    <tr>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Cantidad</th>                        
                        <th>Estatus</th>
                        <th>Fecha</th>                                                
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                      foreach ($datosSobrasP as $values) 
                      {
                      ?>
                    <tr>
                        <td>
                         <?php if ($values->estatus_registro == "1") 
                          {
                            ?>
                          
                             <p style="margin-right: 10px;color: #3e9b48;font-size: 25px;" class="fa fa-check-circle icoAlert" aria-hidden="true"></p>
                          <?php } ?>
                        <?php echo $values->nombre_sucursal;  ?></td>
                        <td><?php echo $values->nombre_producto;  ?></td>
                        <td><?php echo $values->cantidad;  ?></td>
                        <td><?php echo $values->estatus_registro;  ?></td>
                        <td><?php echo $values->fecha_registro;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary viewDataP">
                            <input type="hidden" name="sobraspID" class="sobraspID" value="<?php echo $values->id_sobra_producto ?>">Ver
                          </button>
                         
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
      ?> 
                   
    </tbody>   
    </table>
    </div>  
    </div>  
    </div>


</div>


<div class="addSobras" style="display:none;">
    <form enctype="multipart/form-data" id="productos" method="POST">
      <div class="col-md-12">

              <div class="col-md-6">
                      <span class="input input--hoshi">
                          <input class="input__field input__field--hoshi" type="text" id="ingrediente" required name="ingrediente" />
                          <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                          <span class="input__label-content">Ingrediente</span>
                          </label>
                      </span>
               </div>     
                    
                   
                    <div class="col-md-6">   
                       <span class="input input--hoshi">
                          <input class="input__field input__field--hoshi" type="number" id="cantidad" name="cantidad" required />
                          <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                          <span class="input__label-content">Cantidad</span>
                          </label>
                      </span>
                    </div>
                      

      </div> 
      
      <div class="col-md-12">
                    <div class="col-md-6"> 
                       <span class="input input--hoshi">
                            <span class="input__label-content">Sucursales</span>
                            <select class="form-control form-grey" name="sucursal" id="sucursal" data-style="white" data-placeholder="Seleccion una categoria">
                             <option value="0">N/A </option>
                            <?php
                            foreach ($sucursales as $value) {
                              ?>
                              <option value="<?php echo $value->id_sucursal ?>"><?php echo $value->nombre_sucursal?>
                              </option>
                              <?php
                            }
                            ?>                      
                            </select>
                        
                            
                         </span>
                      </div>  

                    <div class="col-md-6"> 
                       <span class="input input--hoshi">
                            <span class="input__label-content">Unida Medida</span>
                            <select class="form-control form-grey" name="unidaMedida" id="unidaMedida" data-style="white" data-placeholder="Seleccion una categoria">
                             <option value="0">N/A </option>
                            <?php
                            foreach ($unidadMedida as $value) {
                              ?>
                              <option value="<?php echo $value->id_unidad_medida ?>"><?php echo $value->nombre_unidad_medida?>
                              </option>
                              <?php
                            }
                            ?>                      
                            </select>
                        
                            
                         </span>
                      </div>


                        <div class="col-md-6"> 
                       <span class="input input--hoshi">
                       <span class="input__label-content">Imagen de refencia</span>
                      <input class="input__field input__field--hoshi" type="file" id="files" name="files[]" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">   
                        </span>
                      </div>  

                      <div class="col-md-6">   
                       <span class="input input--hoshi">
                          <input class="input__field input__field--hoshi" type="text" id="comment" name="comment"  />
                          <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                          <span class="input__label-content">Comentario</span>
                          </label>
                      </span>
                    </div>
                      

                    <div class="col-md-12"> 
                       <span class="input input--hoshi">
                       <input type="hidden" name="userID" class="userID" id="userID" value="<?php echo $_SESSION['idUser'] ?>">
                         <button type="button" id="saveSobras" class="btn btn-primary">Guardar</button>
                      </span>
                    </div>
      </div> 
      </form>
</div>




<!-- Codigo de funcionalidad de Modals para aagregar sucursales y metodos de pago -->
<div class="modal fade ViewdataModal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Detalle desperdicios
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
<div class="modal fade ViewdataModalP" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
          <h4 class="modal-title" style="background-color: #445a18;padding: 20px;color: white;text-align: center;font-weight: bold;">
           Detalle desperdicios
          </h4>
          <hr>
        <div class="modal-body modalViewCOntentP">

            
          
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



