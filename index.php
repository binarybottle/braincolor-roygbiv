<!-- (c) 2010 arno klein, MIT license 
     arno@mindboggle.info
     http://www.braincolor.org
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
 $ID      = $_GET['ID'];      // image file ID
 $cor0    = $_GET['cor0'];    // initial coronal slice
 $sag0    = $_GET['sag0'];    // initial sagittal slice
 $hor0    = $_GET['hor0'];    // initial horizontal slice
 $name    = $_GET['name'];    // form: name
 $email   = $_GET['email'];   // form: email address
 $admin   = $_GET['admin'];   // form: admin
 $comment = $_GET['comment']; // form: comment
?> 
<?php include_once("settings.php"); ?>
<?php include_once("scriptlist.php") ?> 
<?php include_once("../shared/metatags.php"); ?>
<link rel="stylesheet" type="text/css" href="http://braincolor.org/shared/style.css"> 
</head>
<body>
 <?php include_once("../shared/banner.php"); ?>
 <title>Roy G. Brain Image Viewer</title>
 <div class="intro" style="top:<?php echo $intro_top; ?>px; left:<?php echo $main_left; ?>px;">
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
 <div class="main" style="top:<?php echo $main_top; ?>px; left:<?php echo $main_left; ?>px;">
  <table border="0" cellspacing="0" cellpadding="0">
   <tr><td style="vertical-align:top">

    <!-- CORONAL main panel -->
    <?php include("slice_cor_main.php"); ?>

    <!-- MENU and SLIDER -->
    <br />
    <table>
     <tr><td valign="bottom">
     <?php include("menu.php"); ?>
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
     <?php include("slice_cor.php"); ?>

     </td><td style="vertical-align:top">

     <!-- SAGITTAL -->    
     <?php include("slice_sag.php"); ?>
  
     </td></tr><tr><td style="vertical-align:top">

     <!-- HORIZONTAL -->
     <?php include("slice_hor.php"); ?>
     <font size="2">Questions? Please email <a href="mailto:arno@braincolor.org">arno@braincolor.org</a></font>
     </td><td style="vertical-align:top">

     <!-- COMMENT FORM -->
     <?php include_once("form_in.php"); ?>
    
     <!-- SEND MAIL, INSERT into DATABASE -->
     <?php include_once("form_out.php"); ?>
    
     </td></tr>
    </table>
   </td></tr>
  </table>
 </div>
</body>
</html>
