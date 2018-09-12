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
    'id' =>$idForm,
    'htmlOptions' => array(
        'class' => 'form'
    )
));
?>
<?php echo $form->textField($model, 'idSection', array('style' => 'display:none;')); ?>
<?php echo $form->textField($model, 'typeSection_idtypeSection', array('style' => 'display:none;')); ?>
<?php echo $form->textFieldControlGroup($model, 'header', array('placeholder' => Yii::t('app','header'))); ?>
<?php echo $form->textFieldControlGroup($model, 'description', array('placeholder' => Yii::t('app','description'))); ?>
<?php
    echo '<div class="pull-right">'.Yii::t('app','All fields marked with <span class="required">*</span> are required.').'</div>';
$this->endWidget();
?>
	</div>
</div>