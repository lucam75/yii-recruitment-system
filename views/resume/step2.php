<div id="divStep2" style="display:none">
	<div class="row noSummary">
		<div class="col-xs-12">
			<div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 25%"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Education and experience'); ?></h2></div></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 col-xs-12">
	<fieldset>
	<legend><?php echo Yii::t('app','Education & Formation'); ?></legend>
	<div class="alert alert-info noSummary">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest education/formation.'); ?>
	</div>
	<a class="noSummary" id="linkAddNewEducation"><i class="fa fa-plus-square"></i><?php echo " ".Yii::t('app','Add new'); ?></a>
	<div class="row" style ="margin-top:10px;">

		<div class="list-group">

			<div class="list-group" id="listEducation">
<?php 		echo $this->renderPartial('_listEducations'); ?>
			</div>

		</div>
	</div>
	</fieldset>

	<fieldset>
	<legend><?php echo Yii::t('app','Experience'); ?></legend>
	<div class="alert alert-info noSummary">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <strong><?php echo Yii::t('app','Tip!'); ?> </strong><?php echo Yii::t('app','First add your newest experience.'); ?>
	</div>
	<a class="noSummary" id="linkAddNewExperience"><i class="fa fa-plus-square"></i><?php echo " ".Yii::t('app','Add new'); ?></a>

	<div class="row" style ="margin-top:10px;">

		<div class="list-group">

			<div class="list-group" id="listExperience">
<?php 		echo $this->renderPartial('_listSections',array('session'=>'Experiences')); ?>
			</div>

		</div>
	</div>
	</fieldset>
			<div class="row noSummary" style="margin-top:20px;">
				<div class="col-xs-12">
					<?php
						echo BsHtml::button(Yii::t('app','Next step').' <i class="fa fa-arrow-right"></i>', array(
						    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
						    'class'=>'pull-right NAVIGABLE',
						    'style'=>'margin-left:20px',
						    'to'=>'toStep3',
						));
					?>
					<?php
						echo BsHtml::button('<i class="fa fa-arrow-left"></i> '.Yii::t('app','Prev step'), array(
						    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
						    'class'=>'pull-right NAVIGABLE',
						    'to'=>'toStep1',
						));
					?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>