<?php
// include_once "./shared/db.php";
 include_once "../../db/roygbiv_db.php";
 $table_name = 'images'; 
?>

<form method="post" action="<?php echo $PHP_SELF;?>">
 <select name="ID">

 <?php
 //------------------------
 // Populate dropdown lists
 //------------------------
 $sql = "SELECT DISTINCT image_file FROM ".$table_name;
 $result = mysql_query($sql) or die (mysql_error());
 while($row = mysql_fetch_object($result)) {
   $ID = $row->image_file;
   echo '<option value="'.$ID.'">'.$ID.'</option>';
 }
 ?>
 
 </select>
 <input type="submit" value="Select image" name="submit">
</form>
