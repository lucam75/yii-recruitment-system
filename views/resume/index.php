<?php
	use yii\helpers\Html;
	use yii\bootstrap\ActiveForm;
?>
<div class="row">
	<div class="col-xs-12 text-center">
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
		</ol>
    </div>

    <div class="col-xs-12 summary-element hidden">
		<div class="text-center"><h2><?php echo Yii::t('app','Summary'); ?></h2></div>
	</div>
</div>
<?php 
	$form = ActiveForm::begin([
		'id' => 'resume-form',
		'class' => 'form-horizontal'
		]);
?>
<?php echo $this->render('step1', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections)); ?>
<?php //echo $this->render('step2', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections)); ?>
<?php //echo $this->render('step3', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections)); ?>
<?php //echo $this->render('step4', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections)); ?>
<?php //echo $this->render('step5', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections)); ?>

	<div class="row summary-element hidden buttons-bar" style="margin-top:20px;">
		<div class="col-xs-12">
			<?= Html::submitButton(Yii::t('app','Submit').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'name'=>'submit-archived', 'value'=>'send']) ?>
		</div>
	</div>

<?php ActiveForm::end(); ?>