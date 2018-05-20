<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html>
<head>
    <title>Impresion Tarjeta</title>
</head>
<link rel="stylesheet" type="text/css" href="../../../../../assets/images/print.css" media="print">
<link rel="stylesheet" type="text/css" href="../../../../../assets/css/icons/font-awesome/font-awesome.css">
<script src="../../../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>  

<script src="../../../../../assets/js/jquery.editable.js"></script> 
<script src="../../../../../assets/js/jquery.editable.min.js"></script>  


<style type="text/css" media="print">
@media print {
    body {-webkit-print-color-adjust: exact; }
    .bloc{
        background:url(../../../../../assets/images/imagen_cupon.jpg) no-repeat ;
        background-size: 340.15px 188.9px;
    }
    .titulo{
        float: left;
        position: relative;
        margin-top: 80px;
        font-size: 135px;
    }
    .codigo{
    display: inline-block;
    position: absolute;
    float: right;
    margin-left: 25%; 
    margin-top: 11%;
    transform: rotate(-20deg);
    font-size: 11px;
    }

}
@page {
    margin: 0;
    -webkit-print-color-adjust: exact;    
    background:url(../../../../../assets/images/imagen_cupon.jpg) no-repeat ;
    background-size: 340.15px 188.9px;

}


</style>

<style type="text/css">

        @font-face {
            font-family: 'oswald';
            src: url('../../../../../assets/EdwardianScriptITC.ttf');
        }
    
    .table{
      padding: 10px;

    }
    .bloc{
      width:341px;
      height: 510px;
      overflow: hidden;
      position: relative;
      border:dashed;
      display: inline-block;  
      background: url("../../../../../assets/images/imagen_cupon.jpg") no-repeat; 
      background-size: 340.15px 188.9px;
    }
    .banda{
      width: 290px;
      height: 100%;
      background: grey;
      display: inline-block;
      padding: 5px;
      margin: 10px;
      margin-top:0px;
      margin: 0 auto;
    }

    #container {
        position:absolute;
        background-color: none;
    }

    #elem{
        width: 100%;
        position: absolute;
        background-color: #FFFF00;
        -webkit-user-select: none;
        -moz-user-select: none;
        -o-user-select: none;
        -ms-user-select: none;
        -khtml-user-select: none;     
        user-select: none;
    }

    .demo{
        font-family: oswald;
        font-size: 20px;   
        font-weight: 10px;
        
    }
    .action{
        float: right;
        background: none;
        display: inline-block ;
        position: absolute;
        margin-top: 0px;
        top: 0px;
        margin-left: 60%;
        padding: 1%;
    }

</style>


<script>

    $(document).ready(function(){
        //var option = {trigger : $("#editar"), action : "click" , type:"text"};
        //$(".demo").editable(option, function(e){
        //});

        
        $("#tarjeta").change(function(){

            if($(this).val() == 2){

                // Impresion Modo Tarjeta Regalo

                $(".action").css("margin-top","300");            
                $(".bloc").css("width","566");
                $(".bloc").css("height","377");
            }
            else
            {
                // Impresion Modo Tarjeta Condolencia

                $(".action").css("margin-top","0");            
                $(".bloc").css("width","341");
                $(".bloc").css("height","510");
                $("#elem").css("left","0");
            }            

        });

        var fontSize = 20;
        $("#imprimir_orden").click(function(){
            $(".bloc").css("border","none");
        });

        $("#zoomOut").click(function(){
            fontSize+=2;
            $('.demo').animate({ 'font-size' : fontSize+'px' });
        });

        $("#zoomIn").click(function(){
            fontSize-=2;
            $('.demo').animate({ 'font-size' : fontSize+'px' });
        });


        $('#editar').click(function() {
            $('.demo').css("color", "black");
            //$('.demo').focus();
            $(".bloc").css("border","dashed");

            var option = {trigger : $("#editar")};
            $('.demo').editable(option, function(e){
                $('.demo').focus();
                
            });
            
        });


    });

            var mydragg = function(){
                return {
                    move : function(divid,xpos,ypos){

                        var tipoTarjeta = $("#tarjeta").val();

                        if( tipoTarjeta == 2){
                            divid.style.left = xpos + 'px';
                            $("#container").css('width',510);
                            $("#container").css('height',341);

                        }else{
                            divid.style.left = xpos + 'px';
                            $("#container").css('width',341);
                            $("#container").css('height',510);
                            $(".elem").css("left","0");
                        }
                        
                        divid.style.top = ypos + 'px';
                        var total = ( ypos / 510  ) * 100;
                                                
                        $(".posicion").text( total.toFixed(2)  +" %");
                    },
                    startMoving : function(divid,container,evt){
                        
                        evt = evt || window.event;
                        var posX = evt.clientX,
                            posY = evt.clientY,
                        divTop = divid.style.top,
                        divLeft = divid.style.left,
                        eWi = parseInt(divid.style.width),
                        eHe = parseInt(divid.style.height),
                        cWi = parseInt(document.getElementById(container).style.width),
                        cHe = parseInt(document.getElementById(container).style.height);
                        document.getElementById(container).style.cursor='move';
                        divTop = divTop.replace('px','');
                        divLeft = divLeft.replace('px','');
                        var diffX = posX - divLeft,
                            diffY = posY - divTop;                            

                        document.onmousemove = function(evt){
                            evt = evt || window.event;
                            var posX = evt.clientX,
                                posY = evt.clientY,
                                aX = posX - diffX,
                                aY = posY - diffY;
                                if (aX < 0) aX = 0;
                                if (aY < 0) aY = 0;
                                if (aX + eWi > cWi) aX = cWi - eWi;
                                if (aY + eHe > cHe) aY = cHe -eHe;
                            mydragg.move(divid,aX,aY);

                        }
                    },
                    stopMoving : function(container){
                        var a = document.createElement('script');
                        document.getElementById(container).style.cursor='default';
                        document.onmousemove = function(){}
                    },
                }
            }();
</script>



<body>

    <div class="table">
        <div class="bloc">
            <div class="content" id="content">                      
                <div id='container' style="width: 341px;height: 510px;">     
                    <div id="elem" onmousedown='mydragg.startMoving(this,"container",event);' onmouseup='mydragg.stopMoving("container");' style="width: 100%;height: 100%;">
                        <div style='padding:2px' class="demo">
                            
                                <?php echo $orden[0]->dedicatoria; ?>      
                                                          
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <div class="action">
        <fieldset>  
            <legend>    Controles de Impresión</legend>
            <a href="javascript:window.print()" class="btn btn-primary" id="imprimir_orden"><i class="fa fa-print"> </i> Imprimir</a>
        <a href="#" class="btn btn-primary" id="editar"> <i class="fa fa-edit"> </i> Editar</a>
        <a href="#" class="btn btn-primary" id="zoomOut"> <i class="fa fa-search-plus"> </i> Zoom </a>
        <a href="#" class="btn btn-primary" id="zoomIn"> <i class="fa fa-search-minus"> </i> Zoom </a>
        </fieldset>
        
        <hr>

        <fieldset>  
            <legend>    Controles de Posición</legend>
            <div class="Valores">
                
                <button type="button" class="btn btn-primary">
                    Posición <span class="badge badge-light"><span class="posicion"></span></span>
                </button>

                <span>
                <select class="form-control" style="width:200px; display: inline-block;" id="tarjeta">
                    <option value="1">Tarjeta de Regalo</option>
                    <option value="2">Tarjeta de Condolencia</option>
                </select>
            </span>

            </div>
            
        </fieldset>



        
    </div>
    
</body>
</html>

