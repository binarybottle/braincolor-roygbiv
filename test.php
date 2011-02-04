
<!-- (c) 2010 arno klein, MIT license 
     arno@mindboggle.info
     http://www.braincolor.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
    
  <script type="text/javascript">
  var contour_path = 'contours/1013_3/'; //<!--?php echo $path_contours.$ID.'/'; ?-->;
  // image dimensions (from php variables above)
  var xdim_main = 0; 
  var zdim_main = 0; 
  var xdim  = ;
  var ydim  = ;
  var zdim  = ;
  var cor0  = 53; // initial coronal slice
  var sag0  = 167; // initial sagittal slice
  var hor0  = 127; // initial horizontal slice
  // number of images along the edge of the montage for each axis
  var nimages_x_montagedim1 = 16;
  var nimages_x_montagedim2 = 16;
  var nimages_y_montagedim1 = 16;
  var nimages_y_montagedim2 = 16;
  var nimages_z_montagedim1 = 16;
  var nimages_z_montagedim2 = 16;
  var labels_montage = 1;
  // individual slice presentation
  var mark_slices = 1;
  var mark_all_slices = 1;
  var sag_color = 'd24637'; // red;   the following doesn't work: <!--?php echo $sag_color; ?-->;
  var cor_color = '339311'; // green; the following doesn't work: <!--?php echo $cor_color; ?-->;
  var hor_color = '0d72f6'; // blue;  the following doesn't work: <!--?php echo $hor_color; ?-->;
  var show_mouse_coordinates = 1;    
  // repeated from the php settings above
  var offsetX        = 29; 
  var offsetY        = 220;
  var caption_height = 15; 
  var margin_right   = 3;
  var margin_bottom  = 3;
  var border_width   = 3;
  var opacity0       = 75; 
  </script>
  <script type="text/javascript" src="./scripts/jquery/jquery.min.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery.ui.core.min.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery.ui.widget.min.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery.ui.mouse.min.js"></script>

  <script type="text/javascript" src="./scripts/jquery/jquery.ui.slider.min.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery_draw_1.3.0.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery.maphilight.min.js"></script>
  <script type="text/javascript" src="./scripts/jquery/jquery.metadata.js"></script>
  <script type="text/javascript" src="./scripts/updateSlices.js"></script>
  <script type="text/javascript" src="./scripts/functions.js"></script>

  <script type="text/javascript" src="./scripts/main.js"></script>
  <script type="text/javascript" src="./scripts/popup.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/jquery.ui.core.css" />
  <link rel="stylesheet" type="text/css" href="./css/jquery.ui.slider.css" />
  <link rel="stylesheet" type="text/css" href="./css/jquery.ui.theme.css" />
  <link rel="stylesheet" type="text/css" href="./css/style.css" />
 

  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="description" content="Brain Image Viewer">

  <meta name="keywords" content="Brain Image Viewer">
  <meta http-equiv="Content-language" content="en">
  <meta name="author" content="mailto:arno&#64;mindboggle.info">
  <meta name="dc.title" content="ROYG Brain Image Viewer">
  <meta name="dc.creator.address" content="arno&#64;mindboggle.info">
  <meta name="dc.subject" content="braincolor image viewer">
  <meta name="dc.type" content="text.homepage.educational">
  <meta name="dc.format" content="text/html">
  <meta name="dc.identifier" content="http://www.braincolor.org">

  <meta name="dc.identifier" content="http://www.braincolor.org">
<link rel="stylesheet" type="text/css" href="http://braincolor.org/shared/style.css"> 
</head>
<body>
 <div class="banner">

    <a href="http://www.braincolor.org/index.php"><IMG src="http://www.braincolor.org/shared/mindboggle_logo.jpg" width="100" height="80" border="0"></a>
    
    <span class="logogram">
    <a href="http://www.braincolor.org/index.php">brain<font color="red">C</font><font color="orange">O</font><font color="green">L</font><font color="blue">O</font><font color="purple">R</font>

    </a>
    </span>

    <span class="logogram_acronym">
     <font color="red">C</font>ollaborative 
   	 <font color="orange">O</font>pen
   	 <font color="green">L</font>abeling
   	 <font color="blue">O</font>nline
   	 <font color="purple">R</font>esource
    </span>

    <span class="banner_links">	 
     <a href="http://www.braincolor.org/protocols">labels</a>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <a href="http://www.braincolor.org/colors">colors</a>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <a href="http://www.braincolor.org/roygbiv">brains</a>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

     <a href="http://www.braincolor.org/about.php">about</a>
	</span>
	
</div>
 <title>Roy G. Brain Image Viewer</title>
 <div class="intro" style="top:140px; left:30px;">
  <font size="3pt">Help improve brain labels with the </font>
  <font size="3pt"><font color="red">R</font><font color="FF9900">O</font><font color="FFCC00">Y</font><font color="green">G</font> <font color="blue">B</font>rain <font color="6600FF">I</font>mage <font color="purple">V</font>iewer!</font><br /><br />

<table>
 <tr><td style="vertical-align:top; width:512">
<span class="smalltext">
LEFT: &nbsp;1. Select a brain image (currently only 1) and set the label opacity.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
2. Move mouse over image to see text labels.<br />
</span>
 </td>
 <td style="vertical-align:top; width:512">
<span class="smalltext">
RIGHT: &nbsp;1. Click within the 3 panels to move around.<br />

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
2. Submit comments about these labels or the <a href="http://www.braincolor.org/protocols" onClick="return popup(this,'protocols')">label definitions</a>.
</span>
<br />
 </td></tr>
</table>
 </div>
 <div class="main" style="top:220px; left:30px;">
  <table border="0" cellspacing="0" cellpadding="0">
   <tr><td style="vertical-align:top">

    <!-- CORONAL main panel -->
        <div class="caption" 
     style="background-color:000000;
     height: 15px;
     border-width: 3px;
     border-color: 339311;
     border-style: solid;
     border-bottom:000000; width:0px;">
     <div id="cor_main_caption" style="text-indent:6px"><b>Move mouse/cursor over regions to see text labels</b> &nbsp;&nbsp;(brain 1013_3)
     </div>
    </div>
    <div class="slice_container"
     style="width:  512px;
     height:        512px;
     margin-right:  3px;
     border-width:  3px;
     border-color:  339311;
     border-top:    000000;" >
     <div id="slice_cor_main">
      <img id="images_cor_main" src="montages/1013_3_axis2_2x.jpg">

      
      <img src="http://www.braincolor.org/roygbiv/montages/1013_3_labels_colors_axis2_2x.png" id="labels_cor_main" style="opacity:0.75">     </div>
     <!-- Transparent image to map contours on top -->
     <img src="data/contours_cor/blank_cor_512x512.png" class="map" usemap="#contour_map" border=0>
     <div id="contour_data"></div>
    </div>

    <!-- MENU and SLIDER -->
    <br />
    <table>

     <tr><td valign="bottom">
     
<form method="post" action="">
 <select name="ID">

 <option value="1013_3">1013_3</option> 
 </select>
 <input type="submit" value="Select image" name="submit">
</form>
     </td><td valign="top">
     <table>

     <tr><td>
     <label for="opacity"></label>
     <input type="text" id="opacity" style="border:0; font-size:9pt; width:30px; text-align:right"; /><font size="2">% label opacity:</font>
     </td><td valign="middle">
     <div class="slider" id="slider" style="color:#000000; width:200px"></div>
     </td></tr>
     </table>
     </td></tr>

    </table>

    <!--?php include("menu_selection.php"); ?-->

    <!-- SLICE LABELS -->
    <div id="label_names"></div>

   </td><td style="vertical-align:top;" align="left">
    <table border="0" cellspacing="0" cellpadding="0">
     <tr><td style="vertical-align:top">

     <!-- CORONAL -->    
       <div class="caption"
     style="background-color:000000;
        height: 15px;
        border-width: 3px;
        border-color: 339311;
        border-style: solid;
        border-bottom:000000; width:px;">
     <div class="cor_caption" style="text-indent:6px">coronal</div>
     <div id="mouse"><span id="mouse_cor"></span></div>
     <img src="images/left_arrow.png" id="cor_backward" 
      style="top:2px; left:-40px;" height=80% />
     <span id="cor_number"  
      style="position:absolute; top:0px; left:-13px;"></span>
     <img src="images/right_arrow.png" id="cor_forward" 
      style="top:2px; left:20px;" height=80% />
  </div>

  <div class="slice_container"
     style="width:         px;
        height:        px;
        margin-right:  3px;
        border-width:  3px;
        border-color:  339311;
        border-top:    000000;" >
     <div id="slice_cor">
      <img id="images_cor" src="montages/1013_3_axis2_1x.jpg">
      <img src="montages/1013_3_labels_colors_axis2.png" id="labels_cor" style="opacity:0.75">     </div>
     <div id="mark">
      <div id="mark_cor"></div>
      <div id="mark_cor_ref"></div>
     </div>

    </div>
  </div>

     </td><td style="vertical-align:top">

     <!-- SAGITTAL -->    
         <div class="caption" 
		 style="background-color:000000;
				height: 15px;
				border-width: 3px;
				border-color: d24637;
				border-style: solid;
				border: 3px d24637 solid;
				border: 3px d24637 solid;
				border-bottom:000000; width:px;">
     <div id="sag_caption" style="text-indent:6px">sagittal</div>
	 <div id="mouse"><span id="mouse_sag"></span></div>
     <img src="images/left_arrow.png" id="sag_backward" 
     	  style="top:2px; left:-40px;" height=80% />

     <span id="sag_number"  
     	   style="position:absolute; top:0px; left:-13px;"></span>
     <img src="images/right_arrow.png" id="sag_forward" 
          style="top:2px; left:20px;" height=80% />

    </div>
    <div class="slice_container"
		 style="width:        px;
				height:       px;
				border-width: 3px;
				border-color: d24637;
				border-top:    000000;" >

     <div id="slice_sag">
      <img id="images_sag" src="montages/1013_3_axis1_1x.jpg">

      <img src="montages/1013_3_labels_colors_axis1.png" id="labels_sag" style="opacity:0.75">     </div>

     <div id="mark">
      <div id="mark_sag"></div>
      <div id="mark_sag_ref"></div>
     </div>
    </div>
	</div>
  
     </td></tr><tr><td style="vertical-align:top">

     <!-- HORIZONTAL -->

         <div class="caption" 
		 style="background-color:000000;
				margin-top:      3px;
				height: 15px;
				border-width: 3px;
				border-color: 0d72f6;
				border-style: solid;
				border-bottom:000000; width:px;">
     <div id="hor_caption" style="text-indent:6px">horizontal</div>
	 <div id="mouse"><span id="mouse_hor"></span></div>
     <img src="images/left_arrow.png" id="hor_backward" 
		  style="top:2px; left:-40px;" height=80% />
     <span id="hor_number"  
		  style="position:absolute; top:0px; left:-13px;"></span>
     <img src="images/right_arrow.png" id="hor_forward" 
		  style="top:2px; left:20px;" height=80% />

    </div>
    <div class="slice_container"
		 style="width:        px;
				height:       px;
				border-width: 3px;
				border-color: 0d72f6;
				border-top:    000000;" >

    <div id="slice_hor">
      <img id="images_hor" src="montages/1013_3_axis3_1x.jpg">

      <img src="montages/1013_3_labels_colors_axis3.png" id="labels_hor" style="opacity:0.75">     </div>
     <div id="mark">
      <div id="mark_hor"></div>
      <div id="mark_hor_ref"></div>
     </div>

    </div>
	</div>
     <font size="2">Questions? Please email <a href="mailto:arno@braincolor.org">arno@braincolor.org</a></font>
     </td><td style="vertical-align:top">

     <!-- COMMENT FORM -->
         <form method="get" action="index.php">
   <font size="2pt">

   <i>Comments:</i><br />
   <textarea cols="0" rows="6" name="comment" value=""></textarea>
   <br />
   <i>Name (confidential):</i><br />
   <textarea cols="0" rows="1" name="name" value=""></textarea><br />
   <i>Email address (confidential):</i><br />

   <textarea cols="0" rows="1" name="email" value=""></textarea><br />
   <input type="button" value="Add coordinates:" OnClick="sag0.value= sag; cor0.value= cor; hor0.value= hor;">
   <textarea cols="2" rows="1" name="sag0" value="" readonly="true"></textarea>
   <textarea cols="2" rows="1" name="cor0" value="" readonly="true"></textarea>
   <textarea cols="2" rows="1" name="hor0" value="" readonly="true"></textarea>
   <input type="hidden" name="ID" value="1013_3">
   <br /><br />

   <input type="submit" value="Submit comments and coordinates">
   </font>
  </form>
    
     <!-- SEND MAIL, INSERT into DATABASE -->
            
     </td></tr>
    </table>
   </td></tr>
  </table>
 </div>

</body>
</html>
