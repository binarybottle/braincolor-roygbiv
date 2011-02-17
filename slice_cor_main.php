    <div class="slice_container"
     style="width:  <?php echo $xdim_main; ?>px;
     height:        <?php echo $zdim_main; ?>px;
     margin-right:  <?php echo $margin_right;  ?>px;
     border-width:  <?php echo $border_width;  ?>px;
     border-color:  <?php echo $cor_color; ?>;
     >
     <div id="slice_cor_main">
      <img id="images_cor_main" src="<?php echo $path_montages.$ID.$montage_cor_main; ?>">
      
      <?php 
      if ($labels_montage) {
        echo '<img src="'.$path_montages.$ID.$montage_labels_cor_main.'" ';
        echo 'id="labels_cor_main" style="opacity:'.$opacity0.'">';
      }
      ?>
     </div>
     <!-- Transparent image to map contours on top -->
     <img src="./images/blank_cor_512x512.png" class="map" usemap="#contour_map" border=0>
     <div id="contour_data"></div>
    </div>
