var trackedBox = null;
/* number of slices along each dimension */
var slice_num_x = 0;
var slice_num_y = 0;
var slice_num_z = 0;
/* crosshair position */
var crosshair_x = 0;
var crosshair_y = 0;
var crosshair_z = 0;
/* number of columns in slice montages */
var cor_columns = 16;
var sag_columns = 16;
var tra_columns = 14;

/* set things up */
function initSpeck(snx, sny, snz) {
	slice_num_x = snx;
	slice_num_y = sny;
	slice_num_z = snz;
	/* get useful elements */
	cor_box = document.getElementById("cor_box");
	sag_box = document.getElementById("sag_box");
	tra_box = document.getElementById("tra_box");
	cor_v_line = document.getElementById("cor_v_line");
	cor_h_line = document.getElementById("cor_h_line");
	sag_v_line = document.getElementById("sag_v_line");
	sag_h_line = document.getElementById("sag_h_line");
	tra_v_line = document.getElementById("tra_v_line");
	tra_h_line = document.getElementById("tra_h_line");
	cor_slices = document.getElementById("cor_slices");
	sag_slices = document.getElementById("sag_slices");
	tra_slices = document.getElementById("tra_slices");
	info = document.getElementById("info");
	/* init document mouse handlers */
	document.onmouseup = mouseUp;
	document.onmousemove = mouseMove;
	/* init view/crosshair mouse handlers */
	cor_box.onmousedown = function(ev) { trackedBox = this; mouseMove(ev); }
	cor_v_line.onmousedown = function(ev) { trackedBox = cor_box; mouseMove(ev); }
	cor_h_line.onmousedown = function(ev) { trackedBox = cor_box; mouseMove(ev); }
	sag_box.onmousedown = function(ev) { trackedBox = this; mouseMove(ev); }
	sag_v_line.onmousedown = function(ev) { trackedBox = sag_box; mouseMove(ev); }
	sag_h_line.onmousedown = function(ev) { trackedBox = sag_box; mouseMove(ev); }
	tra_box.onmousedown = function(ev) { trackedBox = this; mouseMove(ev); }
	tra_v_line.onmousedown = function(ev) { trackedBox = tra_box; mouseMove(ev); }
	tra_h_line.onmousedown = function(ev) { trackedBox = tra_box; mouseMove(ev); }
	/* init mouse wheel handlers */
	if (cor_box.addEventListener) {
		cor_box.addEventListener('DOMMouseScroll', mouseWheelSpin, false);
		cor_box.addEventListener('mousewheel', mouseWheelSpin, false);
		sag_box.addEventListener('DOMMouseScroll', mouseWheelSpin, false);
		sag_box.addEventListener('mousewheel', mouseWheelSpin, false);
		tra_box.addEventListener('DOMMouseScroll', mouseWheelSpin, false);
		tra_box.addEventListener('mousewheel', mouseWheelSpin, false);
	} else {
		cor_box.onmousewheel = mouseWheelSpin;
		sag_box.onmousewheel = mouseWheelSpin;
		tra_box.onmousewheel = mouseWheelSpin;
	}
	/* block mouse events to the slice images */
	cor_slices.onmousedown = eventStopper;
	sag_slices.onmousedown = eventStopper;
	tra_slices.onmousedown = eventStopper;
}

/* this function prevents an event from triggering the browser default action, e.g. dragging images */
function eventStopper(ev) {
	if (ev.preventDefault)
		ev.preventDefault();
	ev.returnValue = false;
}

/* handle mouse wheel spin events */
function mouseWheelSpin(e) {
	var nDelta = 0;
	if (!e) {
		// for explorer, access the global (window) event object
		e = window.event;
	}
	target = e.target || e.srcElement;
	// cross-bowser handling of eventdata to boil-down delta (+1 or -1)
	if (e.wheelDelta) {
		// explorer and opera
		nDelta = e.wheelDelta;
		if (window.opera) {
			// opera has the values reversed
			nDelta = -nDelta;
		}
	} else if (e.detail) {
		// fireFox
		nDelta = -e.detail;
	}
	if (nDelta > 0) {
		delta = 1;
	} else if (nDelta < 0) {
		delta = -1;
	}
	if (delta != 0) {
		if (target.id == "cor_slices") {
			crosshair_y += delta;
			updateView();
		} else if (target.id == "sag_slices") {
			crosshair_x += delta;
			updateView();
		} else if (target.id == "tra_slices") {
			crosshair_z += delta;
			updateView();
		}
	}
	// prevent default action
	if (e.preventDefault) {
		e.preventDefault();
	}
	e.returnValue = false;
}

function mouseUp(ev) {
	/* stop dragging */
	trackedBox = null;
}

function mouseMove(ev) {
	if (trackedBox != null) {
		/* set 3D volume coords from 2D mouse coords */
		coords = getMouseOffset(trackedBox, ev);
		if (trackedBox == cor_box) {
			crosshair_x = coords["x"];
			crosshair_z = coords["y"];
		} else if (trackedBox == sag_box) {
			crosshair_y = coords["x"];
			crosshair_z = coords["y"];
		} else if (trackedBox == tra_box) {
			crosshair_x = coords["x"];
			crosshair_y = coords["y"];
		}
		updateView();
	}
}

/* update the view after changing crosshair coords */
function updateView() {
	/* keep crosshair inside volume */
	if (crosshair_x < 0)
		crosshair_x = 0;
	else if (crosshair_x >= slice_num_x)
		crosshair_x = slice_num_x - 1;
	if (crosshair_y < 0)
		crosshair_y = 0;
	else if (crosshair_y >= slice_num_y)
		crosshair_y = slice_num_y - 1;
	if (crosshair_z < 0)
		crosshair_z = 0;
	else if (crosshair_z >= slice_num_z)
		crosshair_z = slice_num_z - 1;
	/* update text */
	info.innerHTML = "Crosshair coordinates: " + crosshair_x + ", " + crosshair_y + ", " + crosshair_z;
	/* set crosshair positions */
	cor_v_line.style.left = crosshair_x + "px";
	cor_h_line.style.top = crosshair_z + "px";
	sag_v_line.style.left = crosshair_y + "px";
	sag_h_line.style.top = crosshair_z + "px";
	tra_v_line.style.left = crosshair_x + "px";
	tra_h_line.style.top = crosshair_y + "px";
	/* set image origins to expose the correct slices */
	img_left = -slice_num_x * (crosshair_y % cor_columns);
	img_top = -slice_num_z * Math.floor(crosshair_y / cor_columns);
	cor_slices.style.left = img_left + "px";
	cor_slices.style.top = img_top + "px";
	img_left = -slice_num_y * (crosshair_x % sag_columns);
	img_top = -slice_num_z * Math.floor(crosshair_x / sag_columns);
	sag_slices.style.left = img_left + "px";
	sag_slices.style.top = img_top + "px";
	img_left = -slice_num_x * (crosshair_z % tra_columns);
	img_top = -slice_num_y * Math.floor(crosshair_z / tra_columns);
	tra_slices.style.left = img_left + "px";
	tra_slices.style.top = img_top + "px";
}

function mouseCoords(ev) {
	if (ev.pageX || ev.pageY) {
		return { x:ev.pageX, y:ev.pageY };
	} 
	return {
		x: ev.clientX + document.body.scrollLeft - document.body.clientLeft,
		y: ev.clientY + document.body.scrollTop  - document.body.clientTop
	};
}

function getMouseOffset(target, ev) {
	ev = ev || window.event;
	var docPos    = getPosition(target);
	var mousePos  = mouseCoords(ev);
	return {x:mousePos.x - docPos.x, y:mousePos.y - docPos.y};
}

function getPosition(e) {
	var left = 0;
	var top  = 0;
	
	while (e.offsetParent) {
		left += e.offsetLeft;
		top  += e.offsetTop;
		e     = e.offsetParent;
	}
	
	left += e.offsetLeft;
	top  += e.offsetTop;
	
	return {x:left, y:top};
}

