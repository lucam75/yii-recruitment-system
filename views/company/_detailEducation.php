<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<li style="margin-left:20px; margin-top:10px;">
	<span class='label label-default pull-left'><?php echo Html::encode($model->startYear)." - ".Html::encode($model->endYear); ?></span>
	<h4 class='list-group-item-heading'>  <?php echo Html::encode($model->title); ?></h4>
	<p class='list-group-item-text'><?php echo Html::encode($model->place); ?></p>
	<footer><?php echo Html::encode($model->description); ?></footer>
</li>