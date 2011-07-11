  <div class="caption" 
     style="background-color:<?php echo $caption_color; ?>;
        margin-top:      <?php echo $margin_bottom; ?>px;
        height: <?php echo $caption_height; ?>px;
        border-width: <?php echo $border_width; ?>px;
        border-color: <?php echo $hor_color; ?>;
        border-style: solid;
        border-bottom:000000; width:<?php echo $xdim; ?>px;">
     <div id="hor_caption" style="text-indent:6px">z</div>
     <div id="mouse"><span id="mouse_hor"></span></div>
     <img src="images/left_arrow.png" id="hor_backward" 
      style="top:2px; left:<?php echo ($xdim/2 - 35); ?>px;" height=80% />
     <span id="hor_number"  
      style="position:absolute; top:0px; left:<?php echo ($xdim/2 - 13); ?>px;"></span>
     <img src="images/right_arrow.png" id="hor_forward" 
      style="top:2px; left:<?php echo ($xdim/2 + 10); ?>px;" height=80% />
  </div>
  <div class="slice_container"
   style="width:  <?php echo $xdim; ?>px;
    height:       <?php echo $ydim; ?>px;
    border-width: <?php echo $border_width; ?>px;
    border-color: <?php echo $hor_color;  ?>;
    border-top:    000000;" >
    <div id="slice_hor">
      <img id="images_hor" src="<?php echo $path_montages.$ID.$montage_hor; ?>">
      <?php 
       if ($labels_montage) {
        echo '<span class="labels_hor">';
         echo '<img src="'.$path_montages.$ID.$montage_labels_hor.'" ';
         echo 'id="labels_hor" style="opacity:'.$opacity0.'">';
        echo '</span>';
       }
      ?>
    </div>
    <div id="mark">
     <div id="mark_hor"></div>
     <div id="mark_hor_ref"></div>
    </div>
  </div>
