<?php
    if(isset($_SESSION['usuario_1'])){
        header('Location: '.'user-lockscreen.php');
    }
    

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>LA PIZZERIA</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <link rel="shortcut icon" href="../../../assets/img/favicon.png">

        <?php
            foreach ($lib_login as $value) {            	
                ?>
                <link rel="stylesheet" type="text/css" href="../../../<?php echo $value->url_libreria; ?>">
                <?php
        }

        ?>
    </head>
    <style>
    .logo{
        background: none;
        text-align: center;
        position: relative;
        display: inline-block;
        margin-top: 70px;
    }
    </style>
    <body class="account" data-page="login">
        <!-- BEGIN LOGIN BOX -->
        <div class="container" id="login-block">
        <div class="row">
            <div class="col-sm-12 ">
                <h2 class="titulo1">...: <b>ADMINISTRACION</b> :...</h2>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <div class="account-wall">
                        <i class="user-img icons-faces-users-03"></i>
                        <?php
                        foreach ($empresa as $value) {
                            ?>
                            <img class="user-img logo" src="../../../assets/images/avatars/<?php echo $value->logo_empresa; ?>">
                            <?php
                        }
                        ?>
                        <br>
                        <br>
                        <br>
                        
                        <form class="form-signin" role="form"  method="post" action="autenticacion">
                            <div class="append-icon">
                                <input type="text" name="usuario" id="usuario" class="form-control form-white username" placeholder="Usuario" required>
                                <i class="icon-user"></i>
                            </div>
                            <div class="append-icon">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Password" required>
                                <i class="icon-lock"></i>
                            </div>
                            <br>


                            <input type="submit" value="Login" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">


                            <!--
                            <button type="submit" id="submit-form" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Entrar</button> -->
                            
                            <div class="clearfix">
                            <!--
                                <p class="pull-left m-t-20"><a id="password" href="#">Olvidates Tu Password</a></p>
                            -->
                            </div>
                        </form>
                        <form class="form-password" role="form">
                            <div class="append-icon m-b-20">
                                <input type="password" name="password" class="form-control form-white password" placeholder="Introduce Tu Usuario" required>
                                <i class="icon-lock"></i>
                            </div>
                            <button type="submit" id="submit-password" class="btn btn-lg btn-danger btn-block ladda-button" data-style="expand-left">Notificar al Administrador</button>
                            <div class="clearfix">
                                <p class="pull-left m-t-20"><a id="login" href="#">Regresar</a></p>
                                <p class="pull-right m-t-20"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <p class="account-copyright">
                <span>Copyright © 2018 </span><span>KAPRICHOS FLORISTERIA - SISTEM ADMINISTRATIVO.</span>
            </p>

                    <div class="row">
                        <?php
                        if($config!=null)
                        {
                            foreach ($config as $value) {
                        
                        ?>
                    <input type="checkbox" id="slide-cb" class="switch-input" checked="<?php echo $value->accion; ?>">
                        <?php
                        }
                        }?>                      

                    </div>
        </div>
        <script src="../../../assets/plugins/jquery/jquery-1.11.1.min.js"></script>      
        <script src="../../../assets/plugins/backstretch/backstretch.min.js"></script>        
        <script src="../../../assets/js/pages/login-v1.js"></script>
    </body>
</html>