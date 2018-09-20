<?php
	use yii\widgets\ListView;
	use yii\data\ArrayDataProvider;
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

</div>
<!-- <div class="modal fade" id="template-modal" role="dialog" aria-labelledby="myModalLabel" data-template-id="">
  <div class="modal-dialog" role="document" style="width:800px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?php echo Yii::t('app','Edit template'); ?></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app','Cancel'); ?></button>
        <button type="button" class="btn btn-success" id="buttonOKModal"><?php echo Yii::t('app','Save'); ?></button>
      </div>
    </div>
  </div>
</div> -->