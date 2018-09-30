<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use app\models\Cities;
    use yii\jui\AutoComplete;
?>
<div class="row">
	<div class="col-xs-12 text-center">
		<ol class="breadcrumb">
			<li id="liStep1"><a><?php echo Yii::t('app','Step 1'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep2"><a><?php echo Yii::t('app','Step 2'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep3"><a><?php echo Yii::t('app','Step 3'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStep4"><a><?php echo Yii::t('app','Step 4'); ?></a></li>
			<i class="fa fa-angle-right"></i>
			<li id="liStepSummary"><a><?php echo Yii::t('app','Summary'); ?></a></li>
			<!-- <li><span>Data</span></li> -->
		</ol>
    </div>
    <div class="col-xs-12">
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                0%
            </div>
        </div>
    </div>
</div>
<div id="divStep1">
    <div class="row">
        <div class="col-xs-12"><div class="text-center"><h2><?php echo Yii::t('app','Personal and contact information'); ?></h2></div></div>
    </div>
    <div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8 col-xs-12">
        <?php $form = ActiveForm::begin([
            'id' => 'resume-form',
            'class' => 'form-horizontal',
            'options' => [
                'enctype' => 'multipart/form-data'
            ]
        ]); ?>

    <?php echo $form->field($model, 'profile')->textarea(['rows'=>'5']);?>
    <fieldset>
    <legend><?php echo Yii::t('app','Personal information'); ?></legend>
    <?php
    // echo $form->textFieldControlGroup($model, 'username', array(
        // 'prepend' => BsHtml::icon(BsHtml::GLYPHICON_USER)
    // ));
    ?>
    <?php echo $form->field($model, 'firstName')->input('',['placeholder' => Yii::t('app','First name')]); ?>
    <?php echo $form->field($model, 'middleName')->input('', ['placeholder' => Yii::t('app','Middle name')]); ?>
    <?php echo $form->field($model, 'lastName')->input('', ['placeholder' => Yii::t('app','Last name')]); ?>
    <?php
    echo $form->field($model, 'gender')->radioList(array('M'=>'Male','F'=>'Female'));
    ?>
    <?php echo $form->field($model, 'suffix')->input('', ['placeholder' => Yii::t('app','Suffix')]); ?>
    <?php echo $form->field($model, 'birthday')->input('date', ['placeholder' => Yii::t('app','Birthday')]); ?>

     <?php echo $form->field($model, 'picture')->fileInput(['placeholder' => Yii::t('app','Picture'), 'accept' => 'image/*']); ?>
    <?php echo $form->field($model, 'expectedSalary')->input('number', ['placeholder' => Yii::t('app','Expected salary, USD currency')]); ?>
    <?php
    // $states = CHtml::listData(Maritalstatus::model()->findAll(array('order'=>'idMaritalStatus ASC')),'idMaritalStatus', 'description');
    // echo $form->radioButtonListControlGroup($model, 'maritalStatus_idMaritalStatus',$states);
    ?>
    </fieldset>
    <fieldset>
        <legend><?php echo Yii::t('app','Contact information'); ?></legend>
        <?php echo $form->field($model, 'email')->input('email', ['placeholder' => Yii::t('app','Email')]); ?>
        <?php echo $form->field($model, 'phone')->input('phone', ['placeholder' => Yii::t('app','Phone number')]); ?>
        <?php echo $form->field($model, 'address')->textarea(); ?>
        <?php
        // $htmlOption = array(
        //     // 'style'=>'width:auto;',
        //     'empty' => Yii::t('app','Select your country ...'),
        //     'class' => 'form-control',
        //     'ajax'=>array(
        //         "url"=>Yii::app()->createUrl("resume/CitiesByCountries"),
        //         "type"=>"POST",
        //         "update"=>"#Resumes_cities_idCity",
        //     ),
        // );
        //$listDataCountry = CHtml::listData(Countries::model()->findAll(array('order'=>'name ASC')),'idCountry', 'name'); ?>
        <?php //$listDataCity = CHtml::listData(Cities::model()->findAll(array('order'=>'name ASC')),'idCity', 'name'); ?>
        <?php //echo $form->dropDownListControlGroup($model, 'cities_idCity',$listDataCity); ?>
        <?= $form->field($model,'cities_idCity')->widget(AutoComplete::className(),[
            'name' => 'City',
            'clientOptions' => [
                'source' => Cities::find()->select(['name as value', 'name as  label','idCity as id'])->asArray()->all(),
                'autoFill'=>true,
                'minLength'=>'1',
            ],
            'options' => [
                'class' => 'form-control',
                'placeholder' => 'City name'
             ]]); ?>
        <?php
        ?>

<div class="summary">
    <?php //if(CCaptcha::checkRequirements()): ?>
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
            <?php //$this->widget('CCaptcha'); ?>
        </div>
    <?php //echo $form->field($model, 'verifyCode')->input('', ['placeholder' => Yii::t('app','captcha')]); ?>
    <?php //endif; ?>
</div>
    <?php //$this->endWidget(); ?>
    </fieldset>

            <div class="row noSummary" style="margin-top:20px;">
                <div class="col-xs-12">
                <?php
                // echo Html::button(Yii::t('app','Next step').' <i class="fa fa-arrow-right"></i>', array(
                //     'color' => BsHtml::BUTTON_COLOR_PRIMARY,
                //     'class'=>'pull-right NAVIGABLE',
                //     'to'=>'toStep2',
                // ));
                ?>
                <?= Html::Button(Yii::t('app','Next').' <i class="fa fa-arrow-right"></i>', ['class' => 'btn btn-primary pull-right NAVIGABLE', 'name'=>'submit-archived', 'value'=>'toStep2']) ?>
                </div>
            </div>
    	</div>
    	<div class="col-md-2"></div>
    </div>
</div>
<?php ActiveForm::end(); ?>