<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'layout' => BsHtml::FORM_LAYOUT_INLINE,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'id' => 'login-form',
    'htmlOptions' => array(
        'class' => 'bs-example'
    )
));
?>
    <?php
echo $form->textFieldControlGroup($model, 'username',array('class'=>'input-sm'));
?>
    <?php
echo $form->passwordFieldControlGroup($model, 'password',array('class'=>'input-sm'));
?>
    <?php
echo BsHtml::submitButton('Login', array(
    'color' => BsHtml::BUTTON_COLOR_PRIMARY,
    'size' => BsHtml::BUTTON_SIZE_SMALL
));
?>
<?php
$this->endWidget();
?>
