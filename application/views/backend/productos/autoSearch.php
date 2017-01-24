<?php

foreach ($catalogoMateriales as $row)
{
        $new_row['label']=htmlentities(stripslashes($row['nombre_matarial']."-".$row['codigo_material']));
        $new_row['value']=htmlentities(stripslashes($row['nombre_matarial']."-".$row['codigo_material']));
        $row_set[] = $new_row; //build an array
}
     
		echo json_encode($row_set);

?>