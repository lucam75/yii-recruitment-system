<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" rel="shortcut icon" type="<?php echo Yii::app()->theme->baseUrl; ?>/image/x-icon" />

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/font-awesome-4.0.3/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/CSS/Style.css" rel="stylesheet">

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
	<?php
  Yii::app()->clientScript->registerCoreScript('jquery');
    $cs = Yii::app()->getClientScript();
    // $cs->registerCssFile(Yii::app()->baseUrl .'/css/bootstrap-theme.css');
    // $cs->registerCssFile(Yii::app()->baseUrl .'/css/bootstrap.css');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/bootstrap.min.js');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.form.js');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/script.js');
  ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <?php echo $content; ?>
<!--       <div class="footer" style="position: absolute; bottom: 0;">
          <p>© Company 2014</p>
      </div> -->
    </div>
  </body>
</html>