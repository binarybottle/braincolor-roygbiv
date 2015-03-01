<!-- (c) 2011 arno klein, MIT license 
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
//$name    = $_GET['name'];    // form: name
//$email   = $_GET['email'];   // form: email address
//$admin   = $_GET['admin'];   // form: admin
//$comment = $_GET['comment']; // form: comment

include_once("../../../db/roygbiv_db.php");
include_once("./shared/metatags.php"); 
include_once("./scriptlist.php");
include("./settings.php");

?>

<script type="text/javascript">
// $(document).ready(function(){
//  $('#page_effect').fadeIn(0);
// });
</script>

</head>

<body>
 
 <title>Roy G. Brain Image Viewer</title>

 <?php include_once("./shared/banner.php"); ?>
 
 <div style="position:absolute; top:180px; left:30px;">
  <span style="font-size:80%;">
  Move mouse over left panel to see text labels. &nbsp;&nbsp;
  </span>
 </div>

 <div style="position:absolute; top:180px; left:548px;">
  <span style="font-size:80%;">
  Click within right panels to navigate through volume.
  </span>
 </div>

 <div id="page_effect" style="display:none;">

 <div class="main" style="top:<?php echo $main_top; ?>px; left:<?php echo $main_left; ?>px;">
 
 <table border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td style="vertical-align:top;" align="left">

     <!-- CORONAL main panel -->
     <?php include("slice_cor_main.php"); ?>

     <!-- MENU and LABEL BUTTON -->
     <br />
     <table>
      <tr>
       <td valign="top">
        <?php include("menu.php"); ?>
       </td>
       <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
       <td valign="top">
        <button><span class="labels_button">Toggle labels OFF</span><span class="labels_button" style="display: none">Toggle labels ON</span></button>
        <!--label for="opacity"></label>
        <input type="text" id="opacity" style="border:0; font-size:9pt; width:50px; text-align:right"; />
        <font size="2">% label opacity:&nbsp;&nbsp;</font>
        <div class="slider" id="slider" style="color:#000000; width:<?php //echo $slider_width; ?>px; 
         top:<?php //echo $slider_top; ?>px; left:<?php //echo $slider_left; ?>px;"></div-->
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

      </td>
      <!--td style="vertical-align:top;" align="left"-->
       <!-- COMMENT FORM -->
       <?php //include_once("form_in.php"); ?>
       <!-- SEND MAIL, INSERT into DATABASE -->
       <?php //include_once("form_out.php"); ?>
      <!--/td-->

     </tr>
    </table>
   </td>
  </tr>
 </table>

 <!-- SLICE LABELS -->
 <br />
 <div id="label_names"></div>

 </div>
 </div>
</body>
</html>
