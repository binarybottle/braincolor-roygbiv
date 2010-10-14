<?php
//----------------------------
// disconnecting mysql db
//----------------------------
   if ( $dbh ){
      mysql_close($dbh);
   }
?>
