    
    <script type="text/javascript" src="../../../assets/globalreport/js/jquery-1.9.1.min.js"></script>


    <script src="../../../assets/globalreport/js/generatorCharts.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){

        $(function () {
            Highcharts.chart('container1', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Pizza mas Vendida'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'Pizza1',
                        y: 56.33
                    }, {
                        name: 'Pizza2',
                        y: 24.03,
                        sliced: true,
                        selected: true
                    }, {
                        name: 'Pizza3',
                        y: 10.38
                    }, {
                        name: 'Pizza4',
                        y: 4.77
                    }, {
                        name: 'Pizza5',
                        y: 0.91
                    }, {
                        name: 'Pizza6',
                        y: 0.2
                    }]
                }]
            });

     

        });


        $("#guardar_reporte").click(function(){
            $.ajax({
                url: "../admin/Cdashboard/guardar_consulta",
                type:"post",
                data: $("#agregar_reporte").serialize(),
                
                success: function(){
                    $(".pages").load("../admin/Cdashboard/index");    
                },
                error:function(){
                    alert("failure");
                }
            });
        });

        var conta_parametro=0;
        $("#addInputs").click(function(){
            conta_parametro++;
            var A,B,C;
            A="A";
            B="B";
            C="C";
            var total = conta_parametro;
            $("#headers2").append(
                '<tr><td><input type="text" class="form-control" placeholder="Titulo" name="'+A+conta_parametro +'"></td><td><input type="text" placeholder="Nombre" class="form-control" name="'+B+conta_parametro +'"></td><td><input type="text" placeholder="Tipo" class="form-control" name="'+C+conta_parametro +'"></td><td><pan class="row_input"><i class="icon-cancel-circle"></i>Remove</span></td></tr>');
            $(".row_input").click(function()
            {
                --total;
                if(total==0)
                {
                    conta_parametro=0;
                    total=0;
                }
                var padre = $(this).parent().parent();
                padre.remove();
                $("#numero").val(total);
            });
            $("#numero").val(conta_parametro);  
        });

        $(".grafica").click(function(){
            var id = $(this).attr("id");
            $.ajax({
                url: "../admin/Cdashboard/cargar_grafica/"+id,
                type: "post",
                dataType: "html",
                
                success: function(data){  
                    $(".tabla_grafica").html(data);
                },
                error:function(){
                    alert("failure");
                }
            });
        });

        $("#generar").click(function(){
            
            $.ajax({
                url: "../admin/Cdashboard/get_query",
                data: $("#getQuery").serialize(),
                type: "post",            
                
                success: function(data){                 
                    $("#vista_grafica").html(data);
                },
                error:function(){
                    alert("failure");
                }
            });
        });

        $(".borrar_consulta").click(function(){
            var id = $(this).attr("name");
            $.ajax({
                url: "../admin/Cdashboard/eliminar_consulta/"+id,
                type: "post",            
                
                success: function(data){                 
                    $(".pages").load("../admin/Cdashboard/index");    
                },
                error:function(){
                    alert("failure");
                }
            });
        });

        $(".editar_consulta").click(function(){
            var id = $(this).attr("name");
            $.ajax({
                //url: "../admin/Cdashboard/eliminar_consulta/"+id,
                type: "post",            
                
                success: function(data){                 
                    $(".pages").load("../admin/Cdashboard/editarQuery/"+id);    
                },
                error:function(){
                    alert("failure");
                }
            });
        });

    });
    </script>

    <style type="text/css">
        .form-control{
            border: 1px solid grey;
        }
        .grafica{
            width: 100%;
            height: 130px;
            background: #9AC835;
            display: block;
            position: relative;            
            padding: 10px;
            border: 1px solid grey;
            overflow: hidden;
            margin: 2%;
        }
        .grafica:hover{
            background: #337ab7;
            color: white;
            cursor: pointer;
        }
        .icon{
            text-align: center;
            font-size: 30px;
        }
        .espacios{
            padding-bottom: 100px;
        }
        .boton_generar{
            text-align: center;
        }
    </style>


<ul class="nav nav-tabs">
    <li id="menu_li" class="A active"><a href="#tab1_1" data-toggle="tab"><i class='fa fa-tachometer'></i>Dashboard</a></li>
    <li id="menu_li" class="B "><a href="#tab1_2" id="reportes" name="../admin/Csucursales/acceso" data-toggle="tab"><i class='fa fa-line-chart'></i>Reportes</a></li>  
    <li id="menu_li" class="C "><a href="#tab1_3" id="agregar" name="../admin/Csucursales/acceso" data-toggle="tab"><i class='fa fa-plus'></i>Agregar</a></li>  
    <li id="menu_li" class="D "><a href="#tab1_4" id="listado" name="../admin/Csucursales/acceso" data-toggle="tab"><i class='fa fa-list'></i>Listado</a></li>      
</ul>

<div class="tab-content">
    <div class="tab-pane fade active in" id="tab1_1">
        <div class="row">
        <?php
            foreach ($querys as $datos) 
            {
                ?>
                    <div class="col-md-6">
                    <div class="list-group">
                        <a href="#" class="list-group-item active">
                            Demo
                        </a>
                        <a href="#" class="list-group-item">
                            <div id="container<?php echo $datos->id_global_report; ?>"></div>
                        </a>
                    </div>
                    </div>
                <?php
            }
        ?>
        </div>
    </div>

    <div class="tab-pane fade " id="tab1_2">
        <div class="row">
            <?php
                foreach ($reportes as $consultas) 
                {
                ?>
                    <div class="col-md-2">
                        <div class="grafica" id="<?php echo $consultas->id_global_report; ?>">
                            <div class="icon"><i class="<?php echo $consultas->icon; ?>"></i></div>
                            <p><?php echo $consultas->menu_name; ?></p>                            
                        </div>
                    </div>
                <?php
                }
            ?>
        </div>   
        <form id="getQuery">     
            <div class="row">
                <br>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="tabla_grafica">
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <a href='#' class='btn btn-default' name='get_data' id='generar'>Generar</a>    
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
        <div class="row">
            <div id="vista_grafica"></div>
        </div>
    </div>

    <div class="tab-pane fade" id="tab1_3">
        <form id="agregar_reporte" name="reportes">        
            <div class="row">
                <div class="col-md-6">
                    <p>Nombre</p>
                    <p><input type="text" name="nombre" class="form-control"></p>
                </div>
                <div class="col-md-6">
                    <p>Titulo</p>
                    <p><input type="text" name="titulo" class="form-control"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Icono</p>
                    <p><input type="text" name="icono" class="form-control"></p>
                </div>
                <div class="col-md-6">
                    <p>Descripcion</p>
                    <p><textarea name="descripcion" class="form-control"></textarea></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Consulta / Query</p>
                    <p><textarea name="query" rows="10" class="form-control"></textarea></p>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6">
                    <p>Tipo de Grafica</p>
                    <p>
                        <select name="tipo_grafica" class="form-control">
                            <?php
                            foreach ($graficos as $tipos) {
                                ?>
                                <option value="<?php echo $tipos->global_report_chart_id; ?>">
                                    <?php echo $tipos->chart_type; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </p>
                </div>

                <div class="col-md-6">
                    <p>Estado</p>
                    <p>
                        <select name="estado" class="form-control">
                            <option value="0">Inactivo</option>
                            <option value="1">Activo</option>
                        </select>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                               
                    <td width="15%" ><div id="addInputs"><i class="icon-plus white"></i>Agregar</div></td>
                    <table width="100%" id="headers2" class="row_head">
                        
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" value="" name="numero" id="numero">
                    <br>
                    <a href="#" id="guardar_reporte" class="btn btn-primary">Guardar</a>
                </div>
            </div>
        </form>
    </div>

    <div class="tab-pane fade" id="tab1_4">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                <thead>
                    <th>Nombre</th>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Grafico</th>
                    <th>Accion</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($consultas1 as $value) {
                    ?>
                        <tr>
                            <td><?php echo $value->menu_name ?></td>
                            <td><?php echo $value->title ?></td>
                            <td><?php echo $value->description ?></td>
                            <td><?php echo $value->chart_type ?></td>
                            <td>      
                                <a href="#" class="btn btn-primary editar_consulta" name="<?php echo $value->id_global_report ?>">Editar</a>                          
                                <a href="#" class="btn btn-success borrar_consulta" name="<?php echo $value->id_global_report ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php
                    }   
                    ?>
                </tbody>
                </table>
            </div>
        </div>        
    </div>

</div>


        


