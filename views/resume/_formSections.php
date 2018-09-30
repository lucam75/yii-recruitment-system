<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use app\models\Sections;
?>
<?php
    $model = new Sections();
?>
<div class="row">
	<div class="col-xs-12">
<?php 
    $form = ActiveForm::begin([
        'id' => 'add-section-form',
        'class' => 'form-horizontal',
        'enableClientValidation' => true,
        // 'enableAjaxValidation' => true,
        // 'validationUrl' => ['validate-form-step-2'],
        'validateOnBlur' => false,
        'validateOnChange' => false
    ]); 
?>
<?php echo $form->field($model, 'typeSection_idtypeSection')->hiddenInput()->label(false); ?>
<?php echo $form->field($model, 'header')->input('',['placeholder' => Yii::t('app','Header')]); ?>
<?php echo $form->field($model, 'description')->input('',['placeholder' => Yii::t('app','Description')]); ?>
<?php
    echo '<div class="pull-right">'.Yii::t('app','All fields marked with <span class="required">*</span> are required.').'</div>';
?>
<?php ActiveForm::end(); ?>
	</div>
</div>