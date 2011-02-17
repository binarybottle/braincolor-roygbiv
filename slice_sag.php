  <div class="caption" 
     style="background-color:<?php echo $caption_color; ?>;
        height: <?php echo $caption_height; ?>px;
        border-width: <?php echo $border_width; ?>px;
        border-color: <?php echo $sag_color; ?>;
        border-style: solid;
        border: <?php echo $border_width; ?>px <?php echo $sag_color; ?> solid;
        border: <?php echo $border_width; ?>px <?php echo $sag_color; ?> solid;
        border-bottom:000000; width:<?php echo $ydim; ?>px;">
     <div id="sag_caption" style="text-indent:6px">x</div>
     <div id="mouse"><span id="mouse_sag"></span></div>
     <img src="images/left_arrow.png" id="sag_backward" 
      style="top:2px; left:<?php echo ($ydim/2 - 35); ?>px;" height=80% />
     <span id="sag_number"  
      style="position:absolute; top:0px; left:<?php echo ($ydim/2 - 13); ?>px;"></span>
     <img src="images/right_arrow.png" id="sag_forward" 
      style="top:2px; left:<?php echo ($ydim/2 + 10); ?>px;" height=80% />
  </div>
  <div class="slice_container"
   style="width:        <?php echo $ydim; ?>px;
    height:       <?php echo $zdim; ?>px;
    border-width: <?php echo $border_width;   ?>px;
    border-color: <?php echo $sag_color; ?>;
    border-top:    000000;" >
    <div id="slice_sag">
     <img id="images_sag" src="<?php echo $path_montages.$ID.$montage_sag; ?>">
     <?php 
      if ($labels_montage) {
        echo '<img src="'.$path_montages.$ID.$montage_labels_sag.'" ';
        echo 'id="labels_sag" style="opacity:'.$opacity0.'">';
      }
     ?>
    </div>
    <div id="mark">
     <div id="mark_sag"></div>
     <div id="mark_sag_ref"></div>
    </div>
  </div>
