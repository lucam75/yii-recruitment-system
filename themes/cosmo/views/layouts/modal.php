<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.min.js');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.form.js');
  ?>
  </head>
  <body>
      <?php echo $content; ?>
  </body>
</html>