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

include_once("../../db/roygbiv_db.php");
include_once("../shared/metatags.php"); 
include_once("./scriptlist.php");
include("./settings.php");

$test_jquery = 0;
if ($test_jquery) {
  //nx=12 ny=15 nz=13 xd=136 yd=200 zd=169
  echo '<script type = "text/javascript">
   $(document).ready(function() {
     alert("sag0="+sag0+", cor0="+cor0+", hor0="+hor0+", nx="+nimages_x+", ny="+nimages_y+", nz="+nimages_z+", xd="+xdim+", yd="+ydim+", zd="+zdim);
   }); 
  </script>';
}
?>

</head>
<body>
 
 <title>Roy G. Brain Image Viewer</title>

 <?php include_once("../shared/banner.php"); ?>
 
 <div class="intro_top">
<br /><br /><br /><br /><br /><br /><br /><br />
 <font size="3pt"><font color="red">ROYBGIV is UNDER CONSTRUCTION on the week of February 16th. <br />
 Please excuse any inconveniences.</font></font><!--Help improve brain labels with the </font>
 <font size="3pt"><font color="red">R</font><font color="FF9900">O</font><font color="FFCC00">Y</font><font color="green">G</font> <font color="blue">B</font>rain <font color="6600FF">I</font>mage <font color="purple">V</font>iewer!</font-->
 <br />
 <!--span class="intro_text">
  1. Select a brain image and set the label opacity.<br />
  2. Click within the left 3 panels and move mouse over right panel to see text labels.<br />
  3. Submit comments about these labels or the <a href="http://www.braincolor.org/protocols" onClick="return popup(this,'protocols')">label definitions</a>.
 </span-->
 </div>
 <div class="main" style="top:<?php echo $main_top; ?>px; left:<?php echo $main_left; ?>px;">
 
 <table border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td style="vertical-align:top;" align="left">

     <!-- CORONAL main panel -->
     <?php include("slice_cor_main.php"); ?>

     <!-- MENU and SLIDER -->
     </br>
     <table border="0" cellspacing="0" cellpadding="0">
      <tr>
       <td valign="top" align="center">
        <label for="opacity"></label>
        <input type="text" id="opacity" style="border:0; font-size:9pt; width:50px; text-align:right"; /><font size="2">% label opacity:&nbsp;&nbsp;</font>
       </td>
       <td valign="middle" align="center">
        <div class="slider" id="slider" style="color:#000000; width:<?php echo $slider_width; ?>px"></div>
       </td>
      </tr>
      <tr>
       <td align="center" colspan="2">
        <br />
        <?php include("menu.php"); ?>
       </td>
      </tr>
     </table>

   </td>
   <td style="vertical-align:top;" align="left">
    <table border="0" cellspacing="0" cellpadding="0">
     <tr>
      <td align="left" style="vertical-align:top">

       <!-- CORONAL -->    
       <?php include("slice_cor.php"); ?>

      </td><td style="vertical-align:top">

       <!-- SAGITTAL -->    
       <?php include("slice_sag.php"); ?>

      </td>
     </tr>
     <tr>
      <td style="vertical-align:top;" align="left">

       <!-- HORIZONTAL -->
       <?php include("slice_hor.php"); ?>

      </td><td style="vertical-align:top;" align="left">

       <!-- COMMENT FORM -->
       <?php //include_once("form_in.php"); ?>

       <!-- SEND MAIL, INSERT into DATABASE -->
       <?php include_once("form_out.php"); ?>

      </td>
     </tr>
    </table>
   </td>
  </tr>
 </table>

 <!-- SLICE LABELS -->
 <br />
 <div id="label_names"></div>

 </div>
</body>
</html>
