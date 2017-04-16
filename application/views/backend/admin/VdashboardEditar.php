    
    <script type="text/javascript" src="../../../assets/globalreport/js/jquery-1.9.1.min.js"></script>




    <script type="text/javascript">
    $(document).ready(function(){


        $("#guardar_reporte").click(function(){
            $.ajax({
                url: "../admin/Cdashboard/editar_consulta",
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

        $(".row_input2").click(function()
        {
            var valor = $("#numero").val();
            var valor_num = parseInt(valor);
            var padre = $(this).parent().parent();
            padre.remove();
            $("#numero").val(--valor_num);
        });

        

        var conta_parametro=0;
        $("#addInputs").click(function(){
            conta_parametro++;
            var A,B,C;
            A="A";
            B="B";
            C="C";
            var num = $("#numero").val();
            if(num !=null){
                conta_parametro =parseInt($("#numero").val());
                conta_parametro+=1;                
            }
            else
            {
                var total = conta_parametro;

            }
            
            $("#headers2").append(
                '<tr><td><input type="text" class="form-control" placeholder="Titulo" name="'+A+conta_parametro +'"></td><td><input type="text" placeholder="Nombre" class="form-control" name="'+B+conta_parametro +'"></td><td><input type="text" placeholder="Tipo" class="form-control" name="'+C+conta_parametro +'"></td><td><span class="btn btn-success row_input"><i class="icon-cancel-circle"></i>Remove</span></td></tr>');
            
            
            $("#numero").val(conta_parametro); 
            $(".row_input").click(function()
                {
                    var valor = $("#numero").val();
                    var valor_num = parseInt(valor);
                    var padre = $(this).parent().parent();
                    padre.remove()
                    $("#numero").val(--valor_num);    
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

    <li id="menu_li" class="A active"><a href="#tab1_3" id="agregar" name="../admin/Csucursales/acceso" data-toggle="tab"><i class='fa fa-plus'></i>Agregar</a></li>  
  
</ul>

<div class="tab-content">

    <div class="tab-pane fade active in" id="tab1_3">
        <form id="agregar_reporte" name="reportes">    
        <input type="hidden" name="id_query" value="<?php echo $query[0]->id_global_report ?>">    
            <div class="row">
                <div class="col-md-6">
                    <p>Nombre</p>
                    <p><input type="text" name="nombre" value="<?php echo $query[0]->menu_name ?>" class="form-control"></p>
                </div>
                <div class="col-md-6">
                    <p>Titulo</p>
                    <p><input type="text" name="titulo" value="<?php echo $query[0]->title ?>" class="form-control"></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p>Icono</p>
                    <p><input type="text" name="icono" value="<?php echo $query[0]->icon ?>" class="form-control"></p>
                </div>
                <div class="col-md-6">
                    <p>Descripcion</p>
                    <p><textarea name="descripcion" class="form-control"><?php echo $query[0]->description ?></textarea></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Consulta / Query</p>
                    <p><textarea name="query" rows="10" class="form-control"><?php echo $query[0]->query ?></textarea></p>
                </div>
            </div>  
            <div class="row">
                <div class="col-md-6">
                    <p>Tipo de Grafica</p>
                    <p>
                        <select name="tipo_grafica" class="form-control">
                            <?php
                            foreach ($graficos as $tipos) {
                                if($tipos->global_report_chart_id==$query[0]->chart_type_id){
                                    ?>
                                    <option value="<?php echo $tipos->global_report_chart_id; ?>">
                                        <?php echo $tipos->chart_type; ?>
                                    </option>
                                <?php
                                }                                
                            }
                            foreach ($graficos as $tipos) {
                                if($tipos->global_report_chart_id!=$query[0]->chart_type_id){
                                    ?>
                                    <option value="<?php echo $tipos->global_report_chart_id; ?>">
                                        <?php echo $tipos->chart_type; ?>
                                    </option>
                                <?php
                                }                                
                            }
                            ?>
                        </select>
                    </p>
                </div>

                <div class="col-md-6">
                    <p>Estado</p>
                    <p>
                        <select name="estado" class="form-control">
                        <?php
                        if($query[0]->status==0)
                        {
                            ?><option value="0">Inactivo</option><?php
                        }else{
                            ?><option value="1">Activo</option><?php
                        }
                        ?>                           
                            
                        </select>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">                               
                    
                    <table width="100%" id="headers2" class="row_head">
                        <?php
                        $A="A";
                        $B="B";
                        $C="C";
                        $contador=0;
                        if($parametros!="")
                        {
                        foreach ($parametros as $inputs) {
                            $contador++;
                            ?>
                            <tr>
                                <td>
                                <input type="text" class="form-control" value="<?php echo $inputs->title; ?>" name="<?php echo $A.$contador; ?>">
                                </td>
                                <td>
                                <input type="text" class="form-control" value="<?php echo $inputs->input_name; ?>" name="<?php echo $B.$contador; ?>">
                                </td>
                                <td>
                                <input type="text" class="form-control" value="<?php echo $inputs->input_type; ?>" name="<?php echo $C.$contador; ?>">
                                </td>
                                <td>
                                <span class="btn btn-success row_input2"><i class="icon-cancel-circle"></i>Remove</span>
                                </td>
                            </tr>
                            <?php
                        }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" value="<?php echo $contador; ?>" name="numero" id="numero">
                    <br>
                    <a href="#" id="guardar_reporte" class="btn btn-primary">Guardar</a>
                </div>
            </div>
        </form>
    </div>


</div>


        


