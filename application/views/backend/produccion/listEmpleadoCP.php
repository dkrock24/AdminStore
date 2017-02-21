<?php
   session_start()
?>
<script type="text/javascript">
  //----------------go to add proveedores---------------
    $(".backCP").click(function()
    {
      $(".pages").load("../produccion/Cproduccion/index"); 
    });
</script>
<button type="button" style="float:right;background-color: #c75757;" class="btn btn-success backCP">Regresar</button>
<h1>Lista de empleados</h1>
 <table class="table table-hover table-dynamic filter-head">
                <thead class='titulos'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>                        
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>DUI</th>                                                
                        <td width="20%">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                <?php
                      foreach ($empleados as $value) 
                      {
                      ?>
                    <tr>
                        <td><?php echo $value->nombres;  ?></td>
                        <td><?php echo $value->apellidos;  ?></td>
                        <td><?php echo $value->celular;  ?></td>
                        <td><?php echo $value->direccion;  ?></td>
                        <td><?php echo $value->dui;  ?></td>                         
                        <td>
                          <button type="button" class="btn btn-primary btn-primary btn-sm viewDataM">
                            <input type="hidden" name="idCProduccion" class="idCProduccion" value="<?php echo $value->id_usuario ?>">Eliminar
                          </button>
                          <button type="button" class="btn btn-primary btn-sm viewDataM">
                            <input type="hidden" name="idCProduccion" class="idCProduccion" value="<?php echo $value->id_usuario ?>">Ver
                          </button>
                        </td>
                    </tr>        
                 <!--  Vista dinamica de prodcutos -->
          <?php
            }
      ?> 
                   
    </tbody>   
    </table>        