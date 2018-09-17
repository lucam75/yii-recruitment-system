<h2><?php echo Yii::t('app','Incoming resumes'); ?></h2>
<?php echo $this->render("_gridResumes",array('dataProvider'=>$dataProvider)) ?>