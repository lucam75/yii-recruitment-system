<?php
    use yii\helpers\Html;
    use app\models\Cities;
    use yii\jui\AutoComplete;
?>
<div id="divStep1" class="divStep">
    <div class="row no-summary-element">
        <div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Personal and contact information'); ?></h2></div></div>
    </div>
    <div class="row">
    	<div class="col-md-8 col-md-offset-2 col-xs-12">
            <?php echo $form->field($model, 'profile')->textarea(['rows'=>'5']);?>
            <fieldset>
                <legend><?php echo Yii::t('app','Personal information'); ?></legend>
                <?php echo $form->field($model, 'firstName')->input('', ['placeholder' => Yii::t('app','First name')]); ?>
                <?php echo $form->field($model, 'middleName')->input('', ['placeholder' => Yii::t('app','Middle name')]); ?>
                <?php echo $form->field($model, 'lastName')->input('', ['placeholder' => Yii::t('app','Last name')]); ?>
                <?php echo $form->field($model, 'gender')->radioList(array('M'=>'Male','F'=>'Female')); ?>
                <?php echo $form->field($model, 'suffix')->input('', ['placeholder' => Yii::t('app','Suffix')]); ?>
                <?php echo $form->field($model, 'birthday')->input('date', ['placeholder' => Yii::t('app','Birthday')]); ?>

                <?php echo $form->field($model, 'picture')->fileInput(['placeholder' => Yii::t('app','Picture'), 'accept' => 'image/*']); ?>
                <?php echo $form->field($model, 'expectedSalary')->input('number', ['placeholder' => Yii::t('app','Expected salary, USD currency')]); ?>
            </fieldset>
            <fieldset>
                <legend><?php echo Yii::t('app','Contact information'); ?></legend>
                <?php echo $form->field($model, 'email')->input('email', ['placeholder' => Yii::t('app','Email')]); ?>
                <?php echo $form->field($model, 'phone')->input('phone', ['placeholder' => Yii::t('app','Phone number')]); ?>
                <?php echo $form->field($model, 'address')->textarea(); ?>
                <?php $form->field($model,'cities_idCity')->widget(AutoComplete::className(),[
                    'name' => 'City',
                    'clientOptions' => [
                        'source' => Cities::find()->select(['name as value', 'name as  label','idCity as id'])->asArray()->all(),
                        'autoFill'=>true,
                        'minLength'=>'1',
                    ],
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'City name'
                    ]]);
                    ?>
            </fieldset>

            <div class="row no-summary-element buttons-bar" style="margin-top:20px;">
                <div class="col-xs-12">
                    <?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'name'=>'submit-archived', 'value'=>'toStepSummary']) ?>
                </div>
            </div>
        </div>
    </div>
</div>