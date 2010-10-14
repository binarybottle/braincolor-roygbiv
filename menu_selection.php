<?php
 $sql = 'SELECT * FROM '.$table_name. ' WHERE image_file="'.$ID.'"';
 $result = mysql_query($sql) or die (mysql_error());
 while($row = mysql_fetch_object($result)) {
   $min_crop_x = $row->min_crop_x;
   $min_crop_y = $row->min_crop_y;
   $min_crop_z = $row->min_crop_z;
   $max_crop_x = $row->max_crop_x;
   $max_crop_y = $row->max_crop_y;
   $max_crop_z = $row->max_crop_z;
   /*
   $midsagittal_x = $row->midsagittal_x;
   $midsagittal_y = $row->midsagittal_y;
   $midsagittal_z = $row->midsagittal_z;
   $AC_x = $row->AC_x;
   $AC_y = $row->AC_y;
   $AC_z = $row->AC_z;
   $PC_x = $row->PC_x;
   $PC_y = $row->PC_y;
   $PC_z = $row->PC_z;
   */
 }
?>
