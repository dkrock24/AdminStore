 
<script>
  $(document).ready(function()
  {

    //-----------------Jquery insercion de  productos----------------
      $("#saveCategoria").click(function()
      {
        alert($("#categoriaP").serialize());
        /*.ajax
           ({
            url: "../usuarios/Cusuarios/guardar_usuario",
            type:"post",
            data: $("#usuario").serialize(),
            
            success: function(){
              //alert("Se Guardo Correctamente El usuario");
              $(".A").removeClass("active");
              $(".B").addClass("active");
              $("#tab1_1").removeClass("active");
                
              $("#tab1_2").addClass("active in");
              $("#tab1_2").load("pages/lista_usuarios.php");  
            },
            error:function(){
                alert("failure");
            }
          });*/

      });
      //-------------------------Fin -----------------------------------
  });

</script>

  <div class="tab-content">
    <div class="tab-pane includ fade" id="tab1_2">
     <div class="row line col-md-12">
                <div class="col-md-6">
                 <form enctype="multipart/form-data" id="categoriaP" method="POST">
                  <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="nombre" required name="nombre" />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Nombres</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                      <input class="input__field input__field--hoshi" type="text" id="descripcion" name="descripcion" required />
                      <label class="input__label input__label--hoshi input__label--hoshi-color-1" for="input-4">
                      <span class="input__label-content">Descripcion</span>
                      </label>
                  </span>

                   <span class="input input--hoshi">
                     <button type="button" id="saveCategoria" class="btn btn-primary">Guardar</button>
                  </span>
                 </form>
          </div> 

          </div>   
    </div>

  