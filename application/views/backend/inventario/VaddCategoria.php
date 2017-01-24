<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      
      $(".pages").load("../inventario/Cinventario/index");

    });
    //-------------------------Fin ------------------

    //----------------- Open modal add status-------------------
  $("#addEstatus").click(function()
  {
     $(".ModaViewdata").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    $(".modalViewCOntent").load("../inventario/Cinventario/addEstatus");
  });
//---------------------Fin codifo add estatus---------------------------


    //-----------------save proveedor--------------
    /*  $("#saveMaterial").click(function()
      {
        $.ajax
           ({
            url: "../inventario/Cinventario/save_material",
            type:"post",
            data: $("#addMaterialInventario").serialize(),
            success: function()
            {
              alert("Material agregado correctamente");
              $("#").val("");
              $("#").val("");
              //$(".pages").load("../inventario/Cinventario/index"); 
            },
            error:function(){
                alert("failure");
            }
          });

      });*/
      //-------------------------Fin -----------------------------------

       //-----------------save proveedor--------------
      $("#saveCategoriaMaterial").click(function()
      {
        if ($("#nombreCategoriaMateria").val() != "")
        {
          
          $.ajax
             ({
              url: "../inventario/Cinventario/save_categoria_material",
              type:"post",
              data: $("#addcategoriaMaterialInventario").serialize(),
              success: function()
              {
                alert("Categoria guardada correctamente");
                $("#nombreCategoriaMateria").val("");
                $("#descripcionCategoriaMateria").val("");
                //$(".pages").load("../inventario/Cinventario/index"); 
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

</style>
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedor">Regresar</button>
<h1>Agregar categoria de material</h1>
<hr/>
<div class="addIngredientes">
<form id="addcategoriaMaterialInventario" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreCategoriaMateria" required name="nombreCategoriaMateria" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionCategoriaMateria" name="descripcionCategoriaMateria" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripci&oacute;n</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12" style="margin-left: 20px;font-weight: bold;">

          <div class="col-md-6">   
            <span>Estatus:   </span><br>
            <span>
              <select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey estadoCategoria" name="estadoCategoria"  data-style="white" data-placeholder="Seleccione un estado...">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
              </select> 
            <span>          
          </div>  
  </div> 
  <div class="col-md-12">
    
          <div class="col-md-6"> 
            <span class="input input--hoshi">
              <button type="button" id="saveCategoriaMaterial" class="btn btn-primary">Guardar</button>
            </span>
          </div>
  </div> 
  </form>
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