<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Basic recruitment app in Yii2">
    <meta name="author" content="Luis M. Campos">
    <link href="<?= Url::base() ?>/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title)." | ".Html::encode(Yii::$app->name); ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container-fluid background">
    <div class="row">
            <nav class="navbar navbar-fixed-top fixed-top navbar-expand-lg navbar-dark bg-dark navbar-inverse">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= Url::base() ?>"><i class="fa fa-fire"></i> <?= Html::encode(Yii::$app->name) ?></a>
                    
                    <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
                        <span class="navbar-brand"><?= !Yii::$app->user->getIsGuest() ? Html::encode(Yii::$app->user->identity->name):'' ?></span>  
                        <?= !Yii::$app->user->getIsGuest() ? Html::a('<i class="fa fa-power-off"></i>', Url::to('@web/site/logout', true), ['class' => 'navbar-brand']): '' ?>
                    </div>
                </div>
            </nav>
    </div>
    <?= Alert::widget() ?>
    <div class="body-content">
        <?= $content ?>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Luis M. Campos  <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
</div>
<?= $this->registerJsFile(Yii::$app->request->BaseUrl . '/js/script.js', ['depends' => [yii\web\JqueryAsset::className()]]);
 ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
