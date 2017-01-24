<div class="row col-lg-12 conten-productos">
    <?php
        if (!empty($producto)) 
        {
          foreach ($producto as $value) 
          {
          ?>
            
          <!--  Vista dinamica de prodcutos --> 
            <div class="col-md-4">
              <div class="thumbnail" style="height: 400px;">
                <img src="../../../assets/images/productos/<?php echo $value->image ?>" alt="...">
                <div class="caption" style="word-wrap: break-word;">
                  <h3><?php echo $value->nombre_producto ?></h3>
                  <p><?php echo $value->description_producto ?></p>
                  <p>
                    <a class="btn btn-primary  btn-sm associateBranch" style="margin-left: -9px;" role="button">Asociar
                    <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">

                    </a> 
                    <a class="btn btn-default  btn-sm viewDetalle" style="margin-left: -9px;" role="button">Detalle
                    <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>"></a>
                    <a class="btn btn-default  btn-sm deleteP" style="margin-left: -9px;" role="button">Eliminar
                      <input type="hidden" name="idProducto" class="idProducto" value="<?php echo $value->id_producto ?>">
                      <input type="hidden" name="ImageName" class="ImageName" value="<?php echo $value->image ?>">
                    </a>
                  </p>
                </div>
              </div>
            </div>
            <!--  Vista dinamica de prodcutos -->
          <?php
            }
        }
        else
        {
          echo '<div class="alert alert-danger" role="alert">No hay datos para mostrar :(</div>';
        }    
      ?> 

      </div> 