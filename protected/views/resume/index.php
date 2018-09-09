<div class="row">
	<div class="col-xs-2 col-md-1"><ol class="breadcrumb"><li><?php echo CHtml::link(Yii::t('app','Home'),Yii::app()->createUrl('')); ?></li></ol></div>
	<div class="col-xs-10 col-md-11 text-center">
		<ol class="breadcrumb">
			<li id="liStep1"><a><?php echo Yii::t('app','Step 1'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep2"><a><?php echo Yii::t('app','Step 2'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep3"><a><?php echo Yii::t('app','Step 3'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep4"><a><?php echo Yii::t('app','Step 4'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStepSummary"><a><?php echo Yii::t('app','Summary'); ?></a></li>
			<!-- <li><span>Data</span></li> -->
		</ol>
	</div>
</div>
<div id="steps">
	<?php $this->stepSummary(); ?>
	<?php $this->step1(); ?>
	<?php $this->step2(); ?>
	<?php $this->step3(); ?>
	<?php $this->step4(); ?>
	<?php $this->step5(); ?>
</div>
<?php //echo $this->renderPartial('step1', array('model'=>$model)); ?>
<?php //echo $this->renderPartial('step2', array('model'=>$model)); ?>

 <div class="modal" id="demo_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="buttonAddModal"><?php echo Yii::t('app','Add'); ?></button>
      </div>
    </div>
  </div>
</div>