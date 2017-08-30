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


        $(".check").click(function(){
            $(".sk-three-bounce").show();
            var pc_nombre = $("#pc").val();
            var id_sucursal = $(this).attr("name");
            $.ajax({
            //url: "../admin/Csucursales/agregarPc/"+pc_nombre+"/"+id_sucursal,  
            type: "post",                

                success: function(data){                                                    
                    $(".pages").load("../admin/Csucursales/agregarPc/"+pc_nombre+"/"+id_sucursal);
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });//end

        $(".delete_pc").click(function(){
            $(".sk-three-bounce").show();
            var id_pc = $(this).attr("name");
            var id_sucursal = $(this).attr("id");
            $.ajax({
            //url: "../admin/Csucursales/agregarPc/"+pc_nombre+"/"+id_sucursal,  
            type: "post",                

                success: function(data){                                                    
                    $(".pages").load("../admin/Csucursales/eliminarPc/"+id_pc+"/"+id_sucursal);
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });//end

        


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
.marco{
  border-top: 1px solid black;
  border-left: 1px solid black;
  border-right: 1px solid black;
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
              <i class='fa fa-home'></i>Sucursal :  
              
            </a>
            <a class="list-group-item save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
              <i class='fa fa-arrow-right'></i>
              <?php if(isset($sucursales[0]->nombre_sucursal)){echo $sucursales[0]->nombre_sucursal;} ?>        
            </a>            
            <a class="list-group-item active save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
                        
            </a>
        </div>

    </div>

    <div class="col-md-4">
      <form action="#" method="POST" name="sucursal" id="updateSucursal">
        <div class="list-group">
          <a href="#" class="list-group-item active">
              <i class='fa fa-desktop'></i>Pc Sucursal              
            </a>
            <?php
            if($pc != "")
            {
              foreach ($pc as $pc_sucursal) 
              {
              ?>
              <a class="list-group-item save delete_pc" id="<?php echo $sucursales[0]->id_sucursal; ?>" name="<?php echo $pc_sucursal->id_pc; ?>" alt="<?php echo $pc_sucursal->id_pc; ?>">
                <?php
                if($pc_sucursal->estado==1){
                  ?><i class='fa fa-check'></i> <?php
                }else{
                  ?><i class='fa fa-times'></i> <?php
                }
                ?>
                
                <?php echo $pc_sucursal->mac_address; ?>          
              </a>
              <?php
              }
            }
            ?>
            
            <a class="list-group-item active save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
              <i class='fa fa-refresh'></i>
            </a>
        </div>
      </form>
      

    </div>
    <div class="col-md-5">
      <div class="list-group">
          <a href="#" class="list-group-item active">
              <i class='fa fa-plus'></i>Registrar Nueva Computadora             
            </a>
              <a class="list-group-item" id="" name="" alt="">
                <label>Nombre Computadora</label>
                <input type="text" name="pc" id="pc" class="form-control marco"><br>
                <button type="button" name="<?php echo $sucursales[0]->id_sucursal ?>" id="btn-crear-pc" class="btn btn-primary btn-transparent form-control check">Crear Computadora</button>
              </a>
            
            <a class="list-group-item active save" id="guardar" name="<?php echo 1; ?>" alt="Actualizar">
              <i class='fa fa-refresh'></i>
            </a>
        </div>      
    </div>
  </div>
</div>