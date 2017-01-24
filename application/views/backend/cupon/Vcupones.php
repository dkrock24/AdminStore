    <a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a> 
    <script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>
    <script src="../../../assets/plugins/jquery/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../../assets/plugins/jquery-ui/jquery-ui-1.11.2.min.js"></script>
    <script src="../../../assets/plugins/gsap/main-gsap.min.js"></script>
    <script src="../../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../../assets/plugins/jquery-cookies/jquery.cookies.min.js"></script> <!-- Jquery Cookies, for theme -->
    <script src="../../../assets/plugins/jquery-block-ui/jquery.blockUI.min.js"></script> <!-- simulate synchronous behavior when using AJAX -->
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
  $(document).ready(function(){
      // CONVERTIR FECHAS A TEXTO
        $("a#enlance").click(function(){        
            var ruta = $(this).attr('name');           
            $(".pages").load(ruta);
        });

        $("#guardar2").click(function(){
            $(".sk-three-bounce").show();
            $.ajax({
            url: "../cupon/Cindex/setCupones",  
            type: "post",
            data: $('#cupon1').serialize(),                           

                success: function(data){                                                  
                  $(".pages").load("../cupon/Cindex/index");
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });// End

        $("#guardar_categoria").click(function(){
            $(".sk-three-bounce").show();
            $.ajax({
                url: "../cupon/Cindex/setCategoria",  
                type: "post",
                data: $('#categoria_cupon1').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../cupon/Cindex/index");
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });// End

        $("a.eliminar").click(function(){
            $(".sk-three-bounce").show();
            var id = $(this).attr("id");
            $.ajax({
                url: "../cupon/Cindex/eliminarCategoria/"+id,  
                type: "post",
                //data: $('#categoria_cupon1').serialize(),                           

                success: function(data){                                                    
                    $(".pages").load("../cupon/Cindex/index");
                    setTimeout(function() {
                        $(".sk-three-bounce").css('display','none');
                    }, 1000);
                },
                error:function(){
                }
            });
        });// End


  });


$(".detalle_sucursal").click(function(){
  $(".sk-three-bounce").show();
    var id = $(this).attr("id");
      $.ajax({
        url: "../cupon/Cindex/imprimirCupon/"+id,  
        type: "post",
        //data: $('#categoria_cupon1').serialize(),                           

        success: function(data){                                                    
          $(".pages").load("../cupon/Cindex/imprimirCupon/"+id);
            setTimeout(function() {
              $(".sk-three-bounce").css('display','none');
            }, 1000);
          },
        error:function(){
        }
    });
});// End


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
.save{
  text-align: center;
}
.A .B{
  cursor: pointer;
}
#guardar, #guardar_categoria{
  cursor: pointer;
}

  .titulos{
    font-size: 12px;
  }
  .btn-crear{
    text-align: right;
    float: right;
    display: inline-block;
    position: relative;
    margin-right: 3%;
  }



</style>


<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-home'></i>Lista</a></li>
    <li id="menu_li" class="A "><a href="#tab1_2" data-toggle="tab"><i class='fa fa-file'></i>Generar</a></li>    
    <li id="menu_li" class="C "><a href="#tab1_3" id="categoria_cupon" name="12" data-toggle="tab"><i class='fa fa-file'></i>Categoria</a></li>  
</ul>

    <div class="tab-content">
        
        <div class="tab-pane fade active in" id="tab1_1">
            <a href="#" id="../admin/Csucursales/crear" class="btn btn-danger btn-crear" name="">Nueva</a><br>        
            <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Codigo</th>
                        <th>Categoria</th>
                        <th>Valor</th>                        
                        <th>Descripcion</th>
                        <th>Creado</th>                                                
                        <th>Estado</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($cupones !=""){
                foreach ($cupones as $cupon) 
                {
                ?>
                    <tr>
                        <td><?php echo $cupon->codigo_cupon;  ?></td>
                        <td><?php echo $cupon->nombre_categoria;  ?></td>
                        <td><?php echo $cupon->valor_categoria;  ?></td>     
                        <td><?php echo $cupon->descripcion_cupon;  ?></td>   
                        <td><?php $date = date_create($cupon->fecha_creacion); echo date_format($date,"Y/m/d");  ?></td>      
                        <td><?php echo $cupon->estado_cupon;  ?></td>                   
                        <td>
                            <a class="detalle_sucursal1" id="<?php echo $cupon->id_cupon; ?>" name='<?php echo $cupon->codigo_cupon; ?>' href="http://45.33.3.227/lapizzeria/index.php/backend/cupon/Cindex/pdf/<?php echo $cupon->id_cupon; ?>" target="_blank">
                                <button type="button" class="btn btn-primary btn-transparent">Detalle</button>
                            </a>
                        </td>
                    </tr>        
                <?php
                }
                }
                ?>                      
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade in" id="tab1_2">
            <div class="row">       
                <div class="col-md-4">
                    <form action="#" method="POST" name="cupon1" id="cupon1">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <i class='fa fa-map-marker'></i>Crear Cupones
                            </a>
                            <a  class="list-group-item">
                                <td>Numero de Cupones :</td>
                                <td> <input type="number" class="form-control" name="cantidad" value=""></td>
                            </a>
                            <a  class="list-group-item">
                                <td>Categoria del Cupon :</td>
                                <td>
                                    <select name="categoria" class="form-control">
                                        <?php
                                        foreach ($categorias_cupones as $categoria) {
                                            ?>
                                            <option value="<?php echo $categoria->id_cupon_categoria; ?>"><?php echo $categoria->nombre_categoria; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </a>    
                            <a  class="list-group-item">
                                <td>Longitud del Cupon :</td>
                                <td> <input type="number" class="form-control" name="longitud" value=""></td>
                            </a>    
                            <a  class="list-group-item">
                                <td>Descripcion Cupon :</td>
                                <td> <input type="text" class="form-control" name="descripcion" value=""></td>
                            </a>            
                            <a class="list-group-item active" id="guardar2" alt="Guarda">
                                <i class='fa fa-save'></i>Generar               
                            </a>
                        </div>
                    </form>
                </div>

                <div class="col-md-3">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <i class='fa fa-bookmark-o'></i>Cupones Activos
                        </a>
                        <a  class="list-group-item">
                            <h1><?php echo $cuponActivo[0]->activos; ?></h1>
                        </a>              
                        <a class="list-group-item active save" id="guardar" alt="Guarda">
                            <i class='fa fa-check'></i>               
                        </a>
                    </div>

                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            <i class='fa fa-bookmark-o'></i>Cupones Inactivos
                        </a>
                        <a  class="list-group-item">
                            <h1><?php echo $cuponInactivo[0]->inactivos; ?></h1>
                        </a>              
                        <a class="list-group-item active save" id="guardar" alt="Guarda">
                            <i class='fa fa-check'></i>               
                        </a>
                    </div>
                </div>

                <div class="col-md-5"></div>
                </div>
        </div>

        <div class="tab-pane fade" id="tab1_3">
            <div class="row">       
                <div class="col-md-4">
                    <form action="#" method="POST" name="categoria_cupon1" id="categoria_cupon1">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                <i class='fa fa-map-marker'></i>Categorias de Cupones
                            </a>
                            <a  class="list-group-item">
                                <td>Nombre Categoria :</td>
                                <td> <input type="text" class="form-control" name="nombre_categoria" value=""></td>
                            </a> 
                            <a  class="list-group-item">
                                <td>Valor Categoria :</td>
                                <td> <input type="text" class="form-control" name="categoria_valor" value=""></td>
                            </a>          
                            <a class="list-group-item active" id="guardar_categoria" alt="Guarda">
                                <i class='fa fa-save'></i>Crear Categoria               
                            </a>
                        </div>
                    </form>
                </div>

                <div class="col-md-8">
                        <div class="list-group">
                        <table class="table" border=1>
                            <tr>
                                <td colspan="6">
                                    <a href="#" class="list-group-item active">
                                        <i class='fa fa-map-marker'></i>Categorias Creadas
                                    </a>
                                </td>                            
                            </tr>

                            <tr>
                                <td>Nombre Categoria :</td>
                                <td>Valor</td>
                                <td>Estado</td>
                                <td>Creado</td>
                                <td>Cupones</td>
                                <td>Eliminar</td>
                            </tr> 
                            <?php
                            if($categorias_cupones!=""){
                                foreach ($categorias_cupones as $categorias) {
                                    ?>
                                    <tr>
                                        
                                        <td><?php echo $categorias->nombre_categoria; ?></td>
                                        <td><?php echo $categorias->valor_categoria; ?></td>
                                        <td><?php if($categorias->estado_categoria==1){ echo "Activo"; }else{echo "Inactivo";} ?></td>
                                        <td><?php $date = date_create($categorias->fecha_creacion); echo date_format($date,"Y/m/d"); ?></td>
                                        <td><?php echo $categorias->T; ?></td>
                                        <td><a href="#" id="<?php echo $categorias->id_cupon_categoria; ?>" class="btn btn-success eliminar">Eliminar</a></td>
                                    </tr> 
                                    <?php
                                }
                            }
                            ?>
                        </table>         
                        </div>
                </div>

            </div>
        </div>



  </div>



