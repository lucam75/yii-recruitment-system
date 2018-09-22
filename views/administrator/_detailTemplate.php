<?php
  
?>
<div class="panel panel-default">
  <div class="panel-heading"><?php echo Yii::t('app',$this->context->spanState($model->state)) ?>
  	<a class="edit-template" id="<?php echo $model->idStatusResume; ?>"><?php echo Yii::t('app','Edit email template'); ?></a>
  </div>
  <div class="panel-body">
    <div class="read-only">
      <?php echo $model->templateEmail; ?>
    </div>
    <div class="div-ckeditor hidden">
      <?php echo $this->render('_ckeditor',array('model'=>$model)); ?>
    </div>
  </div>
</div>