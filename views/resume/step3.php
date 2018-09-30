<?php
    use yii\helpers\Html;
?>

<div id="divStep3" style="display:none">
	<div class="row noSummary">
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
	<div class="alert alert-info noSummary">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo Yii::t('app','Tell us about your most remarkable achievements.'); ?>
	</div>
	<a class="noSummary" id="linkAddNewAchievement"><i class="fa fa-plus-square"></i><?php echo " ".Yii::t('app','Add new'); ?></a>
	<div class="row" style ="margin-top:10px;">

		<div class="list-group">

			<div class="list-group" id="listAchievements">
				<?php echo $this->render('_listSections',array('session'=>'Achievements')); ?>
			</div>

		</div>
	</div>
	</fieldset>

	<fieldset>
	<legend><?php echo Yii::t('app','Hobbies'); ?></legend>
	<div class="alert alert-info noSummary">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  <?php echo Yii::t('app','The things that you do in your leisure'); ?>
	</div>
	<a class="noSummary" id="linkAddNewHobby"><i class="fa fa-plus-square"></i><?php echo " ".Yii::t('app','Add new'); ?></a>

	<div class="row" style ="margin-top:10px;">

		<div class="list-group">

			<div class="list-group" id="listHobbies">
				<?php echo $this->render('_listSections',array('session'=>'Hobbies')); ?>
			</div>

		</div>
	</div>
	</fieldset>
			<div class="row noSummary" style="margin-top:20px;">
				<div class="col-xs-12">
				<?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep4']) ?>
					<?= Html::Button(' <i class="fa fa-arrow-left"></i> '.Yii::t('app','Prev'), ['class' => 'btn btn-primary pull-right NAVIGABLE', 'value'=>'toStep2']) ?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>