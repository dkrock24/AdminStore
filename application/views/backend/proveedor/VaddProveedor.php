<link href="../../../assets/plugins/input-text/style.min.css" rel="stylesheet">
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backProveedor").click(function()
    {
      $(".pages").load("../proveedor/Cproveedor/index"); 
    });
    //-------------------------Fin ------------------


    //-----------------save proveedor--------------
      $("#saveProveedor").click(function()
      {
        //alert($("#addProveedor").serialize());
        $.ajax
           ({
            url: "../proveedor/Cproveedor/save_proveedor",
            type:"post",
            data: $("#addProveedor").serialize(),
            success: function()
            {
              alert("Proveedor agregado correctamente");
              $(".pages").load("../proveedor/Cproveedor/index"); 
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
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backProveedor">Regresar</button>
<h1>Agregar Proveedor</h1>
<hr/>
<div class="addIngredientes">
<form id="addProveedor" action="post">
  <div class="col-md-12">
               <div class="col-md-6">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="empresaP" required name="empresaP" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Empresa</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcionP" name="descripcionP" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>
                </div>  
  </div>              
    <div class="col-md-12">
               <div class="col-md-6">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="correoP" required name="correoP" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Correo</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="direccionP" name="direccionP" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Direccion</span>
                      </label>
                  </span>
                </div>  
        </div>  


          <div class="col-md-12">
               <div class="col-md-6">
                 <form enctype="multipart/form-data" id="productos" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="telefonoP" required name="telefonoP" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Telefono</span>
                      </label>
                  </span>
                </div>  
                
                 <div class="col-md-6">  
                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="contactoR" name="contactoR" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Contacto de referencia</span>
                      </label>
                  </span>
                </div>  
  </div>  

                <div class="col-md-12"> 
                   <span class="input input--hoshi">
                     <button type="button" id="saveProveedor" class="btn btn-primary">Guardar Proveedor</button>
                  </span>
                </div>
  </div> 
  </form>
</div>