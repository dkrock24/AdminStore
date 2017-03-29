session_start();
 include_once("../class_db/class_menus.php");
            <!-- *** HOMEPAGE CAROUSEL *** -->
            <div class="home-carousel">
                <div class="dark-mask"></div>
                    <div class="container">
                        <div class="homepage owl-carousel">
                        <?php
                        foreach ($carrusel as $item) {
                        ?>
                        <div class="item">
                            <div class="row">
                                <div class="col-sm-5 right">
                                    <p>
                                        <img src="../../../../asset_/img/<?php echo $item->imagen; ?>.png" alt="">
                                    </p>
                                    <h1><?php echo $item->titulo; ?></h1>
                                    <p><?php echo $item->descripcion; ?></p>
                                </div>
                                <div class="col-sm-7">
                                    <img class="img-responsive" src="../../../../asset_/img/<?php echo $item->pie; ?>.png" alt="">
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <!-- /.project owl-slider -->
                </div>
            </div>
            <!-- *** HOMEPAGE CAROUSEL END *** -->