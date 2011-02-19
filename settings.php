  <?php 

  //------//
  // DATA //
  //------//
  // paths and file names for image montages
  $path_montages = 'montages/';
  $path_contours = 'contours/';
  $montage_cor = '_y_1x.jpg';
  $montage_sag = '_x_1x.jpg';
  $montage_hor = '_z_1x.jpg';
  $montage_cor_main = '_y_2x.jpg';
  $labels_montage = 1;
  if ($labels_montage) {
    $montage_labels_cor = '_glm_y.png';
    $montage_labels_sag = '_glm_x.png';
    $montage_labels_hor = '_glm_z.png';
    $montage_labels_cor_main = '_glm_y_2x.png';
  }

  //--------------//
  // PRESENTATION //
  //--------------//
  // individual slice presentation
  $border_width  = 2;    // slice border width
  $margin_right  = 2;    // margin between slices
  $margin_bottom = 2;    // margin between slices
  $sag_color = 'd24637'; // red
  $cor_color = '339311'; // green
  $hor_color = '0d72f6'; // blue 
  $nav_color = '#000000';  
  $caption_color = '000000';
  $opacity0      = 0.5; // initial opacity; NOTE: change functions.js value to 100*$opacity0
  // page offset
  $main_left      = 30;
  $main_top       = 200;
  $intro_top      = 140;
  $offsetX        = $main_left - 1;
  $offsetY        = $main_top;
  $caption_height = 15;
  $slider_top     = 60;
  $slider_width   = 75;

  //----------//
  // MONTAGES //
  //----------//
  // image dimensions used to construct montages
  if (empty($ID)) { 
    $ID = '1002';
  }
  echo '<script type="text/javascript">var contour_path = "./contours/'.$ID.'/";</script>';
  $table_name = 'images'; 
  $sql = 'SELECT * FROM '.$table_name. ' WHERE image_file="'.$ID.'"';
  $result = mysql_query($sql) or die (mysql_error());
  while($row = mysql_fetch_object($result)) {
    $xdim = $row->xdim;
    $ydim = $row->ydim;
    $zdim = $row->zdim;
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
  if (empty($sag0)) { $sag0  = round($xdim/2); } // initial sagittal slice
  if (empty($cor0)) { $cor0  = round($ydim/2); } // initial coronal slice
  if (empty($hor0)) { $hor0  = round($zdim/2); } // initial horizontal slice
  //if (empty($sag0)) { $sag0  = round($xdim-$PC_x); } // initial sagittal slice
  //if (empty($cor0)) { $cor0  = round($PC_y); } // initial coronal slice
  //if (empty($hor0)) { $hor0  = round($zdim-$PC_z); } // initial horizontal slice
  $xdim_main = $xdim * 2;
  $zdim_main = $zdim * 2;

  ?>
  <script type="text/javascript">
  //----------------------//
  // JavaScript variables //
  //----------------------// 
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
  var nimages_x = <?php echo ceil(sqrt($xdim)); ?>;
  var nimages_y = <?php echo ceil(sqrt($ydim)); ?>;
  var nimages_z = <?php echo ceil(sqrt($zdim)); ?>;
  // individual slice presentation
  var mark_slices = 1;
  var mark_all_slices = 1;
  var sag_color = 'd24637'; // red;   the following doesn't work: <!--?php echo $sag_color; ?-->;
  var cor_color = '339311'; // green; the following doesn't work: <!--?php echo $cor_color; ?-->;
  var hor_color = '0d72f6'; // blue;  the following doesn't work: <!--?php echo $hor_color; ?-->;
  // repeated from the php settings above
  var offsetX        = <?php echo $offsetX;        ?>;
  var offsetY        = <?php echo $offsetY;        ?>;
  var caption_height = <?php echo $caption_height; ?>;
  var margin_right   = <?php echo $margin_right;   ?>;
  var margin_bottom  = <?php echo $margin_bottom;  ?>;
  var border_width   = <?php echo $border_width;   ?>;
  var opacity0       = <?php echo (100*$opacity0); ?>;
  var labels_montage = <?php echo $labels_montage; ?>;
  // var contour_path   = <!--?php echo $path_contours.$ID.'/'; ?-->;
  </script>
