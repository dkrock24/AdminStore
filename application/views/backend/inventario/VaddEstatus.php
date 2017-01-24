<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  
    //----------------- Open modal add status-------------------
  $("#addEstatusButton").click(function()
  {
     $(".ModaViewdata").modal({
           backdrop: 'static', 
           keyboard: false 
        });
    $(".modalViewCOntent").load("../inventario/Cinventario/addEstatus");
  });//---------------------Fin codifo add estatus---------------------------


    //-----------------save proveedor--------------
      $("#saveStatus").click(function()
      {
        $.ajax
           ({
            url: "../inventario/Cinventario/save_estatus",
            type:"post",
            data: $("#AddStatus").serialize(),
            success: function()
            {
              alert("Estatus agregado correctamente");
              $(".pages").load("../inventario/Cinventario/index"); 
            },
            error:function(){
                alert("failure");
            }
          });

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
<div class="addIngredientes">
<form id="AddStatus" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombreStatus" required name="nombreStatus" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombre estado</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionStatus" name="descripcionStatus" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripci&oacute;n estado</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12" style="margin-left: 36px;font-weight: bold;">
     <div class="col-md-6">  
        <span>Estatus:   </span><br>
          <span>
          <select style="width: 40%;margin-bottom: 12px;" class="form-control form-grey estado" name="estado"  data-style="white" data-placeholder="Seleccione una categoria...">
            <option value="1">Activo</option>
            <option value="2">Inactivo</option>               
          </select> 
          <span>  
      </div>  

      <div class="col-md-6"> 
        <span class="input input--hoshi">
          <button type="button" id="saveStatus" class="btn btn-primary">Guardar Estado</button>
        </span>
      </div>
  </div> 
  </form>
</div>