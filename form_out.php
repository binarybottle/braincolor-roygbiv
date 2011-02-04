   <?php
    if ($sendmail==1) {
      $name    = preg_replace('/\s+/',' ',$name);
      $email   = preg_replace('/\s+/',' ',$email);
      $comment = preg_replace('/\s+/',' ',$comment);
      $name = trim(htmlspecialchars(stripslashes(mysql_escape_string($name))));
      $email = trim(htmlspecialchars(stripslashes(mysql_escape_string($email))));
      $comment = trim(htmlspecialchars(stripslashes(mysql_escape_string($comment))));
      $mail_name    = preg_replace('/\s+/','+',$name);
      $mail_email   = preg_replace('/\s+/','+',$email);
      $mail_comment = preg_replace('/\s+/','+',$comment);
      $mail_to      = 'arno@braincolor.org';
		  $mail_from    = 'From: roygbiv@braincolor.org';
		  $mail_subject = 'ROYGBIV feedback';
      $mail_body    = "

                 New ROYGBIV comment:
                 
                 ".$comment."
                 
                 Please visit:

                 http://www.braincolor.org/roygbiv/index.php?admin=1&ID=".$ID."&sag0=".$sag0."&cor0=".$cor0."&hor0=".$hor0."&name=".$mail_name."&email=".$mail_email."&comment=".$mail_comment;
                 
      if (!mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
        echo 'Notification message delivery failed. Please contact info[at]braincolor.org.';
      }

      $sql_insert = "INSERT INTO comments (imageID,name,email,comment,sagittal,coronal,horizontal) 
                     VALUES ('".$ID."','".$name."','".$email."','".$comment."','".$sag0."','".$cor0."','".$hor0."')";
      mysql_query($sql_insert) or die(mysql_error());
   }
  ?>
