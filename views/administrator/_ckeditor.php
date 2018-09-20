<?php 
    use dosamigos\ckeditor\CKEditorInline;
?>
<?php //echo Yii::t('app','This is the template of the email that will be sent to the applicant when his/her resume change to state ').Yii::t('app',$this->context->spanState($model->state)); ?>
<?php 
    CKEditorInline::begin(['preset' => 'full']); 
        echo $model->templateEmail; 
    CKEditorInline::end();
?>