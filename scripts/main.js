// (c) 2010 arno klein . arno@mindboggle.info . http://www.braincolor.org (MIT license)

$(document).ready(function() {

  // INITIALIZE
  images_cor = document.getElementById("images_cor");
  images_sag = document.getElementById("images_sag");
  images_hor = document.getElementById("images_hor");

  if (labels_montage) {
    labels_cor = document.getElementById("labels_cor");
    labels_sag = document.getElementById("labels_sag");
    labels_hor = document.getElementById("labels_hor");
  } 

  // Initial update of slices
  cor = update_cor(cor0);
  sag = update_sag(sag0);
  hor = update_hor(hor0);

  // MARK ALL SLICES
  if (mark_all_slices) {
    mark_all_slices_draw();
  }

  // MOUSE CLICKS and MOUSE COORDINATES
  var offsetMain = 2*border_width + xdim_main + margin_right;
  var offsetX2 = offsetMain + border_width;
  var offsetY2 = caption_height + border_width;
  click_slice("#slice_cor", offsetX2, offsetY2, 0, 1, 2);
  mouse_slice("#slice_cor","#mouse_cor","#mouse_sag","#mouse_hor",offsetX2,offsetY2);
  var offsetX2 = offsetMain + 3*border_width + xdim + margin_right;
  var offsetY2 = caption_height + border_width;
  click_slice("#slice_sag", offsetX2, offsetY2, 1, 0, 2);
  mouse_slice("#slice_sag","#mouse_sag","#mouse_cor","#mouse_hor",offsetX2,offsetY2);
  var offsetX2 = offsetMain + border_width;
  var offsetY2 = 2*caption_height + 3*border_width + zdim + margin_bottom;
  click_slice("#slice_hor", offsetX2, offsetY2, 2, 1, 0);
  mouse_slice("#slice_hor","#mouse_hor","#mouse_cor","#mouse_sag",offsetX2,offsetY2);

  // ARROW ICON CLICKS
  click_arrow("#cor_backward",-1);
  click_arrow("#cor_forward",1);
  click_arrow("#sag_backward",-1);
  click_arrow("#sag_forward",1);
  click_arrow("#hor_backward",-1);
  click_arrow("#hor_forward",1);

});

// KEY PRESSES
$(document).keypress(function (e) {

  // 49  1 = coronal backward
  if (e.keyCode == 49 || e.charCode == 49){
    cor = update_cor(cor - 1);  
  }
  // 50  2 = coronal forward
  if (e.keyCode == 50 || e.charCode == 50){
    cor = update_cor(cor + 1);  
  }
  // 51  3 = sagittal backward
  if (e.keyCode == 51 || e.charCode == 51){
    sag = update_sag(sag - 1);    
  }
  // 52  4 = sagittal forward
  if (e.keyCode == 52 || e.charCode == 52){
    sag = update_sag(sag + 1);    
  }
  // 53  5 = horizontal backward
  if (e.keyCode == 53 || e.charCode == 53){
    hor = update_hor(hor - 1);    
  }
  // 54  6 = horizontal forward
  if (e.keyCode == 54 || e.charCode == 54){
    hor = update_hor(hor + 1);    
  }   
  if (mark_all_slices) {
    if (e.keyCode == 49 || e.charCode == 49 || e.keyCode == 50 || e.charCode == 50 ||
      e.keyCode == 51 || e.charCode == 51 || e.keyCode == 52 || e.charCode == 52 ||
      e.keyCode == 53 || e.charCode == 53 || e.keyCode == 54 || e.charCode == 54) {
      mark_all_slices_erase();      
      mark_all_slices_draw();     
    }
  }
});
