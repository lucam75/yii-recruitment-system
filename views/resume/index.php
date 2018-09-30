<?php
	use yii\helpers\Html;
?>

	<?php //$this->context->stepSummary(); ?>
	<?php echo $this->render('step1', array('model'=>$model)); ?>
	<?php echo $this->render('step2', array('model'=>$model)); ?>
	<?php echo $this->render('step3', array('model'=>$model)); ?>
	<?php echo $this->render('step4', array('model'=>$model)); ?>
	<?php //echo $this->render('step5', array('model'=>$model)); ?>
<?php //echo $this->renderPartial('step1', array('model'=>$model)); ?>
<?php //echo $this->renderPartial('step2', array('model'=>$model)); ?>