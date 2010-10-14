	<?php
    if (!empty($comment)) {
      if (!empty($admin)) { 
        $fillin_comment = $comment;
      } else {
        $fillin_comment = 'Thank you for submitting your comment. Please send us more!';
      }
      $sendmail = 1;
    } else {
      $fillin_comment = '';
      $sendmail = 0;
    }
  ?>
  <form method="get" action="index.php">
   <font size="2pt">
   <i>Comments:</i><br />
   <textarea cols="<?php echo ceil($ydim/8.25); ?>" rows="6" name="comment" value=""><?php echo $fillin_comment; ?></textarea>
   <br />
   <i>Name (confidential):</i><br />
   <textarea cols="<?php echo ceil($ydim/8.25); ?>" rows="1" name="name" value=""><?php echo $name; ?></textarea><br />
   <i>Email address (confidential):</i><br />
   <textarea cols="<?php echo ceil($ydim/8.25); ?>" rows="1" name="email" value=""><?php echo $email; ?></textarea><br />
   <input type="button" value="Click #1 to add coordinates:" OnClick="sag0.value= sag; cor0.value= cor; hor0.value= hor;">
   <textarea cols="2" rows="1" name="sag0" value="" readonly="true"></textarea>
   <textarea cols="2" rows="1" name="cor0" value="" readonly="true"></textarea>
   <textarea cols="2" rows="1" name="hor0" value="" readonly="true"></textarea>
   <input type="hidden" name="ID" value="<?php echo $ID; ?>">
   <br />
   <input type="submit" value="Click #2 to send comments and coordinates">
   </font>
  </form>
