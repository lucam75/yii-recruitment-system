<?php 
    use dosamigos\ckeditor\CKEditor;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
?>
<?php //echo Yii::t('app','This is the template of the email that will be sent to the applicant when his/her resume change to state ').Yii::t('app',$this->context->spanState($model->state)); ?>
<?php 
	$form = ActiveForm::begin([
		'id' => 'template-form-'.$model->idStatusResume,
    ]); 

    echo $form->field($model, 'templateEmail')->widget(CKEditor::className(), [
        'preset' => 'basic',
        'options' => ['id' => 'statusresumes-templateemail-'.$model->idStatusResume]
    ])->textarea(['id'=>'statusresumes-templateemail-'.$model->idStatusResume])->label(false);

    echo Html::activeHiddenInput($model, 'state');
    echo Html::activeHiddenInput($model, 'idStatusResume');
    echo Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success pull-left', 'name'=>'submit-template']);
	ActiveForm::end(); 
?>