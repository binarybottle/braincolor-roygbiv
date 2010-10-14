	<div class="caption"
		 style="background-color:<?php echo $caption_color; ?>;
				height: <?php echo $caption_height; ?>px;
				border-width: <?php echo $border_width; ?>px;
				border-color: <?php echo $cor_color; ?>;
				border-style: solid;
				border-bottom:000000; width:<?php echo $xdim; ?>px;">
  	 <div class="cor_caption" style="text-indent:6px">coronal</div>
  	 <div id="mouse"><span id="mouse_cor"></span></div>
     <img src="images/left_arrow.png" id="cor_backward" 
		  style="top:2px; left:<?php echo ($xdim/2 - 40); ?>px;" height=80% />
     <span id="cor_number"  
		  style="position:absolute; top:0px; left:<?php echo ($xdim/2 - 13); ?>px;"></span>
     <img src="images/right_arrow.png" id="cor_forward" 
		  style="top:2px; left:<?php echo ($xdim/2 + 20); ?>px;" height=80% />
	</div>
	<div class="slice_container"
		 style="width:         <?php echo $xdim; ?>px;
				height:        <?php echo $zdim; ?>px;
				margin-right:  <?php echo $margin_right; ?>px;
				border-width:  <?php echo $border_width; ?>px;
				border-color:  <?php echo $cor_color; ?>;
				border-top:    000000;" >
     <div id="slice_cor">
      <img id="images_cor" src="<?php echo $path_montages.$ID.$montage_cor; ?>">
      <?php 
		if ($labels_montage) {
			echo '<img src="'.$path_montages.$ID.$montage_labels_cor.'" ';
			echo 'id="labels_cor" style="opacity:'.$opacity0.'">';
		}
      ?>
     </div>
     <div id="mark">
      <div id="mark_cor"></div>
      <div id="mark_cor_ref"></div>
     </div>
    </div>
	</div>
