<?php
	use yii\helpers\Html;
?>
<div id="divStep2" style="display:none">
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
				<div class="alert alert-info noSummary">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest education/formation.'); ?>
				</div>
				<a class="noSummary" data-toggle="modal" data-target="#add-modal" id="linkAddNewEducation"><i class="fa fa-plus-square"></i><?php echo " ".Yii::t('app','Add new'); ?></a>
				<div class="row" style ="margin-top:10px;">

				<div class="list-group">
					<div class="list-group" id="listEducation">
					<?php echo $this->render('_listEducations'); ?>
				</div>
			</fieldset>

			<fieldset class="experience">
				<legend><?php echo Yii::t('app','Experience'); ?></legend>
				<div class="alert alert-info noSummary">
	  				<button type="button" class="close" data-dismiss="alert">×</button>
	  				<strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest experience.'); ?>
				</div>
				<?php echo $this->render('_multipleItemsForm', array('model'=>$model, 'form'=>$form, 'modelsSections'=>$modelsSections, 'sectionvalue'=>'1')); ?>				
			</fieldset>
			<div class="row noSummary" style="margin-top:20px;">
				<div class="col-xs-12">
					<?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep3']) ?>
					<?= Html::Button(' <i class="fa fa-arrow-left"></i> '.Yii::t('app','Prev'), ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep1']) ?>
				</div>
			</div>
		</div>
	</div>
</div>

 <div class="modal fade" id="add-section-modal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
      	<?php echo $this->render('_formSections'); ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('app','Close'); ?></button>
        <button type="button" class="btn btn-success" id="buttonOKModal"><?php echo Yii::t('app','Add'); ?></button>
      </div>
    </div>
  </div>
</div>