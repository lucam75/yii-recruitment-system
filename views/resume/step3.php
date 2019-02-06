<?php
    use yii\helpers\Html;
?>

<div id="divStep3" style="display:none" class="divStep">
	<div class="row no-summary-element">
		<div class="col-xs-12">
			<div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 50%"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Achievements and Hobbies'); ?></h2></div></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 col-xs-12">
			<fieldset>
				<legend><?php echo Yii::t('app','Achievements'); ?></legend>
				<div class="alert alert-info no-summary-element">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo Yii::t('app','Tell us about your most remarkable achievements.'); ?>
				</div>
				<?php echo $this->render('_multipleItemsForm', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections, 'sectionvalue'=>'2')); ?>
			</fieldset>

			<fieldset>
				<legend><?php echo Yii::t('app','Hobbies'); ?></legend>
				<div class="alert alert-info no-summary-element">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo Yii::t('app','The things that you do in your leisure'); ?>
				</div>
				<?php echo $this->render('_multipleItemsForm', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections, 'sectionvalue'=>'3')); ?>
			</fieldset>
			<div class="row no-summary-element buttons-bar" style="margin-top:20px;">
				<div class="col-xs-12">
				<?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep4']) ?>
					<?= Html::Button(' <i class="fa fa-arrow-left"></i> '.Yii::t('app','Prev'), ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep2']) ?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>