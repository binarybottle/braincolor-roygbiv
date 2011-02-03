// (c) 2010 arno klein . arno@mindboggle.info . http://www.braincolor.org (MIT license)

function update_cor(visible_cor) {
  if (visible_cor > 0) {
    var moveLeft =             visible_cor % nimages_y_montagedim1;
    var moveTop  = Math.floor( visible_cor / nimages_y_montagedim1 );
    images_cor.style.left = (-moveLeft * xdim) + "px";
    images_cor.style.top  = (-moveTop  * zdim) + "px";  
    images_cor_main.style.left = (-moveLeft * xdim_main) + "px";
    images_cor_main.style.top  = (-moveTop  * zdim_main) + "px";  
    if (labels_montage) { 
      labels_cor.style.left = (-moveLeft * xdim) + "px";
      labels_cor.style.top  = (-moveTop  * zdim) + "px";
      labels_cor_main.style.left = (-moveLeft * xdim_main) + "px";
      labels_cor_main.style.top  = (-moveTop  * zdim_main) + "px";
    }
    cor_number = document.getElementById("cor_number");
    cor_number.innerHTML = visible_cor;
    load_contours("#contour_data", visible_cor);
    load_label_names("#label_names", visible_cor);
    return visible_cor;
  } 
}

function update_sag(visible_sag) {
  if (visible_sag > 0) {
    var moveLeft =             visible_sag % nimages_x_montagedim1;
    var moveTop  = Math.floor( visible_sag / nimages_x_montagedim1 );
    images_sag.style.left = (-moveLeft * ydim) + "px";
    images_sag.style.top  = (-moveTop  * zdim) + "px";  
    if (labels_montage) { 
      labels_sag.style.left = (-moveLeft * ydim) + "px";
      labels_sag.style.top  = (-moveTop  * zdim) + "px";
    } 
    sag_number = document.getElementById("sag_number");
    sag_number.innerHTML = visible_sag;
    return visible_sag;
  }
} 

function update_hor(visible_hor) {
  if (visible_hor > 0) {
    var moveLeft =             visible_hor % nimages_z_montagedim1;
    var moveTop  = Math.floor( visible_hor / nimages_z_montagedim1 );
    images_hor.style.left = (-moveLeft * xdim) + "px";
    images_hor.style.top  = (-moveTop  * ydim) + "px";  
    if (labels_montage) { 
      labels_hor.style.left = (-moveLeft * xdim) + "px";
      labels_hor.style.top  = (-moveTop  * ydim) + "px";
    } 
    hor_number = document.getElementById("hor_number");
    hor_number.innerHTML = visible_hor;
    return visible_hor;
  } 
}
