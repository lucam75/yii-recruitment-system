<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<blockquote style="margin-left:20px;">
	<button type='button' class='close noSummary' name="deleteItem" idEducation=<?php echo $data->idEducation;?>>×</button>

	<span class='label label-default pull-left'><?php echo Html::encode($model->startYear)." - ".Html::encode($model->endYear); ?></span>
	<br/>
	<h4 class='list-group-item-heading'><?php echo Html::encode($model->title); ?></h4>
	<p class='list-group-item-text'><?php echo Html::encode($model->place); ?></p>
	<footer><?php echo Html::encode($model->description); ?></footer>
</blockquote>