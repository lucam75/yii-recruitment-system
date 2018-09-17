<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<li style="margin-left:20px; margin-top:10px;">
	<h4><b><?php echo Html::encode($model->header); ?></b></h4>
	<div style="color: #999999; display:inline;"><?php echo Html::encode($model->description); ?></div>
</li>