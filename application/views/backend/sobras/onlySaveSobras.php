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
    <link rel="stylesheet" href="../../../assets/css/jquery-ui.min.css" type="text/css" /> 

<script>

 //-----------------Jquery insercion de  productos----------------
      $("#saveSobras").click(function()
      {
        var formData = new FormData();
                formData.append('files', $('#files')[0].files[0]);
                formData.append('ingrediente', $('#ingrediente').val());
                formData.append('cantidad', $('#cantidad').val());
                formData.append('sucursal', $('#sucursal').val());
                formData.append('comment', $('#comment').val());
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



<div class="addSobras">
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