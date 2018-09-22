<?php
	use yii\widgets\ListView;
	use yii\data\ArrayDataProvider;
	use yii\helpers\Html;
?>

<h2><?php echo Yii::t('app','Admin email templates'); ?></h2>
<div class="row">
	<div class="col-xs-12">
		<?php echo Yii::t('app','These are the email templates sent to the applicants when a resumes changes status.'); ?>
	</div>
</div>

<div id="divTemplate">
<?php 
	echo ListView::widget([
		'dataProvider' => $dataProvider,
		'itemView' => '_detailTemplate',
		'summary' => '',
		'emptyText' => '',
		'itemOptions' => ['tag'=>false],
		'options' => ['tag'=>false]
	]);
?>