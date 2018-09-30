<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

<blockquote style="margin-left:20px;">
	<button type='button' class='close noSummary' name="deleteItem" idSection=<?php echo $data->idSection;?>>×</button>
	<h4 class='list-group-item-heading'><b><?php echo Html::encode($data->header); ?></b></h4>
	<p class='list-group-item-text' style="color: #999999"><?php echo Html::encode($data->description); ?></p>
</blockquote>