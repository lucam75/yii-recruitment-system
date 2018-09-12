<div class="panel panel-default">
  <div class="panel-heading"><?php echo Yii::t('app',$this->spanState($data->state)) ?>
  	<a class="openModal hidden-xs" id="<?php echo $data->idStatusResume; ?>"><?php echo Yii::t('app','Edit email template'); ?></a>
  </div>
  <div class="panel-body">
	<?php echo $data->templateEmail; ?>
  </div>
</div>