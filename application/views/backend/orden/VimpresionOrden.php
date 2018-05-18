<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Cupones</title>
</head>
<link rel="stylesheet" type="text/css" href="../../../../../assets/images/print.css" media="print">
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
    
    .table{
      padding: 10px;

    }
    .bloc{
      width:341px;
      height: 510px;
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
        background-color: orange;
        -webkit-user-select: none;
        -moz-user-select: none;
        -o-user-select: none;
        -ms-user-select: none;
        -khtml-user-select: none;     
        user-select: none;
    }

</style>


<script>

    $(document).ready(function(){
        var option = {trigger : $("#editar"), action : "click"};
        $(".demo").editable(option, function(e){
            alert(e.text);
        });
    });

            var mydragg = function(){
                return {
                    move : function(divid,xpos,ypos){
                        //divid.style.left = xpos + 'px';
                        divid.style.top = ypos + 'px';
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
                    <div id="elem" onmousedown='mydragg.startMoving(this,"container",event);' onmouseup='mydragg.stopMoving("container");' style="width: 100%;height: 100px;">
                        <div style='padding:10px' class="demo">
                            <?php echo $orden[0]->dedicatoria; ?>    
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>


 



    <a href="javascript:window.print()" class="btn btn-primary" id="imprimir_orden">Imprimir</a>
    <a href="#" class="btn btn-primary" id="editar">Editar</a>
</body>
</html>

