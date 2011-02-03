// (c) 2010 arno klein . arno@mindboggle.info . http://www.braincolor.org (MIT license)


// IMAGE MAP HIGHLIGHTS
$(function() {
  $('.map').maphilight();
});

// LOAD CONTOURS
function load_contours(elem, input_slice) {
  var url = contour_path + "slice" + input_slice + ".html";
  $(elem).load(url);
}

// LOAD LABEL NAMES
function load_label_names(elem, input_slice) {
  var url = contour_path + "slice" + input_slice + "_labellist.html";
  $(elem).load(url);
}

// MARK A SLICE
function mark_slice(show_elem, hide_elem1, hide_elem2, x1, y1, x2, y2, color1, color2) {
  $(show_elem).empty();
  $(show_elem).show();
  $(show_elem).drawPolygon([x1[0],x1[1]],[y1[0],y1[1]], {color:color1, stroke:1});
  $(show_elem).drawPolygon([x2[0],x2[1]],[y2[0],y2[1]], {color:color2, stroke:1});
  $(hide_elem1).hide();
  $(hide_elem2).hide();
}      

// MARK OTHER SLICES
function mark_other_slices(elem0,elem1,elem2,x1,y1,x2,y2,x3,y3,x4,y4,colors1,colors2) {
  $(elem0).empty();
  $(elem1).empty();
  $(elem2).empty();
  $(elem1).drawPolygon([x1[0],x1[1]],[y1[0],y1[1]],{color:colors1[0],stroke:1});
  $(elem1).drawPolygon([x2[0],x2[1]],[y2[0],y2[1]],{color:colors1[1],stroke:1});
  $(elem2).drawPolygon([x3[0],x3[1]],[y3[0],y3[1]],{color:colors2[0],stroke:1});
  $(elem2).drawPolygon([x4[0],x4[1]],[y4[0],y4[1]],{color:colors2[1],stroke:1});
}

// ERASE MARKS 
function mark_all_slices_erase() {
  $('#mark_cor').empty()
  $('#mark_sag').empty()
  $('#mark_hor').empty()
  $('#mark_cor_ref').empty()
  $('#mark_sag_ref').empty()
  $('#mark_hor_ref').empty()
}

// MARK ALL SLICES
function mark_all_slices_draw() {
  $('#mark_cor_ref').drawPolygon([0,xdim],[-hor,-hor],{color:hor_color,stroke:1})
  $('#mark_cor_ref').drawPolygon([sag,sag],[-zdim,0], {color:sag_color,stroke:1})
  $('#mark_sag_ref').drawPolygon([0,ydim],[-hor,-hor],{color:hor_color,stroke:1})
  $('#mark_sag_ref').drawPolygon([cor,cor],[-zdim,0], {color:cor_color,stroke:1})
  $('#mark_hor_ref').drawPolygon([0,xdim],[-cor,-cor],{color:cor_color,stroke:1})
  $('#mark_hor_ref').drawPolygon([sag,sag],[-ydim,0], {color:sag_color,stroke:1})
}

// CHANGE SLICE BY CLICKING ARROW ICONS
function click_arrow(elem,increment) {
  $(elem).click(function(e){
    if (elem == "#cor_forward" || elem == "#cor_backward") {
      $('#mark_cor').empty()
      cor = update_cor(cor + increment);  
    } else if (elem == "#sag_forward" || elem == "#sag_backward") {
      $('#mark_sag').empty()
      sag = update_sag(sag + increment);
    } else if (elem == "#hor_forward" || elem == "#hor_backward") {
      $('#mark_hor').empty()
      hor = update_hor(hor + increment);
    }
    if(mark_all_slices) {
      mark_all_slices_erase();
      mark_all_slices_draw();
    }
  });
}

// MOUSE COORDINATES
function mouse_slice(elem, show_elem, hide_elem1, hide_elem2, offsetX2, offsetY2) {
  $(elem).mousemove(function(e){
    var x = (e.pageX - this.offsetLeft- offsetX - offsetX2);
    if (elem == "#slice_hor") { var y = ydim - (e.pageY - this.offsetTop - offsetY - offsetY2);
    } else {  var y = zdim - (e.pageY - this.offsetTop - offsetY - offsetY2);
    }
    x2 = x;
    y2 = y;
    $(show_elem).show();
    $(show_elem).html(x2 +', '+ y2);
    $(hide_elem1).hide();
    $(hide_elem2).hide();
  });
}

// CLICK ON SLICES
function click_slice(elem, offsetX2, offsetY2, icor, isag, ihor) {
  $(elem).click(function(e){
    var x = (e.pageX - this.offsetLeft- offsetX - offsetX2);
    if (elem == "#slice_hor") { var y = ydim - (e.pageY - this.offsetTop - offsetY - offsetY2);
    } else {          var y = zdim - (e.pageY - this.offsetTop - offsetY - offsetY2);
    }
    x2 = x;
    y2 = y;
    var axisarray = [0,x2,y2];
    if (icor > 0) { cor = update_cor(axisarray[icor]); }
    if (isag > 0) { sag = update_sag(axisarray[isag]); }
    if (ihor > 0) { hor = update_hor(axisarray[ihor]); }

    if (mark_slices) {
      if (elem == "#slice_cor") {
        mark_slice("#mark_cor","#mark_sag","#mark_hor",
          [0,xdim],[-y,-y],[x,x],[-zdim,0],hor_color,sag_color);
        if (mark_all_slices) {
          mark_other_slices("#mark_cor_ref","#mark_sag_ref","#mark_hor_ref",
                    [0,ydim],[-y,-y],[cor,cor],[-zdim,0],
                    [0,xdim],[-cor,-cor],[x,x],[-ydim,0],
                    [hor_color,cor_color],
                    [cor_color,sag_color]);
        }
      }
      else if (elem == "#slice_sag") {
        mark_slice("#mark_sag","#mark_cor","#mark_hor",
          [0,ydim],[-y,-y],[x,x],[-ydim,0],hor_color,cor_color);
        if (mark_all_slices) {
          mark_other_slices("#mark_sag_ref","#mark_cor_ref","#mark_hor_ref",
                    [0,xdim],[-y,-y],[sag,sag],[-zdim,0],
                    [0,xdim],[-x,-x],[sag,sag],[-ydim,0],
                    [hor_color,sag_color],
                    [cor_color,sag_color]);
        }
      }
      else if (elem == "#slice_hor") {
        mark_slice("#mark_hor","#mark_cor","#mark_sag",
          [0,xdim],[-y,-y],[x,x],[-ydim,0],cor_color,sag_color);
        if (mark_all_slices) {
          mark_other_slices("#mark_hor_ref","#mark_cor_ref","#mark_sag_ref",
                    [0,xdim],[-hor,-hor],[x,x],[-zdim,0],
                    [0,ydim],[-hor,-hor],[y,y],[-zdim,0],
                    [hor_color,sag_color],
                    [hor_color,cor_color]);
        }
      }
    }
  })
} 

// SLIDER
$(function() {
  $("#slider").slider({
    orientation: "horizontal",
    range: "min",
    min: 0,
    max: 100,
    value: opacity0,
    slide: function(event, ui) {
      $("#opacity").val(ui.value);
      $('#labels_cor_main').css('opacity',$("#slider").slider("value") / 100);     
      $('#labels_cor').css('opacity',$("#slider").slider("value") / 100);     
      $('#labels_sag').css('opacity',$("#slider").slider("value") / 100);     
      $('#labels_hor').css('opacity',$("#slider").slider("value") / 100);     
    }
  });
  $("#opacity").val($("#slider").slider("value"));
});
