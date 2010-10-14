    <div class="caption" 
     style="background-color:<?php echo $caption_color; ?>;
     height: <?php echo $caption_height; ?>px;
     border-width: <?php echo $border_width; ?>px;
     border-color: <?php echo $cor_color; ?>;
     border-style: solid;
     border-bottom:000000; width:<?php echo $xdim_main; ?>px;">
     <div id="cor_main_caption" style="text-indent:6px"><b>Move mouse/cursor over regions to see text labels</b> &nbsp;&nbsp;(brain <?php echo $ID; ?>)
     </div>
    </div>
    <div class="slice_container"
     style="width:  <?php echo $xdim_main; ?>px;
     height:        <?php echo $zdim_main; ?>px;
     margin-right:  <?php echo $margin_right;  ?>px;
     border-width:  <?php echo $border_width;  ?>px;
     border-color:  <?php echo $cor_color; ?>;
     border-top:    000000;" >
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
     <img src="data/contours_cor/blank_cor_512x512.png" class="map" usemap="#contour_map" border=0>
     <div id="contour_data"></div>
    </div>
