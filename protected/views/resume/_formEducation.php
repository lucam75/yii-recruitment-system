<div class="row">
	<div class="col-xs-12">
		<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    // 'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validateOnChange'=>true,
        'validateOnType'=>true,
    ),
    'id' => 'education-form',
    'htmlOptions' => array(
        'class' => 'form'
    )
));
?>
<?php echo $form->textField($model, 'idEducation', array('style' => 'display:none;')); ?>
<?php echo $form->textFieldControlGroup($model, 'title', array('placeholder' => Yii::t('app','Obtained title'))); ?>
<?php echo $form->textFieldControlGroup($model, 'place', array('placeholder' => Yii::t('app','Institution'))); ?>

<?php echo $form->numberFieldControlGroup($model, 'startYear', array('placeholder' => Yii::t('app','Start year'))); ?>
<?php echo $form->numberFieldControlGroup($model, 'endYear', array('placeholder' => Yii::t('app','End year'))); ?>

<?php echo $form->textAreaControlGroup($model, 'description'); ?>
<?php
    echo '<div class="pull-right">'.Yii::t('app','All fields marked with <span class="required">*</span> are required.').'</div>';
$this->endWidget();
?>
	</div>
</div>