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
    // $cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.form.js');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/company.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/daterange/moment.js');
    $cs->registerScriptFile(Yii::app()->baseUrl.'/js/daterange/daterangepicker.js');
    $cs->registerCssFile(Yii::app()->baseUrl.'/js/daterange/daterangepicker-bs2.css');
  ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container background">

      <div class="navbar navbar-default" style="margin-bottom:1px;">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand"><i class="fa fa-fire"></i> Company</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
          <ul class="nav navbar-nav menu visible-xs">
            <li><?php echo CHtml::link('<i class="fa fa-folder"></i> '.Yii::t('app','New').'  <span class="badge" name="badgeNews">'.Yii::app()->session['newsResumes'].'</span>',array('Company/index')); ?></li>
            <li><?php echo CHtml::link('<i class="fa fa-envelope"></i> '.Yii::t('app','Archived'),array('Company/Archived')); ?></li>
          </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a><?php echo Yii::app()->user->username; ?></a></li>
            <li><?php echo CHtml::link('<i class="fa fa-power-off"></i>',array("Site/Logout")); ?></li>
          </ul>
        </div>
      </div>
<div class="row">
  <div class="col-xs-12">
    <?php $this->widget('application.components.LangBox'); ?>
  </div>
</div>
      <div class="row">
        <div class="col-md-2">
          <div class="btn-group btn-group-vertical menuV hidden-xs">
            <?php echo CHtml::link('<i class="fa fa-folder"></i> '.Yii::t('app','New').'  <span class="badge" name="badgeNews">'.Yii::app()->session['newsResumes'].'</span>',array('Company/index'),array('class'=>'btn btn-default')); ?>
            <?php echo CHtml::link('<i class="fa fa-envelope"></i> '.Yii::t('app','Archived'),array('Company/Archived'),array('class'=>'btn btn-default')); ?>
          </div>
        </div>
        <div class="col-md-10">
          <?php echo $content; ?>
        </div>
      </div>
      <div class="footer">
          <p>© Company 2014</p>
      </div>
    </div>
  </body>
</html>