<div class="row">
	<div class="col-xs-12">
		<div class="pull-right">
			<?php echo $this->renderPartial("login",array('model'=>$model)) ?>
		</div>
	</div>
</div>
<div style="color:#777; margin-top:10%;">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h4><?php echo Yii::t('app','---- Welcome to recruitment system ----') ?></h4>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h3><?php echo Yii::t('app','The process to apply for a job has been separated in a four simple steps.'); ?></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<h3><?php echo Yii::t('app','To begin the process click the Start button'); ?></h3>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-center">
			<?php echo CHtml::link(Yii::t('app','Start'),array("resume/index"),array('class' => 'btn btn-success btn-lg','style'=>'width:200px; color:white !important; font-weight:bolder;')); ?>
		</div>
	</div>
</div>