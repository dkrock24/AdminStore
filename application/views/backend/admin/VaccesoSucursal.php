<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#sucursales").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $(".btn-crear").click(function(){
            var url = $(this).attr('id');      
            $(".pages").load(url);        
        });


        $("#guardar").click(function(){
            var id_usuario = $(this).attr('name');
            $.ajax({
            url: "../admin/Csucursales/saveAcceso/"+id_usuario,  
            type: "post",
            data: $('#addSucursal').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../admin/Csucursales/acceso/"+id_usuario);
                },
                error:function(){
                }
            });
        });



        //Mostrar Departamentos mediante el pais
        $("#pais").change(function(){
            $("#departamento").empty();
            var id = $(this).val();
            $.ajax({
            url: "../admin/Csucursales/getDepartamento/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){ 
                $("#departamento").append('<option> - - - </option>');                                                   
                    $.each(JSON.parse(data), function(i, item) {                        
                        $("#departamento").append('<option value='+item.id_departamento+'>'+item.nombre_departamento+'</option>');
                    });
                },
                error:function(){
                }
            });
        });

        //Mostrar Sucursal por departamento
        $("#departamento").change(function(){
          $("#sucursal").empty();
          var id = $(this).val();
          $.ajax({
            url: "../admin/Csucursales/getSucursalesByDepartamento/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){   
                                                           
                  $.each(JSON.parse(data), function(i, item) {                    
                    $("#sucursal").append('<option value='+item.id_sucursal+'>'+item.nombre_sucursal+'</option>');
                  });
                },
                error:function(){
                }
            });
        });

        //Delete Acceso Sucursal a usuario
        $(".delete_acceso").click(function()
        {
            var id = $(this).attr("id");
            var id_usuario = $(this).attr("name");
            $.ajax({
            url: "../admin/Csucursales/deleteAcceso/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){   
                    $(".pages").load("../admin/Csucursales/acceso/"+id_usuario);
                },
                error:function(){
                }
            });
        });

        


    });
</script>
<style>
.save{
    text-align: center;
}
.A .B{
    cursor: pointer;
}
#guardar{
    cursor: pointer;
}
#btn-emilinar{
    text-align: right;
    float: right;
    font-size: 20px;
}
#btn-emilinar:hover{
    color: black;   
}
#sucursales{
    cursor: pointer;
}
</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a id="sucursales" name="../admin/Csucursales/index"><i class='fa fa-arrow-left'></i>Regresar</a></li>
</ul>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <i class='fa fa-home'></i>Detalle Usuario :                      
                    </a>
                    <a class="list-group-item save" id="" name="<?php echo 1; ?>" alt="Actualizar">
                    <table width="100%" class="table">
                        <tr><td>Nombres : </td><td> <?php if(isset($usuario[0]->nickname)){echo $usuario[0]->nickname;} ?></td></tr>
                        <tr><td>Rol :</td><td> <?php if(isset($usuario[0]->nombre_rol)){echo $usuario[0]->nombre_rol;} ?></td></tr>
                        <tr><td>Pais :</td><td> <?php if(isset($usuario[0]->nombre_pais)){echo $usuario[0]->nombre_pais;} ?></td></tr>
                        <tr><td>Depto :</td><td><?php if(isset($usuario[0]->nombre_departamento)){echo $usuario[0]->nombre_departamento;} ?></td></tr>
                    </table>                       
                        
                    </a>                    
                    <a class="list-group-item active save" id="" name="<?php echo 1; ?>" alt="Actualizar">
                                        
                    </a>
                </div>

        </div>

        <div class="col-md-4">
            <form action="#" method="POST" name="sucursal" id="updateSucursal">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <i class='fa fa-home'></i>Sucursales a Administrar                        
                    </a>
                    <?php
                    if($sucursalAcceso!=""){
                        foreach ($sucursalAcceso as $accesos) {
                        ?>
                        <a class="list-group-item delete_acceso" id="<?php echo $accesos->id; ?>" name="<?php echo $usuario[0]->id_usuario; ?>">
                            <?php echo $accesos->nombre_sucursal ?>           
                        </a>
                        <?php
                        }
                    }
                    ?>
                    
                    <a class="list-group-item active save" id="" name="<?php echo 1; ?>" alt="Actualizar">
                        <i class='fa fa-refresh'></i>               
                    </a>
                </div>
            </form>
            

        </div>
        <div class="col-md-4">
            <form action="#" method="POST" name="addSucursal" id="addSucursal">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <i class='fa fa-home'></i>Sucursales
                    </a>
                    <a class="list-group-item save">
                    <select name="pais" id="pais" class="form-control">
                    <option value=""> - - -</option>
                    <?php
                    if($pais != "")
                    {
                        foreach ($pais as $paises){
                        ?>
                        <option value="<?php echo $paises->id_pais ?>"><?php echo $paises->nombre_pais?>
                          </option> 
                        <?php
                        }
                    }
                    ?>
                    </select>
                    </a>
                    <a  class="list-group-item">
                        <td>Departamento :</td>
                        <select name="departamento" id="departamento" class="form-control">
                                            
                        </select>                    
                    </a>
                    <a  class="list-group-item">
                        <td>Sucursal :</td>
                        <select name="sucursal" id="sucursal" class="form-control">
                                            
                        </select>                    
                    </a>
                    <a class="list-group-item active save" id="guardar" name="<?php echo $usuario[0]->id_usuario; ?>" alt="Vincular">
                        <i class='fa fa-save'></i>  Vincular             
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>