<div id="divSummary" style="display:none">
	<div class="row">
		<div class="col-xs-12">
			<div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 100%"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="text-center">
				<h1><?php echo Yii::t('app','Summary'); ?></h1>
			</div>
		</div>
	</div>
</div>

 <div class="modal" id="modalSummary">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"><?php echo Yii::t('app','Send resume'); ?></h4>
      </div>
      <div class="modal-body">
        <?php echo Yii::t('app','Your resume be sent to recruitment team, are you sure?'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app','Cancel'); ?></button>
        <button type="button" class="btn btn-success" id="buttonOKModal"><?php echo Yii::t('app','Send'); ?></button>
      </div>
    </div>
  </div>
</div>