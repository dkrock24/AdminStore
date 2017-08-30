<?php

foreach ($catalogoMateriales as $row)
{
        $new_row['label']=htmlentities(stripslashes($row['nombre_producto']."-".$row['id_producto']));
        $new_row['value']=htmlentities(stripslashes($row['nombre_producto']."-".$row['id_producto']));
        $row_set[] = $new_row; //build an array
}
     
		echo json_encode(@$row_set);

?>