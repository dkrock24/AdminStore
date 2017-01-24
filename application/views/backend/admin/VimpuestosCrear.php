<script>
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $("a#usuarios").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
            $(".A").removeClass("active");
            $(".B").addClass("active");
        });

        var id_departamentos="";
        var num=0;

        //Mostrar Departamentos mediante el pais
        $("#pais").change(function(){
            $("#departamento").empty();
            $("#sucursal").empty();
            var id = $(this).val();
            $.ajax({
            url: "../admin/Csucursales/getDepartamento/"+id,  
            datatype: 'json',      
            cache : false,                

                success: function(data){                                                    
                    $.each(JSON.parse(data), function(i, item) {    
                        if(num==0){
                            id_departamentos = item.id_departamento;                            
                            num++;
                        }
                    $("#departamento").append('<option value='+item.id_departamento+'>'+item.nombre_departamento+'</option>');
                        
                    });
                    

                            $("#sucursal").empty();
                            $.ajax({
                            url: "../admin/Csucursales/getSucursalesByDepartamento/"+id_departamentos,  
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
                        


                },
                error:function(){
                }
            });
        });

        $("#departamento").change(function(){
            
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

        $("#back").click(function(){   
            $(".sk-three-bounce").show();     
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
            setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
        });



        $("#guardar").click(function(){
            $.ajax({
            url: "../admin/Cimpuesto/saveImpuesto/",  
            type: "post",
            data: $('#crearImpuesto').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../admin/Cimpuesto/index");
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
#back{
    text-align: right;
    float: right;
    font-size: 20px;
}
</style>

<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" id="usuarios" name="../admin/Cimpuesto/index" data-toggle="tab"><i class='fa fa-home'></i>Sucursal</a></li>
</ul>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <form action="#" method="POST" name="impuesto" id="crearImpuesto">
                <div class="list-group">
                    <a href="#" class="list-group-item active">
                        <i class='fa fa-info'></i>Crear Nuevo Impuesto Departamento<i id="back" class="fa fa-arrow-left" name="../admin/Cimpuesto/index" alt="Atras"></i>
                    </a>
                    <a  class="list-group-item">
                        <td>Nombre :</td>
                        <td> <input type="text" class="form-control" name="nombre" value=""></td>
                    </a>
                    <a  class="list-group-item">
                        <td>Monto :</td>
                        <td> <input type="text" class="form-control" name="monto" value=""></td>
                    </a>
                    <a  class="list-group-item">
                        <td>Descripcion :</td>
                        <td> <input type="text" class="form-control" name="descripcion" value=""></td>
                    </a>
                    
                    <a class="list-group-item">
                        <td>Seleccionar Pais :</td>
                        <select name="pais" id="pais" class="form-control">
                        <option value=""> - - -</option>
                        <?php
                        foreach ($paises as $paise) {
                            ?>
                            <option value="<?php echo $paise->id_pais ?>"><?php echo $paise->nombre_pais ?></option>
                            <?php
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
                    
                    <a  class="list-group-item">
                        <td>Estado :</td>
                        <td> 
                        <select name="estado" class="form-control">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        </td>
                    </a>
                    <a class="list-group-item active save" id="guardar" alt="Guarda">
                        <i class='fa fa-save'></i>Guarda                
                    </a>
                </div>
            </form>
            

        </div>
        <div class="col-md-5"></div>
    </div>
</div>