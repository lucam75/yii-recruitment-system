<?php
	use yii\helpers\Html;
?>
<div id="divStep2" style="display:none" class="divStep">
	<div class="row no-summary-element">
		<div class="col-xs-12">
			<div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 25%"></div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<div class="text-center">
				<h2><?php echo Yii::t('app','Education and experience'); ?></h2>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<fieldset>
				<legend><?php echo Yii::t('app','Education & Formation'); ?></legend>
				<div class="alert alert-info no-summary-element">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest education/formation.'); ?>
				</div>
			</fieldset>

			<fieldset class="experience">
				<legend><?php echo Yii::t('app','Experience'); ?></legend>
				<div class="alert alert-info no-summary-element">
	  				<button type="button" class="close" data-dismiss="alert">×</button>
	  				<strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest experience.'); ?>
				</div>
				<?php echo $this->render('_multipleItemsForm', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections, 'sectionvalue'=>'1')); ?>				
			</fieldset>
			<div class="row no-summary-element buttons-bar" style="margin-top:20px;">
				<div class="col-xs-12">
					<?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep3']) ?>
					<?= Html::Button(' <i class="fa fa-arrow-left"></i> '.Yii::t('app','Prev'), ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep1']) ?>
				</div>
			</div>
		</div>
	</div>
</div>