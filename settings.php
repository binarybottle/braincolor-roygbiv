  <?php 
  // image montages
  $path_montages = 'montages/';
  $path_contours = 'contours/';
  $montage_cor = '_axis2_1x.jpg';
  $montage_sag = '_axis1_1x.jpg';
  $montage_hor = '_axis3_1x.jpg';
  $montage_cor_main = '_axis2_2x.jpg';
  $labels_montage = 1;
  if ($labels_montage) {
    $montage_labels_cor = '_labels_colors_axis2.png';
    $montage_labels_sag = '_labels_colors_axis1.png';
    $montage_labels_hor = '_labels_colors_axis3.png';
    $montage_labels_cor_main = '_labels_colors_axis2_2x.png';
  }

  // image dimensions used to construct montages
  if (empty($ID)) { 
    include_once "../../db/roygbiv_db.php";
    $table_name = 'images'; 
    $ID = '1013_3';
    $sql = 'SELECT * FROM '.$table_name. ' WHERE image_file="'.$ID.'"';
    $result = mysql_query($sql) or die (mysql_error());
    while($row = mysql_fetch_object($result)) {
      $min_crop_x = $row->min_crop_x;
      $min_crop_y = $row->min_crop_y;
      $min_crop_z = $row->min_crop_z;
      $max_crop_x = $row->max_crop_x;
      $max_crop_y = $row->max_crop_y;
      $max_crop_z = $row->max_crop_z;
      //$AC_x = round($row->AC_x);
      //$AC_y = round($row->AC_y);
      //$AC_z = round($row->AC_z);
    }
    $xdim = 256; 
    $ydim = 256; //302; 
    $zdim = 256;
    if (empty($sag0)) { $sag0  = round($xdim/2); } // initial sagittal slice
    if (empty($cor0)) { $cor0  = round($ydim/2); } // initial coronal slice
    if (empty($hor0)) { $hor0  = round($zdim/2); } // initial horizontal slice
    //if (empty($sag0)) { $sag0  = round($xdim-$PC_x); } // initial sagittal slice
    //if (empty($cor0)) { $cor0  = round($PC_y); } // initial coronal slice
    //if (empty($hor0)) { $hor0  = round($zdim-$PC_z); } // initial horizontal slice
  }
  $xdim_main = $xdim * 2;
  $zdim_main = $zdim * 2;

  // individual slice presentation
  $border_width  = 3;    // slice border width
  $margin_right  = 3;    // margin between slices
  $margin_bottom = 3;    // margin between slices
  $sag_color = 'd24637'; // red
  $cor_color = '339311'; // green
  $hor_color = '0d72f6'; // blue 
  $nav_color = '#000000';  
  $caption_color = '000000';
  $opacity0      = 0.75; // initial opacity
  // page offset
  $main_left      = 30;
  $main_top       = 220;
  $intro_top      = 140;
  $offsetX        = $main_left - 1;
  $offsetY        = $main_top;
  $caption_height = 15;
  $slider_top     = 60;
  ?>
  
  <script type="text/javascript">
  var contour_path = 'contours/1013_3/'; //<!--?php echo $path_contours.$ID.'/'; ?-->;
  // image dimensions (from php variables above)
  var xdim_main = <?php echo $xdim_main; ?>; 
  var zdim_main = <?php echo $zdim_main; ?>; 
  var xdim  = <?php echo $xdim; ?>;
  var ydim  = <?php echo $ydim; ?>;
  var zdim  = <?php echo $zdim; ?>;
  var cor0  = <?php echo $cor0; ?>; // initial coronal slice
  var sag0  = <?php echo $sag0; ?>; // initial sagittal slice
  var hor0  = <?php echo $hor0; ?>; // initial horizontal slice
  // number of images along the edge of the montage for each axis
  var nimages_x_montagedim1 = 16;
  var nimages_x_montagedim2 = 16;
  var nimages_y_montagedim1 = 16;
  var nimages_y_montagedim2 = 16;
  var nimages_z_montagedim1 = 16;
  var nimages_z_montagedim2 = 16;
  var labels_montage = <?php echo $labels_montage; ?>;
  // individual slice presentation
  var mark_slices = 1;
  var mark_all_slices = 1;
  var sag_color = 'd24637'; // red;   the following doesn't work: <!--?php echo $sag_color; ?-->;
  var cor_color = '339311'; // green; the following doesn't work: <!--?php echo $cor_color; ?-->;
  var hor_color = '0d72f6'; // blue;  the following doesn't work: <!--?php echo $hor_color; ?-->;
  var show_mouse_coordinates = 1;    
  // repeated from the php settings above
  var offsetX        = <?php echo $offsetX;        ?>; 
  var offsetY        = <?php echo $offsetY;        ?>;
  var caption_height = <?php echo $caption_height; ?>; 
  var margin_right   = <?php echo $margin_right;   ?>;
  var margin_bottom  = <?php echo $margin_bottom;  ?>;
  var border_width   = <?php echo $border_width;   ?>;
  var opacity0       = <?php echo (100*$opacity0); ?>; 
  </script>
